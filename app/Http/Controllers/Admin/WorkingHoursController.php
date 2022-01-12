<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Working_Hours;
use App\Http\Requests\Admin\WorkingHoursRequest;
use DataTables;


class WorkingHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.working_hours.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.working_hours.create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkingHoursRequest $request)
    {
        $data = $request->all();
        $hours = Working_Hours::create([
            'no_of_hours'=>$data['no_of_hours']
        ]);
        if ($hours) {
            return response()->json(['error' => 0, 'msg' => 'Success']);
        }else{
            return response()->json(['error' => 1, 'msg' => 'Something went wrong!']);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workhours = Working_Hours::find($id);
        return view('admin.working_hours.edit',compact('workhours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkingHoursRequest $request, $id)
    {
        $hours = Working_Hours::find($id);
        $hours->no_of_hours = $request->no_of_hours;
        $result = $hours->update();
        if($result){
            return response()->json(['msg'=>'Success','error'=>0]);
        }
        else{
            return response()->json(['msg'=>'Something went wrong.','error'=>1]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Working_Hours::where('id',$id)->delete();

        if(!empty($result)){
             session()->flash('success', 'Working Hours Deleted!');
             return redirect()->back();
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->back();
         }
    }
    public function WorkingHoursList()
    {
        $workhours = Working_Hours::all();
        return DataTables::of($workhours)
            ->addColumn('command', function ($workhours) {
                $command = '';  
                if (moduleacess('admin/working_hours', 'edit')) {
                    $command.='<a href="javascript:void(0);" onclick = "EditHourModel(\''.url('admin/working_hours/'.$workhours->id.'/edit').'\')"  class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/working_hours', 'delete')) {
                    $command .= '<form class="table_from" action="' . route("admin.working_hours.destroy", $workhours->id) . '" method="POST">
                ' . method_field('DELETE') . '
                ' . csrf_field() . '
                <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" value="delete" onClick="return confirm(\'Are You Sure You Want To Delete This?\')"><i class="fas fa-trash-alt"></i> </button>
                </form>';
                }
                return $command;
            })
            ->rawColumns(['command'])
            ->make(true);
   }
}
