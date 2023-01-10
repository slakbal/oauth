<?php

namespace Slakbal\Oauth\Socialite;

use Slakbal\Oauth\Contracts\UserInterface;
use Laravel\Socialite\Two\User as BaseUser;

class User extends BaseUser implements UserInterface
{
    /**
     * The identity token.
     *
     * @var string
     */
    public $idToken;

    /**
     * {@inheritdoc}
     */
    public function getFirstname()
    {
        return $this->first_name;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname()
    {
        return $this->last_name;
    }

    /**
     * Set the id token required to obtain user information from for @SIV employee accounts.
     *
     * @param  string  $idToken
     * @return $this
     */
    public function setIdToken($idToken)
    {
        $this->idToken = $idToken;

        return $this;
    }

    /**
     * Get the id token .
     *
     * @return string
     */
    public function getIdToken()
    {
        return $this->idToken;
    }
}
