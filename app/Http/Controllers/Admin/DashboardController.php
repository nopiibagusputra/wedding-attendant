<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestModel;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index(){
        $guest = GuestModel::all();
        $hadir = GuestModel::where('status',1)->count();
        return view('dashboard.index', [
            'data' => $guest,
            'hadir' => $hadir
        ]);
    }

    public function guestAcc(Request $request){
        $this->validate($request, [
            'uid' => 'required',
        ]);
    
        $data = GuestModel::where('kode_guest', $request->uid)->first();
    
        if ($data) {
            $data->status = 1;
            $data->save();
    
            $request->session()->flash('info', 'Tamu Berhasil Diubah!');
    
            Alert::success('Success', 'Tamu berhasil direkam');
    
        } else {
            Alert::error('Error', 'Data Tamu tidak ditemukan pada database');
        }
    
        return redirect('/admin/dashboard');
    
    }

    public function guestAtt(Request $request){
        $this->validate($request, [
            'uid' => 'required',
        ]);
        
        $data = GuestModel::where('kode_guest', $request->uid)->first();

        if ($data) {
            $data->status = 1;
            $data->save();
    
            $request->session()->flash('info', 'Tamu Berhasil Diubah!');
    
            Alert::success('Success', 'Tamu berhasil direkam');
    
        } else {
            Alert::error('Error', 'Data Tamu tidak ditemukan pada database');
        }
    
        return redirect('/admin/dashboard');
    }
}
