<?php
namespace Modules\Category\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Category\Models\Category;
use Modules\Category\Models\CategorySelfRelation;

class CategoryController extends Controller
{

    protected function isGetRequest(){
        return Input::server("REQUEST_METHOD") == "GET";
    }

    protected function isPostRequest(){
        return Input::server("REQUEST_METHOD") == "POST";
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if (Auth::user()->type=='admin'){
            $category=Category::all();
            return view('category::category.index',compact('category'));
        }else{

            return \redirect()->back();
        }

    }

    public function create(){

        $parent_options = Category::getHierarchyCategory('');

        return view('category::category.create',compact('category','parent_options'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'parent_category' => 'required',
            'name' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {

            return Redirect::route('category.create')->withErrors($validator)->withInput();
        }

        if(isset($_POST['parent_category'])){
            $category_self_relation = new CategorySelfRelation();
            if($_POST['parent_category'] != ''){
                $category_self_relation->parent_category_id = $_POST['parent_category'];
            }
            else{
                $category_self_relation->parent_category_id = NULL;
            }
        }


        if ($request->has('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img');
            $image->move($destinationPath, $imagename);

            $category = new Category();
            $category->name = $request->name;
            $category->image = $imagename;

            if ( $category->save()){

                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $category->id;
                    $category_self_relation->save();
                }
            }

            return Redirect::route('category.index')->with('msg','Category Created Successfully');
        }
    }

    public function show($id)
    {
        $category=Category::find($id);
        return view('category::category.show',compact('category'));
    }

    public function edit($id){

        $category = Category::where('id', $id)
            ->select('categories.*')
            ->first();

        if(count($category) <= 0){
            Session::flash('danger', 'Category data not found.');
            return redirect()->route('category.index');
        }

        $category_self_relation = $category->relCategorySelfRelation;
        if(count($category_self_relation) > 0){
            $category->parent_category = $category_self_relation->parent_category_id;
        }

        $parent_options = Category::getHierarchyCategory($category->id);

        return view('category::category.edit',compact('category','parent_options'));

    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'parent_category' => 'required',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {

            return Redirect::route('category.edit',$id)->withErrors($validator)->withInput();
        }

        $model = Category::where('id', $id)
            ->select('categories.*')
            ->first();

        if(isset($_POST['parent_category'])){
            $category_self_relation = $model->relCategorySelfRelation;
            if(count($category_self_relation) == 0){
                $category_self_relation = new CategorySelfRelation();
            }

            if($_POST['parent_category'] != ''){
                $category_self_relation->parent_category_id = $_POST['parent_category'];
            }
            else{
                $category_self_relation->parent_category_id = NULL;
            }
        }

        if ($request->has('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img');
            $image->move($destinationPath, $imagename);

            $category = Category::find($id);
            $category->name = $request->name;
            $category->title = $request->title;
            $category->image = $imagename;

            if ($category->save()){
                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $model->id;
                    $category_self_relation->save();

                    return Redirect::route('category.index',$id)->with('msg','Category Updated Successfully');
                }
            }


        }else{

            $category = Category::find($id);
            $category->name = $request->name;
            $category->title = $request->title;

            if ($category->save()){
                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $model->id;
                    $category_self_relation->save();

                    return Redirect::route('category.index',$id)->with('msg','Category Updated Successfully');
                }
            }

        }

    }

    public function delete(Request $request){

        $category=Category::find($request->id);
        $category->delete();

        return \response($category);

    }



}