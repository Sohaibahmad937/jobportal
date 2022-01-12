<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Experience_Levels;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\ExperienceLevelsRequest;
use Yajra\DataTables\DataTables;

class Experience_LevelsController extends Controller
{
    public function index()
    {
        return view('admin.experience_levels.index');
    }

    public function ExperienceLevelsList()
    {
        $experience_level = Experience_Levels::all();
        return DataTables::of($experience_level)
            ->addColumn('command', function ($experience_level) {
                $command = '';
                if (moduleacess('admin/experience_levels', 'edit')) {
                    $command.='<a href="javascript:void(0);" onclick = "Edit_ExperienceModel(\''.url('admin/experience_levels/'.$experience_level->id.'/edit').'\')"  class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/experience_levels', 'delete')) {
                    $command .= '<form class="table_from" action="' . route("admin.experience_levels.destroy", $experience_level->id) . '" method="POST">
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

    public function create()
    {
        return view('admin.experience_levels.create');
    }

    public function store(ExperienceLevelsRequest $request)
    {
        $data = $request->all();
        $different_exp = Experience_Levels::where('from_year',$data['from_year'])
        ->where('to_year',$data['to_year'])->first();
        if(!$different_exp){
            $experience = Experience_Levels::create([
                'from_year'=>$data['from_year'] ?? 0,
                'to_year'=>$data['to_year']
            ]);
            if($experience){
                $returndata = ['error' => 0, 'msg' => "Success"];
            }else{
                $returndata = ['error' => 1, 'msg' => "Error"];
            }
        }else{
            $returndata = ['error' => 1,'msg' => 'Already Available'];
        }

        return response()->json($returndata);
       
        // if ($experience) {
        //     return response()->json(['error' => 0, 'msg' => 'Success']);
        // }else{
        //     return response()->json(['error' => 1, 'msg' => 'Something went wrong!']);
        // }
    }

    public function edit($id)
    {
        $experience_data = Experience_Levels::find($id);
        return view('admin.experience_levels.edit',compact('experience_data'));
    }


    public function update(ExperienceLevelsRequest $request, $id)
    {
        $experience = Experience_Levels::find($id);
        $unique_exp = Experience_Levels::where('from_year',$request['from_year'])
        ->where('to_year',$request['to_year'])->first();

        if(!$unique_exp){
            $experience->from_year = $request->from_year;
            $experience->to_year = $request->to_year;
            $result = $experience->update();
            if($result){
                $returndata = ['error' => 0, 'msg' => "Success"];
            }
            else{
                $returndata = ['error' => 1, 'msg' => "Error"];
            }
        }else{
            $returndata = ['error' => 1,'msg' => 'Already Available'];
        }

        return response()->json($returndata);

        
    }

    public function destroy($id)
    {
        $result = Experience_Levels::where('id',$id)->delete();

        if(!empty($result)){
             session()->flash('success', 'Experience level Deleted!');
             return redirect()->back();
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->back();
         }
    }


}
