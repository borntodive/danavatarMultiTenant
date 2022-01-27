<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
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
        return Role::dsg()->get();
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
            'slug' => 'required|max:255',
            'level' => 'required|integer',
        ]);
        dump($validated['_id']);
        $id = $validated['_id'];
        unset($validated['_id']);
        $role = Role::updateOrCreate(['_id' => $id], $validated);
        $response = [];
        if ($role)
            $response['success'] = true;
        else
            $response['waring'] = true;
        return $response;
    }
    public function updateUserRoles(Request $request, User $user)
    {
        try {
            $roles = Role::whereIn('name', $request->all())->get();
            $user->syncRoles($roles,4);
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
    public function destroy( Role $role)
    {
        if (!$role) {
            $response['waring'] = true;
        } else {
            $role->delete();
            $response['success'] = true;
        }
        return $response;
    }
}
