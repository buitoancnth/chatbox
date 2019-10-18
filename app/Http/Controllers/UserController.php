<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(auth()->user()->permissions);
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'.($input['password'] !== null ? '|min:8' : ''),
            'roles' => 'required',
        ]);
        
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $image_path_old = public_path() . "uploads/avatars/" . $user->avatar;
        if (File::exists($image_path)) {
            unlink($image_path_old);
        }
        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully');
    }

    public function editProfile(Request $request){
        $input = $request->all();
        $user = auth()->user();
        $id = auth()->user()->id;
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'same:confirm-password'.($input['password'] !== null ? '|min:8' : '' ),
            'birth_day' => 'date',
        ]);

        if(isset($input['file_avatar'])){
            $image_path_old = public_path() . "/uploads/avatars/" . $user->avatar;
            if (File::exists($image_path_old)) {
                unlink($image_path_old);
            }

            $data = $input['avatar_name'];            
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= $id.'.png';
            $path = public_path() . "/uploads/avatars/" . $image_name;
            file_put_contents($path, $data);
            $input['avatar'] = $image_name;
        }
        
        if(isset($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, ['password']);
        }

        // dd($input);
        $user->update($input);

        return redirect()->route('profile.index')
                        ->with('success', 'Updated profile sucessfuly !');
    }
}
