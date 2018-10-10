<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function relCategorySelfRelation(){
        return $this->belongsTo('Modules\Category\Models\CategorySelfRelation', 'id', 'child_category_id');
    }


    public static function get_child_category($parent, $response, $dot, $except){
        if($dot==''){
            $dot = '--';
        }

        $child_category = self::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'categories.id');

        $child_category = $child_category->where('category_self_relation.parent_category_id',$parent)
            ->select('categories.*')
            ->get();

        if(!empty($child_category)){
            foreach ($child_category as $key => $value) {

                if($except != $value->id) {
                    if (isset($response[$value->id])) {
                        $response[$value->id] .= ', ' . $dot . $value->name;
                    } else {
                        $response[$value->id] = $dot . $value->name;
                    }

                    $dot1 = $dot.' -- ';

                    $response=self::get_child_category($value->id, $response, $dot1, $except);
                }
            }
        }

        return $response;
    }


    public static function getHierarchyCategory($except=''){
        $response = [];
        $response[''] = 'Select parent category';
        $data = self::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'categories.id');


        $data = $data->where('category_self_relation.parent_category_id',NULL)
            ->select('categories.*')
            ->get();

        if(count($data) > 0){
            foreach ($data as $key => $value){
                if($except != $value->id){
                    $response[$value->id] = $value->name;


                    $dot = '   -- ';
                    $response = self::get_child_category($value->id, $response, $dot, $except);
                }
            }
        }

        return $response;
    }


    public static function get_child_category_for_selection_two($parent, $response, $counter){
        $response = [];

        $child_category = self::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'categories.id')
            ->where('category_self_relation.parent_category_id',$parent);

        $child_category = $child_category->select('categories.*')
            ->orderBy('id','asc')
            ->get();

        if(!empty($child_category)){
            foreach ($child_category as $key => $value) {

                $response[$counter]['name'] = $value->title;
                $response[$counter]['id'] = $value->id;
                $response[$counter]['slug'] = $value->slug;

                $response[$counter]['children'] = self::get_child_category_for_selection_two($value->id, $response, $counter);

                $counter++;
            }
        }

        return $response;
    }

    public static function getHierarchyCategoryForSelectionTwo($selected=[]){
        $response = [];

        $data = self::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'categories.id')
            ->where('category_self_relation.parent_category_id',NULL);


        $data = $data->select('categories.*')
            ->orderBy('id','asc')
            ->get();

        $counter = 0;
        if(count($data) > 0){
            foreach ($data as $key => $value){
                $response[$counter]['name'] = $value->name;
                $response[$counter]['id'] = $value->id;

                $response[$counter]['children'] = self::get_child_category_for_selection_two($value->id, $response, $counter);

                $counter++;
            }
        }

        return $response;
    }

}
