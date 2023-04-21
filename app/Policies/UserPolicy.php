<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user) {
        return $user->role_type == "Admin";
    }

    public function isColaborator(User $user) {
        return $user->role_type == "App\Models\Colaborator";
    }

}
