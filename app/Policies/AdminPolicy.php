<?php

namespace App\Policies
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use Illuminate\Http\Request;
class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can create posts.
     *
     * @param \App\Models\User  $user
     * @return bool
     */
    public function __construct()
    {
        //
    }

    public function view(?User $user){
            return $user->Role->number === 2;
        
    }
}


