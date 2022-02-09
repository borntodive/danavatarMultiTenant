<?php

namespace App\Actions\Fortify;

use App\Enums\UserGender;
use App\Traits\ValidationRules;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use ValidationRules;

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, $this->getProfileRules($user))->validateWithBag('updateProfileInformation');

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
