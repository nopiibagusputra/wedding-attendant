<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;


class ManagementController extends Controller
{

    public function store(Request $request){

        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|max:100|email',
            'level' => 'required',
            'password'  => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'active'=> '1',
            'password'  => bcrypt($request->password),
            'remember_token' => Str::random(60),
            'verificationcode' => Str::random(20),
        ]);

        $request->session()->flash('info', 'Pengguna Berhasil Ditambahkan!');
        return redirect('/admin/users/list');

    }
    
    public function show(){
        $users = User::all();
        return view('admin.user.list_user', [
            'data' => $users
        ]);
    }


    public function update($id, Request $request){
        $iData = decrypt($id);
        
        if($request->password != ''){
            $this->validate($request, [
                'name_edit'  => 'required|max:255',
                'email_edit' => 'required|max:100|email',
                'level_edit' => 'required',
                'password_edit'  => 'required|confirmed',
                'users_status'  => 'required|numeric',
                'password_confirmation_edit' => 'required|same:password',
            ]);

            $data           = User::find($iData);
            $data->name     = $request->name_edit;
            $data->email    = $request->email_edit;
            $data->level    = $request->level_edit;
            $data->active    = $request->users_status;
            $data->password = bcrypt($request->password_edit);
            $data->save();

            $request->session()->flash('info', 'Pengguna Berhasil Diubah!');
            return redirect('/admin/users/list');

        }else {
            $this->validate($request, [
                'name_edit'  => 'required|max:255',
                'email_edit' => 'required|max:100|email',
                'level_edit' => 'required',
                'users_status'  => 'required|numeric',
            ]);

            $data           = User::find($iData);
            $data->name     = $request->name_edit;
            $data->email    = $request->email_edit;
            $data->level    = $request->level_edit;
            $data->active    = $request->users_status;
            $data->save();

            $request->session()->flash('info', 'Pengguna Berhasil Diubah!');
            return redirect('/admin/users/list');
        }
        
    }

    public function delete($id){
        $iData = decrypt($id);
        $users = User::find($iData);
        $users->delete();

        return redirect('/admin/users/list')->with([
            'success' => 'Pengguna Berhasil Dihapus!'
        ]);
    }

}
