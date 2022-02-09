<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\User;
use App\Scopes\TenantScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dob'=>'required|date',
            'codice_fiscale'=>'required|codice_fiscale',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'code' => 99,
                'description' => 'There are some errors',
                'errors'=>$validator->messages(),
            ], 200);
        }
        $validatedData = $request->validate($rules);

        $user = User::where('email', $request['email'])->whereHas('centers', function ($center) use ($request) {
            $center->where('tenant_id', $request->user()->id);
        })->withoutGlobalScope(TenantScope::class)->first();
        if ($user) {
            return response()->json([
                'code' => 1,
                'description' => 'User already registered',
            ]);
        }
        $invite = Invite::create(
            array_merge($validatedData, ['tenant_id'=>$request->user()->id])

        );

        return response()->json([
            'code' => 2,
            'description' => 'User invited to the Medical Center',
        ]);
    }
}
