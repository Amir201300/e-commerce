<?php

namespace App\Interfaces;

interface UserInterface {
    /**
     * @param $request
     * @return mixed
     */
    public function register($request);

    /**
     * @param $request
     * @param $user_id
     * @return mixed
     */
    public function validate_user($request,$user_id);

    /**
     * @param $request
     * @return mixed
     */
    public function login($request);
}
