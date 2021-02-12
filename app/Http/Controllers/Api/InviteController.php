<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dob'=>'required|date',
            'codice_fiscale'=>'required|codice_fiscale',
        ]);
        $invite = Invite::create(
            array_merge($validatedData,["tenant_id"=>$request->user()->id])

        );
        return response(200);
    }
}
