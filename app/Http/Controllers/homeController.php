<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loginInfo = session('loginInfo');
        return view('home')->with('loginInfo',$loginInfo);
    }

    public function intro()
    {
        $loginInfo = session('loginInfo');
        return view('intro')->with('loginInfo',$loginInfo);
    }

    public function account(){
        $loginInfo = session('loginInfo');

        if(!isset($loginInfo)){
            return redirect('/signIn');
        }else{
            return view('account')->with('loginInfo',$loginInfo);
        }
    }

    public function account_update(){
        $loginInfo = session('loginInfo');

        if(!isset($loginInfo)){
            return redirect('/signIn');
        }else{
            return view('account_update')->with('loginInfo',$loginInfo);
        }
    }

    public function account_update_done(Request $request){

        $loginInfo = session('loginInfo');

        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        if($request->email != $loginInfo['email']){
            $this->validate($request,[
                'email' => 'required|email|unique:users,email'
            ]);
        }

        $data['id'] = $loginInfo['user_id'];
        $data['user_name'] = $request->name;
        $data['email'] = $request->email;

        Users::updateData($data);
        $loginInfo['user_name'] = $data['user_name'];
        $loginInfo['email'] = $data['email'];

        $request->session()->put('loginInfo',$loginInfo);

        return redirect('/account');
    }

    public function account_delete_done(Request $request){
        $loginInfo = session('loginInfo');

        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        Users::deleteData($loginInfo);

        $request->session()->invalidate();
        return redirect('/');
    }
}
