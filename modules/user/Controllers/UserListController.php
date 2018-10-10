<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Modules\Article\Models\Artical;

class UserListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if (Auth::user()->type=='admin'){
            $all_user=User::where('type','!=','admin')->get();
            return view('user::user.index',compact('all_user'));
        }else{

//            $all_user=User::where('type','!=','admin')->get();
//            return view('user.index',compact('all_user'));

            return \redirect()->back();

        }

    }

    public function profile(){

        $profile=User::where('id',Auth::user()->id)->first();
        return view('user::user.profile',compact('profile'));

    }


    public function updateImage(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($validator->fails()) {

            return Redirect::route('user.profile')->withErrors($validator)->withInput();
        }

        if ($request->has('image')) {

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imagename);

            User::where('id', $id)->update(['image' => $imagename]);

            return redirect()->back()->with('msg', 'Image Uploaded Successfully');
        }
    }


    public function editProfile($id){

        $user=User::find($id);
        return view('user::user.edit',compact('user'));

    }


    public function updateProfile(Request $request,$id){

        $type=User::where('id',$id)->first();

        if ($type->type=='admin'){
            $user=User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->type=$request->type;
            $user->status=$request->status;
            $user->save();

            return redirect()->route('user.profile')->with('msg','Profile Updated Successfully');
        }else{

            $user=User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->type=$request->type;
            $user->save();

            return redirect()->route('user-list.index')->with('msg','Profile Updated Successfully');
        }

    }

    public function userProfileShow($id){

        $user=User::where('id',$id)->first();
        return view('user::user.show',compact('user'));

    }

    public function myArticle(){

        $article=Artical::where('post_by',Auth::user()->id)->get();

        if (count($article)>0){
            return view('user::user.my_article',compact('article'));
        }else{
            return view('user::user.my_article',compact('article'));
        }
    }

    public function customLogout(){

        Auth::logout();

        return \redirect()->route('front.home');

    }

    public function userCreate(){

        $user=new User();
        return view('user::user_create',compact('user'));

    }

    public function adminStoreUser(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return Redirect::route('user.create')->withErrors($validator)->withInput();
        }

        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->type=$request->type;
        $user->status=$request->status;
        $user->password=bcrypt($request->address);
        $user->save();

        return Redirect::route('user-list.index')->withErrors($validator)->withInput();

    }

    public function userProfileDelete($id){

        $user=User::where('id',$id)->first();
        $user->delete();

        return \redirect()->back()->with('delete','User Deleted Successfully');

    }


}
