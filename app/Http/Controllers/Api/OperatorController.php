<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function assignUserToOperator(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'exists:App\Models\User,id'
        ]);
        $user = User::find($validated['user_id']);
        auth()->user()->divers()->attach($user->id, ['tenant_id' => session()->get('tenant')->id]);
        $messages['success'] = true;

        return $messages;
    }

    public function getOperatorUsers(Request $request)
    {
        $perPage = 12;
        $page = $request->get('page', 1);
        $sort = $request->get('sort', 'firstname');
        $sortDirection = $request->get('sortDirection', 'DESC');
        $filters = json_decode($request->get('filters', '{}'));
        $search = $request->get('search', '');
        $q = User::orderBy($sort, $sortDirection);
       //

        $roleFilter = [];
        if ($filters) {
            $q = $q->where(function ($q) use ($filters, &$roleFilter) {
                foreach ($filters as $idx => $filter) {
                    if ($filter->field == 'role') {
                        $roleFilter[] = $filter->value;
                    } else {
                        if ($idx === 0) {
                            $q = $q->where($filter->field, $filter->value);
                        } else {
                            $q = $q->orWhere($filter->field, $filter->value);
                        }
                    }
                }
            });
        }
        if ($search) {
            $q = $q->where(function ($query) use($search) {
                $query->where('firstname', 'ILIKE', '%' . $search . '%')->orWhere('lastname', 'ILIKE', '%' . $search . '%')->orWhere('email', 'ILIKE', '%' . $search . '%');
            });
        }
        //ProgressEvent::dispatch("LOADING_USERS");
        $totalFound = $q->count();
        if ($roleFilter) {
            $q = $q->whereHas('dsgroles', function ($query) use ($roleFilter) {
                $query->whereIn('name', $roleFilter);
            });
        }
        $q=$q->whereRelation('operators', 'operator_id', '=', auth()->user()->id);
        $users = $q->with('dsgroles')->offset(($page - 1) * $perPage)->limit($perPage)->get();

        $out = [];
        $out['users'] = $users;
        $usersCount = User::count();
        $out['pagination']['current'] = (int) $page;
        $out['pagination']['total'] = ceil($totalFound / $perPage);
        $out['pagination']['totalUsers'] = $usersCount;
        $out['pagination']['perPage'] = $perPage;

        return $out;

        //
    }
}
