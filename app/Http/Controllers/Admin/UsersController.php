<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreUserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use DB;
use Auth;
use DataTables;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function UserList()
    {
        if (Auth::user()->role == 1) {
            $users = User::get();
        } else {
            $users = User::where('id', '!=', '1')->get();
        }
        return DataTables::of($users)
            ->addColumn('role', function ($users) {
                return '<span class="badge outline-badge-info"> ' . RoleName($users->role) . '</span>';
            })
            ->addColumn('command', function ($users) {
                $command = '';

                if (moduleacess('admin/users', 'edit')) {
                    $command .= '<a href="' . url('admin/editUser') . '/' . $users->id . '" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/users', 'delete')) {
                    $command .= ' <a href="' . url('admin/DeleteUser') . '/' . $users->id . '" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" onClick="return confirm(\'Do you realy want to delete this?\')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>';
                }
                return $command;
            })
            ->rawColumns(['edit', 'command', 'role'])
            ->make(true);
    }

    public function addUser()
    {
        if (moduleacess('admin/users', 'add') == FALSE) {
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }
        $roles = DB::table('roles')->whereNotIn('id', [1])->get();
        return view('admin.users.addUser', compact('roles'));
    }

    public function DoAddUser(Request $request)
    {
        $input = $request->all();
        $result = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'role' => $input['role']
        ]);

        if (!empty($result)) {
            session()->flash('success', 'User created!');
            return redirect()->route('admin.editUser', $result->id);
        } else {
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.users');
        }
    }

    public function editUser($id, $tab = '')
    {
        if (moduleacess('admin/users', 'edit') == FALSE) {
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }
        $roles = DB::table('roles')->whereNotIn('id', [1])->get();
        $row = User::where('id', $id)->first();
        $zipcode = [];
        return view('admin.users.editUser', compact('row', 'roles', 'tab', 'zipcode'));
    }

    public function DoChangePassword(Request $request, $id)
    {
        $input = $request->all();
        $data = [
            'password' => Hash::make($input['password'])
        ];
        $result = User::where('id', $id)->update($data);
        if (!empty($result)) {
            session()->flash('success', 'User Password Updated!');
            return redirect()->route('admin.editUser', [$id, 'tab_3']);
        } else {
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.users');
        }
    }

    public function DoEditUser(Request $request, $id)
    {
        $input = $request->all();
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'username' => $input['username'],
            'role' => $input['role']
        ];
        $result = User::where('id', $id)->update($data);
        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $imagePath = public_path('user_image');
            $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $imageData = [
                'user_image' => $imageName
            ];
            User::where('id', $id)->update($imageData);
            if ($input['hidden_image'] != '') {
                unlink($imagePath . '/' . $input['hidden_image']);
            }

        }
        if (!empty($result)) {
            session()->flash('success', 'User Personal information Updated!');
            return redirect()->route('admin.editUser', $id);
        } else {
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.users');
        }
    }


    public function CheckDuplicateUser(Request $request)
    {
        $input = $request->all();
        $email = '';
        $id = '';
        if (isset($input['email'])) $email = $input['email'];
        if (isset($input['id'])) $id = $input['id'];
        if ($id != '') {
            $row = User::where('email', $email)->where('id', '!=', $id)->first();
        } else {
            $row = User::where('email', $email)->first();
        }

        if (!empty($row)) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

    public function CheckDuplicateUsername(Request $request)
    {
        $input = $request->all();
        $username = '';
        $id = '';
        if (isset($input['username'])) $username = $input['username'];
        if (isset($input['id'])) $id = $input['id'];
        if ($id != '') {
            $row = User::where('username', $username)->where('id', '!=', $id)->first();
        } else {
            $row = User::where('username', $username)->first();
        }

        if (!empty($row)) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

    public function DeleteUser($id)
    {
        if ($id == 1) {
            session()->flash('error', 'Superadmin can not be deleted');
            return redirect()->route('admin.users');
        }
        $result = User::where('id', $id)->delete();

        if (!empty($result)) {
            session()->flash('success', 'User Deleted!');
            return redirect()->route('admin.users');
        } else {
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.users');
        }
    }

    public function saloonOwners(){
        return view('admin.users.saloonOwners.index');
    }

    public function ownersList()
    {
        $owners = User::where('role', '=', '3')->get();

        return DataTables::of($owners)
            ->editColumn('status', function ($owners) {
                if ($owners->status == 1)
                    return '<a class="btn-change_status" href="' . route('admin.owners.change_status', $owners->id) . '" data-remote="' . $owners->id . '" data-oldstatus="' . $owners->status . '"><label class="switch s-info"><input id="status" name="status" type="checkbox" class="switch s-info  mt-4 mr-2" checked value="1">
                <span class="slider round"></span></label></a>';
                else
                    return '<a class="btn-change_status" href="' . route('admin.owners.change_status', $owners->id) . '" data-remote="' . $owners->id . '" data-oldstatus="' . $owners->status . '"><label class="switch s-info"><input id="status" name="status" type="checkbox" class="switch s-info  mt-4 mr-2" value="0">
                <span class="slider round"></span></label></a>';
            })
            ->addColumn('command', function ($owners) {
                $command = '';

                if (moduleacess('admin/owners', 'edit')) {
                    $command .= '<a href="' . url('admin/editOwner') . '/' . $owners->id . '" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/owners', 'delete')) {
                    $command .= ' <a href="javascript:void(0);" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" onClick="deleteOwner('.$owners->id.')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>';
                }
                return $command;
            })
            ->rawColumns(['status', 'edit', 'command'])
            ->make(true);

    }
    public function addOwner(){
        return view('admin.users.saloonOwners.addOwner');
    }
    public function DoAddOwner(Request $request){

        $input = $request->all();

        $result = User::create([
            'username' => $input['username'],
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'password' => Hash::make($input['password']),
            'role' => 3,
            'status' => $input['status']
        ]);

        if(!empty($result)){
            return response()->json(['msg'=>'success','error'=> 0]);
        }else{
            return response()->json(['msg'=>'something went wrong','error'=> 1]);
        }
    }

    public function change_status(Request $request,$id){
        if($request->ajax()){
            $old_status = $request->old_status;
            $new_status = 0;
            if($old_status == 1){
                $new_status = 0;
            }else{
                $new_status = 1;
            }
            $manager = User::where('id',$id)->first();
            $manager->status = $new_status;
            $manager->save();
            return response()->json(['msg'=>'status Changed successfully','status'=>'200']);
        }
    }

    public function editOwner($id, $tab = '')
    {
        if (moduleacess('admin/saloonOwners', 'edit') == FALSE) {
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }
        $row = User::where('role',3)->find($id);

        return view('admin.users.saloonOwners.editOwner', compact('row','tab'));
    }

    public function DoEditOwner(Request $request, $id){

        $input = $request->all();
        if (!$request->status){
            $input['status'] = 0;
        }
        $data = [
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'status' => $input['status']

        ];
        $result = User::where('id', $id)->update($data);

        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $imagePath = public_path('user_image');
            $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $imageData = [
                'user_image' => $imageName
            ];
            User::where('id', $id)->update($imageData);
            if ($input['hidden_image'] != '') {
                unlink($imagePath . '/' . $input['hidden_image']);
            }

        }
        if (!empty($result)) {
            return response()->json(['msg'=>'Success','error'=> 0]);
        } else {
            return response()->json(['msg'=>'Something Went Wrong.','error'=> 1]);
        }
    }

    public function deleteOwner(Request $request)
    {
        if ($request->id == 1) {
            session()->flash('error', 'Superadmin can not be deleted');
            return redirect()->route('admin.users');
        }
        $result = User::where('id', $request->id)->delete();

        if (!empty($result)) {
            return response()->json(['msg'=>'Success','error'=> 0]);
        } else {
            return response()->json(['msg'=>'Something went Wrong.', 'error'=> 1]);
        }
    }

}

?>
