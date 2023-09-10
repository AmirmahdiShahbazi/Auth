<?php

namespace Amirsh\Auth\Http\Controllers\Auth;

use Amirsh\Auth\Http\Requests\Auth\LoginRequest;
use Amirsh\Auth\Http\Requests\Auth\RegisterRequest;
use Amirsh\Auth\Repositories\AuthRepository\AuthInterface ;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth=$auth;

    }
    public function showRegisterForm()
    {
        return view('auth::auth.register');
    }

    public function register(RegisterRequest $request)
    {
        
        try{
            $this->auth->register($request);
            return redirect('')->with('success','registred successfully');
        }catch(Exception $e)
        {
            return back()->with('failed',$e->getMessage());

        }
    }

    public function login(LoginRequest $request)
    {
        try{
            $this->auth->login($request);
            return redirect('')->with('success','logged in successfully');

        }catch(Exception $e)
        {
            return back()->with('failed',$e->getMessage());
        }
    }


    public function logout()
    {
        try{
            $this->auth->logout();
            return redirect('')->with('success','logged out successfully');
        }catch(Exception $e)
        {
            return back()->with('failed',$e->getMessage());
        }

    }

    public function showLoginForm()
    {
        return view('auth::auth.login');
    }
}