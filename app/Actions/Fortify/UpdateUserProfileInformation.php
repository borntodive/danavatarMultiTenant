<?php

namespace App\Actions\Fortify;

use App\Enums\UserGender;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'gender' => ['required',new EnumValue(UserGender::class,false)],
            'place_of_birth' => ['required','string', 'max:255'],
            'dob'=>['required','date'],
            'address' => ['nullable','string', 'max:255'],
            'city' => ['nullable','string', 'max:255'],
            'zipcode' => ['nullable','string', 'max:255'],
            'state' => ['nullable','string', 'max:255'],
            'country' => ['nullable','string', 'max:255'],
            'codice_fiscale'=>['nullable','codice_fiscale', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'gender' => $input['gender'],
                'email' => $input['email'],
                'place_of_birth' => $input['place_of_birth'],
                'dob' => $input['dob'],
                'address' => $input['address'],
                'city' => $input['city'],
                'zipcode' => $input['zipcode'],
                'state' => $input['state'],
                'country' => $input['country'],
                'codice_fiscale' => $input['codice_fiscale'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'place_of_birth' => $input['place_of_birth'],
            'dob' => $input['dob'],
            'address' => $input['address'],
            'city' => $input['city'],
            'zipcode' => $input['zipcode'],
            'state' => $input['state'],
            'country' => $input['country'],
            'codice_fiscale' => $input['codice_fiscale'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
