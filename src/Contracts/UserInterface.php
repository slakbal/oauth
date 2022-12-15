<?php

namespace Slakbal\Oauth\Contracts;

interface UserInterface
{
    /**
     * Get the first name of the user.
     *
     * @return string
     */
    public function getFirstname();

    /**
     * Get the last name of the user.
     *
     * @return string
     */
    public function getLastname();
}
