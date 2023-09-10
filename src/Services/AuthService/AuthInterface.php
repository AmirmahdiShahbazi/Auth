<?php


namespace Amirsh\Auth\Services\AuthService;

use Amirsh\Auth\Http\Requests\Auth\LoginRequest;
use Amirsh\Auth\Http\Requests\Auth\RegisterRequest;

interface AuthInterface
{


    public function register(RegisterRequest $request);

    public function login(LoginRequest $request);

    public function logout();
    
    
}