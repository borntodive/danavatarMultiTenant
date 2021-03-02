<?php


namespace App\Traits;


use App\Enums\UserGender;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

trait ValidationRules
{
    public function getProfileRules($user) {
        $userId=$user ? $user->id : null;
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'gender' => ['required',new EnumValue(UserGender::class,false)],
            'place_of_birth' => ['required','string', 'max:255'],
            'dob'=>['required','date'],
            'address' => ['nullable','string', 'max:255'],
            'city' => ['nullable','string', 'max:255'],
            'zipcode' => ['nullable','string', 'max:255'],
            'state' => ['nullable','string', 'max:255'],
            'country' => ['nullable','string', 'max:255'],
            'codice_fiscale'=>['nullable','codice_fiscale', Rule::unique('users')->ignore($userId)],
            'photo' => ['nullable', 'image', 'max:1024']
            ];
    }


    public function getTenantRules($tenant) {
        $tenantId=$tenant ? $tenant->id : null;
        return [
            'center.name' => ['required', 'string', 'max:255'],
            'center.url' => ['required', 'string', 'max:255', Rule::unique('tenants','url')->ignore($tenantId)],
            'photo' => ['nullable', 'image', 'max:1024']
        ];
    }

}
