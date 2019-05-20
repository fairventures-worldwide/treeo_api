<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data): User
    {
        $userData = [
            'password'             => $data->password ? Hash::make($data->password) : null,
            'name'                 => $data->name,
            'email'                => $data->email,
            'gender'               => $data->gender,
            'birth'                => $data->birth,
            'social_token'         => $data->token,
            'social_expires_in'    => $data->expiresIn,
            'social_refresh_token' => $data->refreshToken,
            'social_token_secret'  => $data->tokenSecret,
        ];

        // remove null values and their keys
        $userData = array_filter($userData);

        $user = Apiato::call('User@UpdateUserTask', [$userData, $data->id]);

        if (!is_null($data->admin)) {
            if ($data->admin) {
                if ($user->hasRole('manager')) $user->roles()->detach();
                Apiato::call('Authorization@AssignUserToRoleTask', [$user, [Apiato::call('Authorization@FindRoleTask', ['admin'])]]);
            }
            else {
                if ($user->hasRole('admin')) $user->roles()->detach();
                Apiato::call('Authorization@AssignUserToRoleTask', [$user, [Apiato::call('Authorization@FindRoleTask', ['manager'])]]);
            }
        }

        return $user;
    }
}
