<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use function response;

class AlertController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date'=>'required|integer|between:0,2147483648',
            'userId'=>'sometimes|integer|exists:users,id',

        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        if (Arr::exists($request, 'userId')) {
            $request['user_id'] = $request['userId'];
        } else {
            $user = $request->user();
            $request['user_id'] = $user->id;
        }
        $request['time'] = $request['date'];
        $newAlert = Alert::create($request->toArray());
        $respose['success'] = 'Alert succesfully created';

        return response($respose, 200);
    }
}
