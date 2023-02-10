<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Profile $profile)
    {
        return $user->profil->isProfileComplete();
    }
}
