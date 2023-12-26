<?php

namespace App\Contracts\Commons;

trait HasUserDataHeader
{
    /**
     * @return array
     */
    public function getAuthUserData()
    {
        return [
            'id'    => $this->headers->get('x-authuserid') ?? $_SERVER['HTTP_X_AUTHUSERID'],
            'name'  => $this->headers->get('x-authusername') ?? $_SERVER['HTTP_X_AUTHUSERNAME'],
            'email' => $this->headers->get('x-authuseremail') ?? $_SERVER['HTTP_X_AUTHUSEREMAIL'],
        ];
    }

    /**
     * @return array
     */
    public function getUserData()
    {
        return [
            'id'    => $this->headers->get('x-userid') ?? $_SERVER['HTTP_X_USERID'],
            'name'  => $this->headers->get('x-username') ?? $_SERVER['HTTP_X_USERNAME'],
            'email' => $this->headers->get('x-useremail') ?? $_SERVER['HTTP_X_USEREMAIL'],
        ];
    }
}
