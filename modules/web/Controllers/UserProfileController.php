<?php

namespace Modules\Web\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Modules\Article\Models\Artical;
use Modules\Category\Models\Category;
use Modules\Category\Models\SubCategory;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userProfile(){

        $category=Category::all();
        $profile=User::where('id',Auth::user()->id)->first();
        return view('web::profile.user_profile',compact('category','profile'));

    }

    public function userProfileEdit($id){

        $category=Category::all();
        $profile=User::where('id',$id)->first();
        return view('web::profile.user_profile_edit',compact('category','profile'));
    }

    public function userProfileUpdate(Request $request,$id){

        if ($request->has('image')) {

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imagename);

            $user=User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->gender=$request->gender;
            $user->address=$request->address;
            $user->city=$request->city;
            $user->country=$request->country;
            $user->state=$request->state;
            $user->zip_code=$request->zip_code;
            $user->date_of_birth=$request->date_of_birth;
            $user->image=$imagename;
            $user->save();

            return Redirect::route('front.user.profile')->with('msg','User Profile Updated Successfully');

        }else{

            $user=User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->gender=$request->gender;
            $user->address=$request->address;
            $user->city=$request->city;
            $user->country=$request->country;
            $user->state=$request->state;
            $user->zip_code=$request->zip_code;
            $user->date_of_birth=$request->date_of_birth;
            $user->save();
            return Redirect::route('front.user.profile')->with('msg','User Profile Updated Successfully');

        }

    }

    public function userArticle(){

        $category=Category::all();
        $article=Artical::where('post_by',Auth::user()->id)->get();
        return view('web::frontarticle.user_article',compact('category','article'));

    }

    public function userCreateArticle(){

        $category=Category::all();
        return view('web::frontarticle.user_create_article',compact('category'));

    }

    public function userArticleStore(Request $request){


        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'title' => 'required|min:5',
            'description' => 'required|min:300',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $word_count=count(explode(' ', $request->description));

        $article=Artical::all();
        $per=[];
        foreach ($article as $value){

            similar_text($value->description,$request->description,$percentage);
            array_push($per,$percentage);

        }

        $maximum_value=max($per);

        if ($maximum_value>20){

            return \redirect()->route('user.create.article')->with('msg','Duplicate Entry');

        }else{

            $sum=array_sum($per);
            $avarage=($sum/count($article));
        }

        if ($validator->fails()) {

            return Redirect::route('user.create.article')->withErrors($validator)->withInput();
        }

        if ($request->has('image'))
        {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('article');
            $image->move($destinationPath, $imagename);

            $article=new Artical();
            $article->title=$request->title;
            $article->category_id=$request->category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->content_unique=$avarage;
            $article->image=$imagename;
            $article->status='inactive';
            $article->save();
            return Redirect::route('user.article')->with('msg','Article Created Successfully');
        }

    }

    public function userArticleEdit($id){

        $article=Artical::find($id);
        $category=Category::all();
        return view('web::frontarticle.user_edit_article',compact('category','article'));
    }

    public function userArticleUpdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'title' => 'required|min:5',
            'description' => 'required|min:300',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $word_count=count(explode(' ', $request->description));

        if ($request->has('image')) {

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('article');
            $image->move($destinationPath, $imagename);

            $article=Artical::find($id);
            $article->title=$request->title;
            $article->category_id=$request->category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->image=$imagename;
            $article->save();
            return Redirect::route('user.article')->with('msg','Article Updated Successfully');

        }else{

            $article=Artical::find($id);
            $article->title=$request->title;
            $article->category_id=$request->category_id;
            $article->sub_category_id=$request->sub_category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->save();
            return Redirect::route('user.article')->with('msg','Article Updated Successfully');

        }

    }

    public function userArticleDelete($id){

        $article=Artical::find($id);
        $article->delete();

        return \redirect()->back()->with('delete','Article Deleted Successfully');


    }

}
