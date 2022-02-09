<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Role::dsg()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            '_id' => 'sometimes',
            'name' => 'required|max:255',
        ]);
        $id = $validated['_id'];
        unset($validated['_id']);
        $role = Role::updateOrCreate(['_id' => $id], $validated);
        $response = [];
        if ($role) {
            $response['success'] = true;
        } else {
            $response['waring'] = true;
        }

        return $response;
    }

    public function updateUserRoles(Request $request, User $user)
    {
        $dsgTeam = Team::where('name', 'dsg')->first();
        try {
            $roles = Role::whereIn('name', json_decode(request()->getContent()))->get();
            $user->syncRoles($roles, $dsgTeam->id);
            $response['success'] = true;
        } catch (Exception $e) {
            $response['waring'] = $e->getMessage();
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (! $role) {
            $response['waring'] = true;
        } else {
            $role->delete();
            $response['success'] = true;
        }

        return $response;
    }
}
