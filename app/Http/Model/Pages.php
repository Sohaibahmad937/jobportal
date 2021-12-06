<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    protected $fillable = [
        'name',
        'desc',
        'image_name',
        'created_by',
        'updated_by'
    ];

    public function PagesList($lang = NULL){
       
            $page_name = 'name';
       
        $page_object = Pages::select(
            'id',
            ''.$page_name.' as page_name',
            'created_at'
       );
        $pro = $page_object->get()->toArray();
        return $pro;
    }

    public function PageInfo($input){
        
        $page_name = 'name';
        $desc = 'desc';
        $id = $input['id'];
        $page_object = Pages::select(
            'id',
            ''.$page_name.' as page_name',
            ''.$desc.' as desc',
            'created_at'
       );
        $page_object->where('id',$id);
        $pro = $page_object->first();
        if(!empty($pro)){
            $pro->toArray();
        }else{
            $pro = [];
        }
        
        return $pro;
    }
}
