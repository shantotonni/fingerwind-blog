<?php

namespace Modules\Web\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Modules\Article\Models\Artical;
use Modules\Category\Models\Category;
use Modules\Web\Models\ArticleVote;
use Modules\Web\Models\Contact;
use Modules\Web\Models\Subscribe;

class FrontController extends Controller
{
    protected function isGetRequest(){
        return Input::server("REQUEST_METHOD") == "GET";
    }

    public function index(){

        $category=Category::all();
        $article=Artical::where('status','active')->where('is_delete',0)
            ->inRandomOrder()
            ->paginate(12);

        $top_article=Artical::where('status','active')
            ->where('is_delete',0)
            ->latest()
//            ->groupBy('category_id')
            ->take(8)
            ->get();

       // dd($article);


        return view('web::index',compact('article','category','top_article'));

    }

    public function singleArticle($id){

        $category=Category::all();
        $vote=ArticleVote::where('article_id',$id)->get();
        $single_article=Artical::find($id);
        $article=Artical::where('status','active')
            ->where('is_delete',0)
            ->inRandomOrder()
            ->limit(6)->get();

        $article_sismilar=Artical::where('status','active')
            ->where('is_delete',0)
            ->limit(6)->get();

        return view('web::single_article',compact('article','single_article','category','recent_post','popular_post','vote','article_sismilar'));

    }

    public function categoryByPost($id){
        $title=[];
        $category_name = Category::find($id);
        $article=Artical::where('category_id',$id)
            ->where('status','active')
            ->where('is_delete',0)
            ->get();
        $category=Category::all();
        return view('web::category_by_post',compact('article','category','category_name','title'));
    }

    public function postSearch(){

        $top_article=Artical::where('status','active')
            ->where('is_delete',0)
            ->latest()
//            ->groupBy('category_id')
            ->take(8)
            ->get();

        $category_name = [];

        if($this->isGetRequest())
        {
            $category=Category::all();
            $title = Input::get('search');
            $article = Artical::join('categories', 'articals.category_id', '=', 'categories.id')
                ->where('articals.is_delete',0)
                ->where(function ($query) use($title){
                    $query = $query->orWhere('articals.title', 'LIKE', '%'.$title.'%');
                    $query = $query->orWhere('categories.name', 'LIKE', '%'.$title.'%');
                    $query = $query->orWhere('articals.description', 'LIKE', '%'.$title.'%');
                })->select('articals.*')->get();

            return view('web::category_by_post',compact('article','category','category_name','title','top_article'));


        }

    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $response['message'] = 'Pleas Select Valid Email ';
            return json_encode($response);
        }

        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';
        $input = $request->all();

        $subscribe=Subscribe::where('email',$request->email)->exists();

        if ($subscribe){

            $response['message'] = 'You are already subscribe this page';
            return json_encode($response);
        }else{

            $subscribe = new Subscribe();
            $subscribe->email = $input['email'];

            if ($subscribe->save()) {

                $response['result'] = 'success';
                $response['message'] = 'Subscribe successfully.';

            } else {

                $response['message'] = 'please again Subscribe';
            }
        }

        return json_encode($response);
    }

    public function aboutUs(){
        $category=Category::all();
        return view('web::pages.about_us',compact('category'));
    }

    public function privacyPolicy(){
        $category=Category::all();
        return view('web::pages.privacy_policy',compact('category'));
    }

    public function contactUs(){

        $category=Category::all();
        return view('web::pages.contact_us',compact('category'));
    }

    public function contactFormStore(Request $request){
        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'subject' => 'required|min:5',
            'email' => 'required|email',
            'description' => 'required|min:10',
        ]);

        if ($validator->fails()) {

            $response['message'] = $validator->errors()->all();
            return json_encode($response);

        }

        $contact=new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->subject=$request->subject;
        $contact->description=$request->description;

        if ($contact->save()){

            $response['result'] = 'success';
            $response['message'] = 'Contact Form Submitted Successfully';
            return json_encode($response);

        }else{

             $response['message'] = 'Contact Form Not Submitted Successfully';
        }

        return json_encode($response);
    }

    public function userAllArticle($id){

        $article=Artical::where('post_by',$id)->get();
        $category=Category::all();
        $user=User::where('id',$id)->first();
        return view('web::frontarticle.user_all_article',compact('article','category','user'));
    }

    public function articleViewCount(Request $request){

        $article=Artical::find($request->id);
        $article->view_count+=1;
        $article->save();

    }


}
