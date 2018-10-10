<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySelfRelation extends Model
{
    protected $table='category_self_relation';

    protected $fillable = [
        'parent_category_id',
        'child_category_id',
        'created_by',
        'updated_by',
    ];


//relations
    public function relParentCategory(){
        return $this->belongsTo('Modules\Category\Models\Category','parent_category_id','id');
    }

    public function relChildCategory(){
        return $this->belongsTo('Modules\Category\Models\Category','child_category_id','id');
    }



}
