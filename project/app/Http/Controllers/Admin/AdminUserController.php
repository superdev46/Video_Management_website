<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        // foreach ($users as $user) {
        //     echo $user->category->cat_name;
        // }
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        $cats = Category::all();
        return view('admin.user.create',compact('cats'));
    }

    public function store(StoreValidationRequest $request)
    {
        $user = new User;
        $input = $request->all();        
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);           
            $input['photo'] = $name;
            } 

            if($request->is_featured == "")
            {
                $input['is_featured'] = 0;
            }
        $input['password'] = bcrypt($request['password']);
        $user->fill($input)->save();
        Session::flash('success', 'New User added successfully.');
        return redirect()->route('admin-user-index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $cats = Category::all();
        return view('admin.user.edit',compact('user','cats'));
    }

    public function update(UpdateValidationRequest $request,$id)
    {

        $input = $request->all(); 
        $user = User::findOrFail($id);        
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($user->photo != null)
                {
                    unlink(public_path().'/assets/files/images/'.$user->photo);
                }            
            $input['photo'] = $name;
            } 

        if(!empty($input['password'])){
        $input['password'] = bcrypt($request['password']);

        }
        else{
         $input['password'] = $user->password;    
        } 
        if($request->is_featured == "")
        {
            $input['is_featured'] = 0;
        }
        $user->update($input);
        Session::flash('success', 'Successfully updated the User');
        return redirect()->route('admin-user-index');
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if($user->photo == null){
         $user->delete();
        Session::flash('success', 'Successfully deleted your User');
        return redirect()->route('admin-user-index');
        }

        unlink(public_path().'/assets/files/images/'.$user->photo);
        $user->delete();
        Session::flash('success', 'Successfully deleted your HandyMan');
        return redirect()->route('admin-user-index');
    }
}


