<?php

namespace Goedemiddag\Auth;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class SimpleUserProvider implements UserProvider
{

    private string $email;
    private string $password;


    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public function retrieveById($identifier)
    {
        if ($identifier === $this->email) {
            return $this->getGenericUser();
        }
    }


    public function retrieveByToken($identifier, $token)
    {
        // Not implemented
    }


    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not implemented
    }


    public function retrieveByCredentials(array $credentials)
    {
        if ($credentials['email'] === $this->email) {
            return $this->getGenericUser();
        }
    }


    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return hash_equals($user->getAuthPassword(), $credentials['password']);
    }


    private function getGenericUser()
    {
        return new GenericUser([
            'id'       => $this->email,
            'password' => $this->password,
        ]);
    }

}
