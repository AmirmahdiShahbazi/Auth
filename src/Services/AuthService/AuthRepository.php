<?php

namespace Amirsh\Auth\Services\AuthService;

use Amirsh\Auth\Http\Requests\Auth\LoginRequest;
use Amirsh\Auth\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface
{



    public function register(RegisterRequest $request)
    {
        $validateData=$request->validated();
        $name=explode('@',$validateData['email'])[0];
        User::create(['email'=>$validateData['email'],
                            'name'=>$name,            
                            'password'=>password_hash($validateData['password'],PASSWORD_BCRYPT)]);
        $rememberme = $validateData['rememberme']=='on' ? true:false;                    
        Auth::attempt(['email' => $validateData['email'], 'password' => $validateData['password']]
                    ,$rememberme);
    }

    public function login(LoginRequest $request)
    {
        $validateData=$request->validated();
        $user=User::where(['email'=>$validateData['email']])->first();
        if(!password_verify($validateData['password'],$user->password))
        {
            return back()->with('failed','wrong password');
        }
        $rememberme = $validateData['rememberme']=='on' ? true:false;                    
        Auth::attempt(['email' => $validateData['email'], 
                    'password' =>$validateData['password']]
                    ,$rememberme);
    }

    public function logout()
    {

        Auth::logout();


    }
}