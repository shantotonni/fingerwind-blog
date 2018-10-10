<?php

namespace Modules\Web\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Article\Models\Artical;
use Modules\Category\Models\Category;
use Modules\Category\Models\SubCategory;
use Modules\Web\Models\ArticleBookmark;
use Modules\Web\Models\ArticleVote;
use Modules\Web\Models\Comment;

class VotingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('userComment');
    }


    public function userVoting(Request $request){

        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';
        $ip=\request()->ip();

        $vote=ArticleVote::where('user_id',Auth::user()->id)
            ->where('article_id',$request->id)
            ->exists();

        if ($vote){

            $response['message'] = 'You are already Voting this Article';
            return json_encode($response);
        }else {

            $vote = new ArticleVote();
            $vote->article_id = $request->id;
            $vote->user_id = Auth::user()->id;
            $vote->ip = $ip;
            $vote->vote = 1;

            if ($vote->save()) {
                $response['result'] = 'success';
                $response['message'] = 'Voting successfully.';

            } else {

                $response['message'] = 'Voting Not successfully.';
            }
        }

        return json_encode($response);
    }


    public function userBookmark(Request $request){

        $response = [];
        $response['result'] = 'error';
        $response['message'] = 'Unknown';
        $ip=\request()->ip();

        $bookmark=ArticleBookmark::where('user_id',Auth::user()->id)
            ->where('article_id',$request->id)
            ->exists();

        if ($bookmark){
            $response['message'] = 'You are already Bookmark this Article';
            return json_encode($response);
        }else {

            $bookmark = new ArticleBookmark();
            $bookmark->article_id = $request->id;
            $bookmark->user_id = Auth::user()->id;
            $bookmark->ip = $ip;
            $bookmark->bookmark = 1;

            if ($bookmark->save()) {

                $response['result'] = 'success';
                $response['message'] = 'Bookmark successfully.';

            } else {

                $response['message'] = 'Bookmark Not successfully.';
            }

        }
        return json_encode($response);
    }


    public function userComment(Request $request,$id){

        $comment=new Comment();
        $comment->comment=$request->comment;
        $comment->user_id=Auth::user()->id;
        $comment->article_id=$id;
        $comment->save();

        return redirect()->route('single.article',$id);
    }

    public function userBookmarkList(){

        $category=Category::all();
        $bookmark=ArticleBookmark::where('user_id',Auth::user()->id)
            ->get();
        if (count($bookmark)>0){
            return view('web::bookmark.bookmark',compact('category','bookmark'));
        }else{

            return redirect()->back()->with('msg','No Bookmark Article');
        }


    }

}
