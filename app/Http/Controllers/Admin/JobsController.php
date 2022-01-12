<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Job;
use App\Http\Model\Categories;
use App\Http\Model\Contracts;
use App\Http\Model\Experience_Levels;
use App\Http\Model\Working_Hours;
use App\Http\Requests\Admin\JobsRequest;
use DataTables;
use Auth;
use Illuminate\Support\Str;
use App\Http\Model\AppliedJob;
use Response;



class JobsController extends Controller
{

    public function index()
    {
        return view('admin.jobs.index');
    }

    public function show(){

    }
    public function JobsList()
    {
        $role = Auth::user()->role;
        $user_id = Auth::user()->id;
        if ($role == 1 || $role == 2){
            $jobs = Job::select('jobs.*','categories.category_name as category_name','users.name as CompanyName')
                ->join('categories', function ($join) {
                    $join->on('jobs.category_id', '=', 'categories.id');
                })->join('users', function ($join) {
                    $join->on('jobs.recruiter_id', '=', 'users.id');
                })->get();
        }
        else{
            $jobs = Job::select('jobs.*','categories.category_name as category_name','users.name as CompanyName')
                ->join('categories', function ($join) {
                    $join->on('jobs.category_id', '=', 'categories.id');
                })
                ->join('users', function ($join) {
                    $join->on('jobs.recruiter_id', '=', 'users.id');
                })->where('recruiter_id',$user_id)
                ->get();
        }
        
        return DataTables::of($jobs)
            ->editColumn('recruiter_id',function ($jobs){
                    return $jobs->CompanyName;
            })
            ->addColumn('viewApplicants',function($jobs){
                $viewApplicants = '';
                    $viewApplicants .= '<a href="' . url('admin/viewApplicants') . '/' . $jobs->id . '" class="link-primary"  data-placement="top" title="View">View </a>';
                return $viewApplicants;
            })
            ->addColumn('command', function ($jobs)use($role) {
                $command = '';
                if (moduleacess('admin/jobs', 'edit')) {
                    if(($role == 3) && ($jobs->status == 0)){
                        $command .= '<a href="' . url('admin/editJobs') . '/' . $jobs->id . '" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }
                    if(($role == 1 || $role == 2)){
                        $command .= '<a href="' . url('admin/editJobs') . '/' . $jobs->id . '" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }
                }
                if (($role == 1 || $role == 2)  && ($jobs->status == 0) ) {
                    $command .= '<a href="' . url('admin/approve-job') . '/' . $jobs->id  . '" class="btn mb-2 mr-2 rounded-circle btn-outline-success" data-placement="top" title="click to approve" onClick="return confirm(\'Are You Sure You Want To Approve This?\')"><i class="fas fa-toggle-off"></i></a>';
                }
                if (moduleacess('admin/jobs', 'delete')) {
                    if(($role == 3) && ($jobs->status == 0)){
                        $command .= '<form class="table_from" action="' . route("admin.jobs.destroy", $jobs->id) . '" method="POST">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" value="delete" onClick="return confirm(\'Are You Sure You Want To Delete This?\')"><i class="fas fa-trash-alt"></i> </button>
                        </form>';
                    }
                    if(($role == 1 || $role == 2)){
                        $command .= '<form class="table_from" action="' . route("admin.jobs.destroy", $jobs->id) . '" method="POST">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" value="delete" onClick="return confirm(\'Are You Sure You Want To Delete This?\')"><i class="fas fa-trash-alt"></i> </button>
                        </form>';
                    }
                }
                return $command;
            })
            ->rawColumns(['recruiter_id','command','viewApplicants'])
            ->make(true);

    }

    public function addJobs()
    {
        $cat = Categories::pluck('category_name','id');
        $contract = Contracts::pluck('title','id');
        $experience = Experience_Levels::all();
        $workhours = Working_Hours::pluck('no_of_hours','id');
        return view('admin.jobs.addJobs',compact('cat','contract','experience','workhours'));
    }

    public function store(JobsRequest $request)
    {
        $input = $request->all();
        $status = 0;
        $role = Auth::user()->role;
        if(($role == 1) || (($role == 2)))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        $jobs = Job::create([
            'title'=> $input['title'],
            'description'=> $input['description'],
            'location'=> $input['location'],
            'category_id'=> $input['category_id'],
            'contracts_id'=> $input['contracts_id'],
            'working_hours_id'=> $input['working_hours_id'],
            'experience_level_id'=> $input['experience_level_id'],
            'status'=> $status,
            'recruiter_id'=>Auth::user()->id,
            'job_type'=> $input['job_type']
        ]);
        if ($jobs) {
            return response()->json(['error' => 0, 'msg' => 'Success']);
        }else{
            return response()->json(['error' => 1, 'msg' => 'Something went wrong!']);
        }
    }

    public function editJobs($id)
    {
        $jobs = Job::find($id);;
        $cat = Categories::pluck('category_name','id');
        $contract = Contracts::pluck('title','id');
        $experience = Experience_Levels::all();
        $workhours = Working_Hours::pluck('no_of_hours','id');
        return view('admin.jobs.editJobs',compact('jobs','cat','contract','experience','workhours'));
    }

    public function update(JobsRequest $request, $id)
    {
        $data = $request->all();
        $job = Job::where('id',$id)->update([
            'title'=> $data['title'],
            'description'=> $data['description'],
            'location'=> $data['location'],
            'category_id'=> $data['category_id'],
            'contracts_id'=> $data['contracts_id'],
            'working_hours_id'=> $data['working_hours_id'],
            'experience_level_id'=> $data['experience_level_id'],
            'job_type'=> $data['job_type']
        ]);
        if($job){
            return response()->json(['msg'=>'Success','error'=>0]);
        }
        else{
            return response()->json(['msg'=>'Something went wrong.','error'=>1]);
        }
    }

    public function destroy($id)
    {
        $jobs = Job::where('id',$id)->get();

        $data = AppliedJob::where('job_id',$id)->get();

        if(!$data)
        {
            $result =Job::where('id',$id)->delete();
        }
        else
        {
            $result =Job::where('id',$id)->delete();
            $result =  AppliedJob::where('job_id',$id)->delete();
        }

        if(!empty($result)){
             session()->flash('success', 'Jobs Deleted!');
             return redirect()->back();
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->back();
         }
    }

    public function jobApprove($id)
    {

        $result =Job::where('id',$id)->update(['status' => 1]);

        if(!empty($result)){
            session()->flash('success', 'Job Approved Successfully');
            return redirect()->back();
        }else{
            session()->flash('error', 'Something wend wrong');
            return redirect()->back();
        }

    }

    public function viewApplicants($id)
    {
        // dd($id);
        $applicants = AppliedJob::where('job_id',$id)
            ->leftJoin('users','users.id','=','applied_jobs.user_id')
            ->select('applied_jobs.*','users.name as userName')
            ->get();  
         return view('admin.jobs.viewApplicants',compact('applicants'));
    }
    public function DownloadResume($id)
    {
        $filePath = public_path('Resumes/');
        $data = AppliedJob::find($id);
        $resume = $data->resume;
        $downloadFile = $filePath.$resume;
        return Response::download($downloadFile);
    }
}
