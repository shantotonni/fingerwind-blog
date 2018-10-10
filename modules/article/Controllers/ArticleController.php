<?php
namespace Modules\Article\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Modules\Article\Models\Artical;
use Modules\Article\Models\UserSendMail;
use Modules\Category\Models\Category;
use Modules\Category\Models\SubCategory;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->type=='admin'){
            $article=Artical::where('is_delete',0)->get();
            return view('article::article.index',compact('article'));
        }else{
            $article=Artical::where('post_by',Auth::user()->id)->get();
            return view('article::article.index',compact('article'));
        }
    }

    public function create()
    {
        $article=new Artical();
        $category=Category::all();
        return view('article::article.create',compact('article','category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'title' => 'required|min:5',
            'description' => 'required|min:300',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);


        $word_count=count(explode(' ', $request->description));

        if ($validator->fails()) {

            return Redirect::route('article.create')->withErrors($validator)->withInput();
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
            $article->sub_category_id=$request->sub_category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->image=$imagename;
            $article->status='inactive';
            $article->save();
            return Redirect::route('article.index')->with('msg','Article Inserted Successfully');

        }

    }

    public function show($id)
    {
        $article=Artical::find($id);
        return view('article::article.show',compact('article'));
    }

    public function edit($id)
    {
        $category=Category::all();
        $article=Artical::find($id);
        return view('article::article.edit',compact('article','category'));
    }

    public function update(Request $request,$id)
    {
        $word_count=count(explode(' ', $request->description));

        if ($request->has('image')) {

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('article');
            $image->move($destinationPath, $imagename);

            $article=Artical::find($id);
            $article->title=$request->title;
            $article->category_id=$request->category_id;
            $article->sub_category_id=$request->sub_category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->image=$imagename;
            $article->save();
            return Redirect::route('article.index',$id)->with('msg','Article Updated Successfully');

        }else{

            $article=Artical::find($id);
            $article->title=$request->title;
            $article->category_id=$request->category_id;
            $article->sub_category_id=$request->sub_category_id;
            $article->post_by=Auth::user()->id;
            $article->description=$request->description;
            $article->word_count=$word_count;
            $article->save();
            return Redirect::route('article.index',$id)->with('msg','Article Updated Successfully');

        }

    }


    public function delete($id)
    {
        $article= Artical::find($id);
        $article->is_delete =1;
        $article->save();
        return Redirect::route('article.index')->with('msg','Article Deleted Successfully');
    }

    public function active($id, $active)
    {
        $article = Artical::find($id);
        $article->status = $active;
        $article->save();
        return Redirect::route('article.index')->with('msg', 'Article Status Updated Successfully');
    }

    public function inactive($id, $inactive)
    {
        $article = Artical::find($id);
        $article->status = $inactive;
        $article->save();
        return Redirect::route('article.index')->with('msg', 'Article Status Updated Successfully');
    }

    public function articleMail($id){

        $article=Artical::find($id);

        return view('article::article.mail',compact('article'));

    }

    public function articleMailSend(Request $request,$id){


        $validator = Validator::make($request->all(), [
            'subject' => 'required|min:5',
            'description' => 'required|min:20',
        ]);


        if ($validator->fails()) {
            return Redirect::route('article.mail',$id)->withErrors($validator)->withInput();
        }

        $sendmail=new UserSendMail();
        $sendmail->article_id = $request->article_id;
        $sendmail->user_id = $request->user_id;
        $sendmail->subject = $request->subject;
        $sendmail->email = $request->email;
        $sendmail->description = $request->description;

        if ($sendmail->save()){

            Mail::send('article::article.sendmail', array('data' => $sendmail), function ($messeg) {

                $messeg->to(Input::get('email'))->subject('User Mail Send For Article');

            });

            return \redirect()->route('article.mail',$id)->with('msg','Mail Send Successfully');

        }
    }

    public function userSendMailList($id){

        $send_mail_list=UserSendMail::where('article_id',$id)
            ->get();
        if (count($send_mail_list)>0){

            return view('article::article.send_mail_list',compact('send_mail_list'));
        }else{
            $send_mail_list=[];
            return view('article::article.send_mail_list',compact('send_mail_list'));
        }


    }

    public function mailDelete($id){

        $mail=UserSendMail::find($id);
        $mail->delete();

        return \redirect()->back()->with('delete','Mail Deleted Successfully');

    }


}