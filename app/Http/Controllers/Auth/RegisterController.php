<?php

namespace App\Http\Controllers\Auth;

use App\SocialProvider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo;


    public function __construct()
    {
        if (Auth::check() && Auth::user()->type=='admin'){

            $this->redirectTo= route('home');

        }else{
            $this->redirectTo = route('front.home');
        }

        $this->middleware('guest');
    }


    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required',
        ]);

    }


    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        try{

            $socialUser = Socialite::driver($provider)->user();

        }catch (\Exception $e){

            return redirect()->route('front.home');
        }

        //check if we have logged provider

        $usercheck=User::where('email',$socialUser->getEmail())->first();

        if ($usercheck){

            auth()->login($usercheck);
            return redirect()->route('front.home');
        }else{

            $socialProvider=SocialProvider::where('provider_id',$socialUser->id)->first();

            if (!$socialProvider){

                $user=new User();
                $user->email=$socialUser->getEmail();
                $user->first_name=$socialUser->name;
                $user->username=$socialUser->getNickname();
                $user->status='active';
                $user->save();

                $user->socialProvider()->create(
                    ['user_id'=>$user->id,'provider_id'=>$socialUser->getId(),'provider'=>$provider]
                );


            }else

                $user=$socialProvider->user;
            auth()->login($user);
            return redirect()->route('front.home');

        }




    }


}
