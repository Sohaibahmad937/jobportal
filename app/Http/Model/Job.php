<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    
    protected $table = 'jobs';
    protected $fillable = [
        'title',
        'description',
        'location',
        'category_id',
        'contracts_id',
        'working_hours_id',
        'experience_level_id',
        'status',
        'recruiter_id',
        'job_type'
    ];
    
    public function GetJobListing($input = []){

        $CategoryIds = null;
        if (isset($input['categories'])) {
            $id = (integer)$input['categories'];
            $CategoryIds = [];
            $childs = Categories::select('id')->where('parent_id',$id)->get();
            foreach($childs as $child){
                $CategoryIds[] = $child->id;
            }
            array_push($CategoryIds,$id);
        }

        $ExperianceIds = [];
        if (isset($input['ExpIds'])) {
            $exid = explode(',', $input['ExpIds']);
          $ExperianceIds = array_map('intval', $exid);

        }

        $JobTypes = [];
        if (isset($input['Jobtype'])) {
            $jobype = explode(',', $input['Jobtype']);
          $JobTypes = array_map('intval', $jobype);

        }

        $Text = null;
        if (isset($input['keywords'])) {
          $Text = $input['keywords'];
        }

        $job_listing_obj = Self::whereNotNull('jobs.id');

        $job_listing_obj->leftJoin('experience_levels',function($join){
                $join->on('experience_levels.id','=','jobs.experience_level_id');
            });

        $job_listing_obj->leftJoin('categories',function($join) {
                $join->on('categories.id','=','jobs.category_id');
            });
        $job_listing_obj->leftJoin('users',function($join) {
                $join->on('users.id','=','jobs.recruiter_id');
            });

        if(!empty($ExperianceIds)){
            $job_listing_obj->whereIn('experience_level_id',$ExperianceIds);
        }

        if(!empty($CategoryIds)){
            $job_listing_obj->whereIn('category_id',$CategoryIds);
        }

        if(!empty($JobTypes)){
            $job_listing_obj->whereIn('job_type',$JobTypes);
        }
        
        if($Text != ""){
            $job_listing_obj->where('jobs.title', 'like', '%'.$Text.'%');
        }
        //print_r($CategoryIds);echo '<pre>';print_r($ExperianceIds);echo '<pre>';print_r($Text);echo '<pr>';
        $job_listing_obj->select('jobs.*','experience_levels.from_year','experience_levels.to_year','categories.category_name','users.name');

        // if(isset($input->categories)){

        //     $id = (integer)$input->categories;
        //     $cate = [];
        //     $childs = Categories::select('id')->where('parent_id',$id)->get();
        //     foreach($childs as $child){
        //         $cate[] = $child->id;
        //     }
        //     array_push($cate,$id);//dd($cate);
        //     $job_listing_obj->whereIn('category_id',$cate);
        // }
        // if(isset($input->ExpIds)){//dd($request->all());
        //    $exp = array_map('intval', explode(',', $input['ExpIds']));//explode(',',$request->ExpIds);

        //    $job_listing_obj->whereIn('experience_level_id',$exp);
        // }
        // if(isset($input->keywords)){
        //     $job_listing_obj->where('jobs.title', 'like', '%'.$input->keywords.'%');
        // }
        // print_r($job_listing_obj);die;
        $job_listing = $job_listing_obj->orderByDesc('jobs.id')->get();
        return $job_listing;
    }
}
