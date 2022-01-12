<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Contracts;
use App\Http\Requests\Admin\ContractsRequest;
use Yajra\DataTables\DataTables;

class ContractsController extends Controller
{
    public function index()
    {
        return view('admin.contracts.index');
    }

    public function ContractsList()
    {
        $contracts = Contracts::all();
        return DataTables::of($contracts)
            ->addColumn('command', function ($contracts) {
                $command = '';
                if (moduleacess('admin/contracts', 'edit')) {
                    $command.='<a href="javascript:void(0);" onclick = "EditContractModel(\''.url('admin/contracts/'.$contracts->id.'/edit').'\')"  class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/contracts', 'delete')) {
                    $command .= '<form class="table_from" action="' . route("admin.contracts.destroy", $contracts->id) . '" method="POST">
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
        return view('admin.contracts.create');
    }

    public function store(ContractsRequest $request)
    {
        $data = $request->all();
        $contract = Contracts::create([
            'title'=>$data['title']
        ]);
        if ($contract) {
            return response()->json(['error' => 0, 'msg' => 'Success']);
        }else{
            return response()->json(['error' => 1, 'msg' => 'Something went wrong!']);
        }
    }

    public function edit($id)
    {
        $contract_data = Contracts::find($id);
        return view('admin.contracts.edit',compact('contract_data'));
    }

    public function update(ContractsRequest $request, $id)
    {
        $contract = Contracts::find($id);
        $contract->title = $request->title;
        $result = $contract->update();
        if($result){
            return response()->json(['msg'=>'Success','error'=>0]);
        }
        else{
            return response()->json(['msg'=>'Something went wrong.','error'=>1]);
        }
    }

    public function destroy($id)
    {
        $result = Contracts::where('id',$id)->delete();

        if(!empty($result)){
             session()->flash('success', 'Contracts Deleted!');
             return redirect()->back();
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->back();
         }
    }

}
