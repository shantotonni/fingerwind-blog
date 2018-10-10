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

class UserRegistrationController extends Controller
{

    public function userRegistration(Request $request){
        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'address' => 'required|min:5',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {

            $response['message'] = $validator->errors()->all();
            return json_encode($response);
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

            $response['result'] = 'success';
            $response['message'] = 'Registration Successfully Completed ! Please Check Email and Active Your Email';

        }else{

            $response['result'] = 'error';
            $response['message'] = 'SomeThing went Wrong';
        }

        return json_encode($response);

    }

    public function accountVerify($email, $verifyToken)
    {

        $user = User::where('email', $email)->first();

        if ($user) {

            User::where('email', $email)->update(['status' => 'active', 'verifyToken' => null]);

            return \redirect()->route('front.home')->with('msg', 'Thanks.For Activate Your Account.Please Login');
        } else {

            return 'User Not Found';
        }

    }

    public function userLogin(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return Redirect::route('front.home')->withErrors($validator)->withInput();
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active','type'=>['admin','publisher','executive']])) {

            return redirect()->route('home');

        }if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active','type'=>['writer']])) {

            return redirect()->route('front.home');
        }
        else{

            return \redirect()->back()->with('msg','Please! Active Your Email');
        }


    }


}
