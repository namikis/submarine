<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    public function signIn(){
        return view('auth.signIn');
    }

    public function user_login(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'pass' => 'required|min:4'
        ]);
        

        $email = $request->input('email');
        $pass = $request->input('pass');

       if(Auth::guard('users')->attempt(['email'=>$email,'password'=>$pass])){
           $user = Auth::user();
           $profile = Users::getById($email);

           $user = array(
               'user_id' => $profile->id,
               'user_name' => $profile->user_name,
               'email' => $email,
           );

           $request->session()->put('loginInfo',$user);

           return view('home')->with('loginInfo',session('loginInfo'));
       }

        return view('auth\signIn')->with('message','メールアドレスかパスワードが一致しません。');
    }

    public function signUp(){
        return view('auth.signUp');
    }

    public function logout(Request $request){
        // Auth::guard('users')->logout();
        $request->session()->invalidate();

        return redirect('/home');
    }

    public function register(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|min:4'
        ]);

        $data['user_name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->pass);

        $id = Users::insertUser($data);

        $user = array(
            'user_id' => $id,
            'user_name' => $data['user_name'],
            'email' => $data['email']
        );

        $request->session()->put('loginInfo',$user);

        return redirect('/home');
    }
}
