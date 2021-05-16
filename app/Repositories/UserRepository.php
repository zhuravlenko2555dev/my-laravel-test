<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function deleteTokenById(User $user, $tokenId)
    {
        $user->tokens()->where('id', $tokenId)->delete();
    }

    public function createToken(User $user, $name)
    {
        return $user->createToken($name ?: '')->plainTextToken;
    }
}
