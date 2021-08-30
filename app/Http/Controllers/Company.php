<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\data_company;

class Company extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idmax = DB::table('data_company')->max('makhachhang');
        $idmax = $idmax +1;
        $data_company = DB::table('data_company')->get();
        return view('detail.company.listcompany',compact('data_company','idmax'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idmax = DB::table('data_company')->max('makhachhang');
        $idmax = $idmax +1;
      return view('detail.company.addcompany',compact('idmax'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newdata = new data_company;
        $newdata->masothue = $request->masothue;
        $newdata->tencongty = $request->tencongty;
        $newdata->loaikhachhang = $request->loaikhachhang;
        $newdata->daidien = $request->daidien;
        $newdata->dienthoai = $request->dienthoai;
        $newdata->email = $request->email;
        $newdata->diachi = $request->diachi;
        $newdata->ghichu = $request->ghichu;
        $newdata->save();
        return redirect('viewcustumer');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
         $id = $id;
        $datacompanyedit = DB::table('data_company')->where('makhachhang',$id)->get();
        foreach ($datacompanyedit as $key) {
            $tencongty = $key->tencongty;
            $daidien = $key->daidien;
        }
        $data_danhsachyeucau  = DB::table('danhsachyeucau')
                                ->where('id_khachhang',$id)
                                ->get();       
        return view('detail.company.editcompany',compact('datacompanyedit','data_danhsachyeucau'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $newdata = data_company::find($request->makhachhang);
        $newdata->masothue = $request->masothue;
        $newdata->tencongty = $request->tencongty;
        $newdata->loaikhachhang = $request->loaikhachhang;
        $newdata->daidien = $request->daidien;
        $newdata->dienthoai = $request->dienthoai;
        $newdata->email = $request->email;
        $newdata->diachi = $request->diachi;
        $newdata->ghichu = $request->ghichu;
        $newdata->save();
        return redirect()->route('viewcustumer');
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
    public function destroy($id, Request $request)
    {

        $newdata = data_company::find($id);
        $newdata->delete();
        return redirect()->route('viewcustumer');
    }
    function todolist(){
          $idmax = DB::table('data_company')->max('makhachhang');
        $idmax = $idmax +1;
      return view('detail.company.addcompany',compact('idmax'));
    }
}
