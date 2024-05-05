<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     * @return void
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'city' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'profile_photo_path' => ['nullable', 'image', 'max:1024'], // Max size 1MB
            'address' => ['nullable', 'string', 'max:255'], // Añadir validación para el campo address
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'city' => $input['city'],
                'phone_number' => $input['phone_number'],
                'profile_photo_path' => $input['profile_photo_path'],
                'address' => $input['address'], // Actualizar el campo address
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, mixed>  $input
     * @return void
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'city' => $input['city'],
            'phone_number' => $input['phone_number'],
            'profile_photo_path' => $input['profile_photo_path'],
            'address' => $input['address'], // Actualizar el campo address
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
