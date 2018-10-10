<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Article\Models\Artical;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type=='admin'){

            $user=Artical::all();

            return view('user::home',compact('user'));
        }else{

            $user=Artical::where('post_by',Auth::user()->id)->get();
            return view('user::home',compact('user'));
        }
    }

    public function accessControl(){

        $pageTitle = "Access Control";


        return view('user::access_control',[
            'pageTitle'=>$pageTitle,
        ]);

    }
}
