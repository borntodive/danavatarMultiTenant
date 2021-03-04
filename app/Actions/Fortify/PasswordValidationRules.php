<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $rules=['required', 'string', new Password, 'confirmed'];
        if (app()->environment('production')) {
            $rules[]='zxcvbn_min:3';
        }
        return $rules;
    }
}
