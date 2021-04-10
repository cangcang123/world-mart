<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider as UserProviderContract;
use Illuminate\Support\Facades\Cache;

class UserProvider extends EloquentUserProvider implements UserProviderContract
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $seconds = 60 * 60;
        $cacheKey = 'shop-users.' . $identifier;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $model = $this->createModel();
        $user  = $this->newModelQuery($model)
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();

        Cache::put($cacheKey, $user, $seconds);
        return $user;
    }

    // public function retrieveByToken($identifier, $token);
    // public function updateRememberToken(Authenticatable $user, $token);
    // public function retrieveByCredentials(array $credentials);
    // public function validateCredentials(Authenticatable $user, array $credentials);
}
