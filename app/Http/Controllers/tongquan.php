<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class tongquan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $start =  date('Y-m-01');
        $end =  date('Y-m-t');;
        $soluonghong = DB::table('danhsachthietbisua')->where('tinhtrang',1)->count(); //ok
        $slmanhinh = DB::table('danhsachtongthietbi')->where('chungloai',68)->sum('soluong');
        $sllaptop = DB::table('danhsachtongthietbi')->where('chungloai',1)->sum('soluong');
        $slpc = DB::table('danhsachtongthietbi')->where('chungloai',2)->sum('soluong');
        $sltongdonhang = DB::table('danhsachyeucau')->where('tinhtrang',2)->count(); //Số lượng đơn hàng đang thực hiện
        $slthangdonhang = DB::table('danhsachyeucau')->where('tinhtrang',2)->where('created_at','<',$end)->where('created_at','>',$start)->count(); //Số lượng đơn hàng mới trong tháng này
        $sltongkhach = DB::table('data_company')->count(); //Tổng số khách hàng
        $slthangkhach = DB::table('data_company')->where('created_at','<',$end)->where('created_at','>',$start)->count(); //Số lượng đơn hàng đang thực hiện
        $sldhketthuc = DB::table('danhsachyeucau')->where('tinhtrang',1000)->count();
        $slthangloi = DB::table('bangthongbaoloi')->where('created_at','<',$end)->where('created_at','>',$start)->count();

        return view('detail.tongquan.tongquan',compact('soluonghong','slmanhinh','sllaptop','slpc','slthangdonhang','sltongdonhang','sltongkhach','slthangkhach','sldhketthuc','slthangloi'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
