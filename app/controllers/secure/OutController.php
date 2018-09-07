<?php

namespace App\Controllers;


class OutController extends BaseSecureController
{
    public function indexController()
    {
        session_unset();
    }
}