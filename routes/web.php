<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SimpleMiddleware;
use App\Http\Controllers\Company;
use App\Http\Controllers\Order;
use App\Http\Controllers\Donhang;
use App\Http\Controllers\Khohang;
use App\Http\Controllers\tongquan;
use App\Http\Controllers\login;
use App\Http\Controllers\congcukhac;
use App\Http\Middleware\kiemtraadmin;
Route::get('/login',[login::class,'index'])->name('login');
Route::post('/check',[login::class,'check']);
Route::get('/thoat',[login::class,'logout']);
Route::middleware(['kiemtradangnhap'])->group(function () {
	Route::get('/viewcustumer',[Company::class,'index']);
	Route::get('/addcompany',[Company::class,'create']);
	Route::get('/editcompany/{id}',[Company::class,'show']);
	Route::get('/deletecompany/{id}',[Company::class,'destroy']);
	Route::post('/editcompany',[Company::class,'edit']);
	Route::post('/giahandonhang/{id}',[Donhang::class,'giahandonhang']);
	Route::post('/capnhatghichu/{id}',[Donhang::class,'capnhatghichu']);
	Route::post('/capnhatloi/{id}',[Donhang::class,'capnhatloi']);
	Route::get('/xuliloi/{id}',[Donhang::class,'xuliloi']);
	Route::post('/capnhatxuliloi',[Donhang::class,'capnhatxuliloi']);
	Route::post('/thaydoithietbi',[Donhang::class,'thaydoithietbi']);
	Route::get('/danhsachdonhang',[Donhang::class,'index'])->name('danhsachdonhang');
	Route::get('/lichsudonhang',[Donhang::class,'lichsudonhang']);
	Route::get('/',[Donhang::class,'index'])->middleware('kiemtradangnhap');
	Route::get('/taoyeucau',[Donhang::class,'createRequest'])->name('taoyeucau');
	Route::get('/yeucaukhachhang/{id}',[Donhang::class,'yeucaukhachhang']);
	Route::get('/xuliyeucau/{id}',[Donhang::class,'xuliyeucau'])->name('xuliyeucau');
	Route::get('/xuliyeucau1/{id}',[Donhang::class,'xuliyeucau1'])->name('xuliyeucau1');
	Route::post('/post_suayeucau',[Donhang::class,'suayeucau'])->name('suayeucau');
	Route::post('/post_suayeucau1',[Donhang::class,'suayeucau1'])->name('suayeucau1');
	Route::get('/chuyentiepyeucau/{id}',[Donhang::class,'chuyentiepyeucau'])->name('chuyentiepyeucau');
	Route::post('/taodonhang',[Donhang::class,'taodonhang'])->name('taodonhang');
	Route::get('/chitietdonhang/{id}',[Donhang::class,'chitietdonhang'])->name('chitietdonhang');
	Route::get('/',[Company::class,'index']);
	Route::post('/post_addcompany',[Company::class,'store']);
	Route::post('/post_taoyeucau',[Donhang::class,'post_taoyeucau']);
	Route::get('/danhsachyeucau',[Donhang::class,'danhsachyeucau']);
	Route::get('/xoayeucau/{id}',[Donhang::class,'xoayeucau']);
	Route::get('/xoayeucau1/{id}',[Donhang::class,'xoayeucau1']);
	Route::get('/ketthucdonhang/{id}',[Donhang::class,'ketthucdonhang']);
	Route::post('/layhang',[Donhang::class,'layhang']);
	Route::post('/laycauhinh',[Donhang::class,'laycauhinh']);
	Route::post('/laythongtinkhachhang',[Donhang::class,'laythongtinkhachhang']);
	Route::get('/tongquankhohang',[Khohang::class,'tongquankhohang']);
	Route::get('/danhsachtongthietbi',[Khohang::class,'danhsachtongthietbi']);
	Route::get('/nhapmoithietbi',[Khohang::class,'nhapmoithietbi']);
	Route::post('/nhapmoithietbi',[Khohang::class,'post_nhapmoithietbi']);
	Route::get('/thietbicongty',[Khohang::class,'thietbicongty']);
	Route::get('/thietbidoitac',[Khohang::class,'thietbidoitac']);
	Route::post('/laysoluongton',[Khohang::class,'laysoluongton']);
	Route::post('/xuatthietbisua',[Khohang::class,'xuatthietbisua']);
	Route::post('/xuattrathietbi',[Khohang::class,'xuattrathietbi']);
	Route::post('/laydulieutonkho',[Khohang::class,'laydulieutonkho']);
	Route::post('/laydulieudonhang',[Khohang::class,'laydulieudonhang']);
	Route::post('/dangkitaikhoan',[login::class,'dangkitaikhoan']);
	Route::get('/destroy/{id}',[login::class,'destroy']);
	Route::get('/caidattaikhoan',[login::class,'caidattaikhoan'])->middleware('kiemtraadmin');
	Route::get('/kiemtrathietbi',[Khohang::class,'kiemtrathietbi']);
	Route::get('/todolist',[congcukhac::class,'todolist']);
	Route::post('/kiemtrathietbi/thietbi',[Khohang::class,'kiemtrathietbi_thietbi']);
	Route::get('/view_listorder',[Order::class,'index']);
	Route::get('/test',function(){return view('detail.test.table');});
	Route::get('/tongquan',[tongquan::class,'index']);
	Route::get('/xulimayloi/{id}',[Khohang::class,'xulimayloi']);
	Route::post('/capnhatthietbisua',[Khohang::class,'capnhatthietbisua']);
	Route::get('/thongbaoloi',[login::class,'thongbaoloi']);
	Route::get('/doimatkhau',[login::class,'doimatkhau']);
	Route::post('/xacnhandoimatkhau',[login::class,'xacnhandoimatkhau']);

});
Route::fallback(function () {return back()->withError('L???i r???i nh??');}); //Khi router khong dung thi xuat hien cai nay

