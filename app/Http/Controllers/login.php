<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App;
use Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {   
        $a = $request->email;
        $b = $request->password;
      

        if (Auth::attempt(['email'=>$a,'password'=>$b ])) {
            $user = DB::table('users')->where('email',$a)->max('chucvu');
            $tennhanvien = User::where('email',$a)->first('name');
            session(['_loainhanvien' => $user, '_tennhanvien' => $tennhanvien['name']]);
            $request->session()->regenerate();
            return redirect('/');

        }else
        {

            return redirect('/login')->withErrors('Sai tên đăng nhập, hoặc mật khẩu');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function caidattaikhoan()
    {
        $data_user = DB::table('users')->get();
        return view('login.caidattaikhoan',compact('data_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function dangkitaikhoan(Request $request)
    {
        // return $request;
        $newus = new User;
        $newus->name = $request->tennhanvien;
        $newus->email = $request->tendangnhap;
        $newus->password = Hash::make($request->matkhau);
        $newus->chucvu = $request->chucvu;
        $newus->save();
        return redirect('/caidattaikhoan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function thongbaoloi()
    {
        return view('login.thongbaoloi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $xoa = DB::table('users')->where('id','=',$id)->delete();
        return back();
    }
    function doimatkhau(){
        return view('login.doimatkhau');
    }
    function xacnhandoimatkhau(Request $request){
        // return $request;
        $mkcu = $request->matkhaucu;
        $mkmoi1 = $request->matkhaumoi1;
        $mkmoi2 = $request->matkhaumoi2;

            if (Auth::attempt(['tennhanvien'=>session('_tennhanvien'),'password'=>$mkcu])) {
                return '123';
            }
            // return back()->withErrors('Mât khẩu mới không trùng khớp');
        return $tennhanvien = session('_tennhanvien');
            
        }
}
