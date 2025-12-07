<?php

namespace App\Policies;

use App\Models\Sighting;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Http\Controllers\PermissionController;

class SightingPolicy
{
    // ADMIN pode tudo
    private function isAdmin(User $user)
{
    return $user->role && $user->role->id == 1;
}


    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Sighting $sighting)
    {
        return true;    
    }

    
    public function create(User $user)
    {
        return true; 
    }

   
    public function update(User $user, Sighting $sighting)
    {
        return $this->isAdmin($user) || $user->id === $sighting->user_id;
    }

    public function delete(User $user, Sighting $sighting)
    {
        return $this->isAdmin($user) || $user->id === $sighting->user_id;
    }
}
