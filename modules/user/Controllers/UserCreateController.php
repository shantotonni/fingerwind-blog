<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class UserCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userRegistration(Request $request){

        dd('ok');
        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|min:5',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {

            $response['message'] = $validator->errors()->all();
            return json_encode($response);
        }

        $check_user=User::where('email',$request->email)->first();

        if ($check_user){

            return response(['error'=>'Your Email Already Exists']);
        }


           $user=new User();
           $user->first_name=$request->first_name;
           $user->last_name=$request->last_name;
           $user->email=$request->email;
           $user->phone=$request->phone;
           $user->address=$request->address;
           $user->type='writer';
           $user->password=bcrypt($request->password);
           $user->verifyToken = Str::random(40);


        if ( $user->save()){

            Mail::send('user::user.mail', array('user' => $user), function ($messeg) {

                $messeg->to(Input::get('email'))->subject('New User Activation Request Mail');

            });

            return response(['success'=>'Registration Successfully Completed ! Please Check Email and Active Your Email']);

        }

        return response(['error'=>'error']);

    }


}
