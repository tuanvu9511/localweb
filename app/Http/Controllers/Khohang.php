<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\danhsachtongthietbi;
use App\Models\hang;
use App\Models\loaimay;
use App\Models\cauhinh;
use App\Models\chusohuu;
use App\Models\lichsucapnhatkhohang;
use App\Models\thietbicongty;
use App\Models\danhsachdonvisua;
use App\Models\danhsachthietbisua;
use App\Models\lichsutrathietbidoitac;
use App\Models\danhsachyeucau;


class Khohang extends Controller
{
    function tongquankhohang(){
        return view('detail.khohang.khohang');
    }
    function nhapmoithietbi(){
        $loaimay=DB::table('loaimay')->get()->all();
        $chusohuu=chusohuu::get()->all();
        $option_loaimay = "<option hidden>Chọn Loại</option>";
        foreach ($loaimay as $key) {
        $option_loaimay .= '<option value="'.$key->id.'">'.$key->tenloaimay.'</option>';} ;
        $option_chusohuu = "";
        foreach ($chusohuu as $key) {
        $option_chusohuu .= '<option value="'.$key->id.'">'.$key->tenchusohuu.'</option>';} ;
        return view('detail.khohang.nhapmoithietbi',compact('loaimay','chusohuu','option_loaimay','option_chusohuu'));
    }
    function post_nhapmoithietbi(Request $request){
        $chungloaimoi = $request->chungloaimoi;
        $hangmoi = $request->hangmoi;
        $cauhinhmoi = $request->cauhinhmoi;
        $chusohuumoi = $request->chusohuumoi;
        if($chusohuumoi == 1){
            $nhap_chusohuu = new chusohuu;
            $nhap_chusohuu->tenchusohuu = $request->ip_chusohuu;
            $nhap_chusohuu->save();
            $id_chusohuu = chusohuu::where('tenchusohuu','=',$request->ip_chusohuu)->select('id')->get();
            foreach ($id_chusohuu as $key){ $id_chusohuu = $key->id;};
        };
        if($chusohuumoi == 0){
            $id_chusohuu = $request->sl_chusohuu;

        };

        if ($chungloaimoi == 0 AND $hangmoi == 0 AND $cauhinhmoi == 0) {
            $soluongcu = 0;
            $mathietbi = $request->sl_loaimay.$request->sl_hang.$request->sl_cauhinh.$id_chusohuu;

            if(danhsachtongthietbi::where('mathietbi','=',$mathietbi)->exists())
            {
            $nhap = danhsachtongthietbi::where('mathietbi','=',$mathietbi)->get();
            foreach ($nhap as $key) {$soluongcu = $soluongcu + $key->soluong; };
            $soluongmoi = $request->soluong +  $soluongcu;
            $nhap2 = danhsachtongthietbi::where('mathietbi','=',$mathietbi)->update(['soluong' => $soluongmoi]);
            }
            else{
                $nhap11 = new danhsachtongthietbi;
                $nhap11->mathietbi = $request->sl_loaimay.$request->sl_hang.$request->sl_cauhinh.$id_chusohuu;
                $nhap11->chungloai = $request->sl_loaimay;
                $nhap11->hang = $request->sl_hang;
                $nhap11->cauhinh = $request->sl_cauhinh;
                $nhap11->soluong = $request->soluong;
                $nhap11->chusohuu = $id_chusohuu;
                $nhap11->save();
            };
            $idloaimay = $request->sl_loaimay;
            $idhang = $request->sl_hang;
            $idcauhinh = $request->sl_cauhinh;
            $id_chusohuu = $id_chusohuu;


            
        }
        if ($chungloaimoi == 0 AND $hangmoi == 0 AND $cauhinhmoi == 1) {

            $db_cauhinh = new cauhinh;
            $db_cauhinh->tencauhinh = $request->ip_cauhinh;
            $db_cauhinh->id_hang = $request->sl_hang;
            $db_cauhinh->save();
            $id_cauhinh = cauhinh::where('tencauhinh',$request->ip_cauhinh)->select('id')->get();
            foreach ($id_cauhinh as $key) {$id_cauhinh=$key->id; };

            $nhap2 = new danhsachtongthietbi;
            $nhap2->mathietbi = $request->sl_loaimay.$request->sl_hang.$id_cauhinh.$id_chusohuu;
            $nhap2->chungloai = $request->sl_loaimay;
            $nhap2->hang = $request->sl_hang;
            $nhap2->cauhinh = $id_cauhinh;
            $nhap2->soluong = $request->soluong;
            $nhap2->chusohuu = $id_chusohuu;
            $nhap2->save();
            $idloaimay = $request->sl_loaimay;
            $idhang = $request->sl_hang;
            $idcauhinh = $id_cauhinh;
            $id_chusohuu = $id_chusohuu;

        }
        if ($chungloaimoi == 0 && $hangmoi == 1 && $cauhinhmoi == 1) {
            $db_hang = new hang;
            $db_hang->tenhang = $request->ip_hang;
            $db_hang->id_loaimay = $request->sl_loaimay;
            $db_hang->save();
            $id_hang = hang::where('tenhang',$request->ip_hang)->select('id')->get();
            foreach ($id_hang as $key) {$id_hang=$key->id;};
            $db_cauhinh = new cauhinh;
            $db_cauhinh->tencauhinh = $request->ip_cauhinh;
            $db_cauhinh->id_hang = $id_hang;
            $db_cauhinh->save();
            $id_cauhinh = cauhinh::where('tencauhinh',$request->ip_cauhinh)->select('id')->get();
            foreach ($id_cauhinh as $key) {$id_cauhinh=$key->id; };

            $nhap3 = new danhsachtongthietbi;
            $nhap3->mathietbi = $request->sl_loaimay.$id_hang.$id_cauhinh.$id_chusohuu;
            $nhap3->chungloai = $request->sl_loaimay;
            $nhap3->hang = $id_hang;
            $nhap3->cauhinh = $id_cauhinh;
            $nhap3->soluong = $request->soluong;
            $nhap3->chusohuu = $id_chusohuu;
            $nhap3->save();
            $idloaimay = $request->sl_loaimay;
            $idhang = $id_hang;
            $idcauhinh = $id_cauhinh;
            $id_chusohuu = $id_chusohuu;


        }
        if ($chungloaimoi == 1 && $hangmoi == 1 && $cauhinhmoi == 1) {
            $db_chungloai = new loaimay;
            $db_chungloai->tenloaimay = $request->id_loaimay;
            $db_chungloai->save();
            $request->id_loaimay;

            $id_loaimay = DB::table('loaimay')->where('tenloaimay','=',$request->id_loaimay)->select('id')->get();
            foreach ($id_loaimay as $key) {$id_loaimay=$key->id; };


            $db_hang = new hang;
            $db_hang->tenhang = $request->ip_hang;
            $db_hang->id_loaimay =  $id_loaimay;
            $db_hang->save();
            $id_hang = hang::where('tenhang','=',$request->ip_hang)->select('id')->get();
            foreach ($id_hang as $key2) {$id_hang = $key2->id; };

            $db_cauhinh = new cauhinh;
            $db_cauhinh->tencauhinh = $request->ip_cauhinh;
            $db_cauhinh->id_hang = $id_hang;
            $db_cauhinh->save();
            $id_cauhinh = cauhinh::where('tencauhinh','=',$request->ip_cauhinh)->select('id')->get();
            foreach ($id_cauhinh as $key3) {$id_cauhinh=$key3->id; };            
            $nhap4 = new danhsachtongthietbi;
            $nhap4->mathietbi = $id_loaimay.$id_hang.$id_cauhinh.$id_chusohuu;
            $nhap4->chungloai = $id_loaimay;
            $nhap4->hang = $id_hang;
            $nhap4->cauhinh = $id_cauhinh;
            $nhap4->soluong = $request->soluong;
            $nhap4->chusohuu = $id_chusohuu;
            $nhap4->save();
            $idloaimay = $id_loaimay;
            $idhang = $id_hang;
            $idcauhinh = $id_cauhinh;
            $id_chusohuu = $id_chusohuu;


        }
        $mathietbi =$idloaimay.$idhang.$idcauhinh.$id_chusohuu;
        $check = thietbicongty::where('mathietbi',$mathietbi)->where('created_at','=',$request->ngaynhap)->exists();
        if($check == null){
            $thietbicongty = new thietbicongty;
            $thietbicongty->mathietbi = $idloaimay.$idhang.$idcauhinh.$id_chusohuu; 
            $thietbicongty->chungloai = $idloaimay; 
            $thietbicongty->hang = $idhang; 
            $thietbicongty->cauhinh = $idcauhinh; 
            $thietbicongty->chusohuu = $id_chusohuu; 
            $thietbicongty->soluong = $request->soluong; 
            $thietbicongty->save(); 
        }else{
            $slcu = DB::table('thietbicongty')
                    ->where('mathietbi','=',$idloaimay.$idhang.$idcauhinh.$id_chusohuu)
                    ->where('created_at','=',$request->ngaynhap)
                    ->max('soluong');
            $slmoi = $slcu + $request->soluong;
            $slcu = DB::table('thietbicongty')
                    ->where('mathietbi','=',$idloaimay.$idhang.$idcauhinh.$id_chusohuu)
                    ->where('created_at','=',$request->ngaynhap)
                    ->update(['soluong'=>$slmoi]);
        }

        if ($request->dichchuyen == 1) {
            $lichsu = new lichsucapnhatkhohang;
            $lichsu->loaimay = $idloaimay; 
            $lichsu->hang = $idhang; 
            $lichsu->cauhinh = $idcauhinh; 
            $lichsu->chusohuu = $id_chusohuu; 
            $lichsu->soluong = $request->soluong; 
            $lichsu->noidungcapnhat = "Nhập mua mới thiết bị";
            $lichsu->save(); 
            return redirect('/thietbicongty');}
        elseif($request->dichchuyen == 2){
            $abc = chusohuu::where('id',$id_chusohuu)->first('tenchusohuu');
            $lichsu = new lichsucapnhatkhohang;
            $lichsu->loaimay = $idloaimay; 
            $lichsu->hang = $idhang; 
            $lichsu->cauhinh = $idcauhinh; 
            $lichsu->chusohuu = $id_chusohuu; 
            $lichsu->soluong = $request->soluong; 
            $lichsu->noidungcapnhat = "Thuê lại của ".$abc['tenchusohuu'];
            $lichsu->save(); 
            return redirect('/thietbidoitac');};
}
    function danhsachtongthietbi(){
        
        $data_danhsachtongthietbi = DB::table('danhsachtongthietbi')
        ->leftJoin('loaimay','loaimay.id','=','danhsachtongthietbi.chungloai')
        ->leftJoin('hang','hang.id','=','danhsachtongthietbi.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','danhsachtongthietbi.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','danhsachtongthietbi.chusohuu')
        ->select('danhsachtongthietbi.id','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','danhsachtongthietbi.soluong','chusohuu.tenchusohuu')
        ->where('danhsachtongthietbi.soluong','>',0)
        ->get();

        $loaimay=DB::table('loaimay')->get()->all();
        $chusohuu=chusohuu::get()->all();
            $option_loaimay = "<option hidden>Chọn Loại</option>";
        foreach ($loaimay as $key) {
            $option_loaimay .= '<option value="'.$key->id.'">'.$key->tenloaimay.'</option>';
        };

            $option_chusohuu = "";
        foreach ($chusohuu as $key) {
            $option_chusohuu .= '<option value="'.$key->id.'">'.$key->tenchusohuu.'</option>';
        };

        $danhsachdonvisua=DB::table('danhsachdonvisua')->get()->all();
        $option_danhsachdonvisua = "";
        foreach ($danhsachdonvisua as $key){
            $option_danhsachdonvisua .= '<option value="'.$key->id.'">'.$key->tendonvisua.'</option>';
        };
        $data_lichsunhapthietbi = DB::table('lichsucapnhatkhohang')
        ->leftJoin('loaimay','loaimay.id','=','lichsucapnhatkhohang.loaimay')
        ->leftJoin('hang','hang.id','=','lichsucapnhatkhohang.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','lichsucapnhatkhohang.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','lichsucapnhatkhohang.chusohuu')
         ->select('lichsucapnhatkhohang.*','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu')
         ->get();
         $data_danhsachthietbisua = DB::table('danhsachthietbisua')
        ->leftJoin('loaimay','loaimay.id','=','danhsachthietbisua.loaimay')
        ->leftJoin('hang','hang.id','=','danhsachthietbisua.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','danhsachthietbisua.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','danhsachthietbisua.chusohuu')
        ->leftJoin('danhsachdonvisua','danhsachdonvisua.id','=','danhsachthietbisua.id_donvisua')
         ->select('danhsachthietbisua.*','danhsachdonvisua.tendonvisua','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu')
         ->where('danhsachthietbisua.tinhtrang','=',1)->get();

        return view('detail.khohang.danhsachtongthietbi',compact('data_danhsachtongthietbi','data_lichsunhapthietbi','option_chusohuu','option_loaimay','data_danhsachthietbisua','option_danhsachdonvisua'));
    }
    function thietbicongty(){
        $data_thietbicongty = DB::table('thietbicongty')
        ->leftJoin('loaimay','loaimay.id','=','thietbicongty.chungloai')
        ->leftJoin('hang','hang.id','=','thietbicongty.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','thietbicongty.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','thietbicongty.chusohuu')
         ->select('thietbicongty.*','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu',)->get();
        $loaimay=DB::table('loaimay')->get()->all();
        $chusohuu=chusohuu::where('id','=','1')->get();
        $option_loaimay = "<option hidden>Chọn Loại</option>";
        foreach ($loaimay as $key) {
        $option_loaimay .= '<option value="'.$key->id.'">'.$key->tenloaimay.'</option>';};
        $option_chusohuu = "";
        foreach ($chusohuu as $key) {
        $option_chusohuu .= '<option value="'.$key->id.'">'.$key->tenchusohuu.'</option>';};
        return view('detail.khohang.thietbicongty',compact('data_thietbicongty','option_loaimay','option_chusohuu'));
    }
    function thietbidoitac(){
        $data_thietbidoitac = DB::table('thietbicongty')
        ->leftJoin('loaimay','loaimay.id','=','thietbicongty.chungloai')
        ->leftJoin('hang','hang.id','=','thietbicongty.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','thietbicongty.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','thietbicongty.chusohuu')
         ->select('thietbicongty.*','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu')
         ->where('thietbicongty.soluong','>',0)
         ->get();
         
         $data_lichsutrathietbidoitac = DB::table('lichsutrathietbidoitac')
        ->leftJoin('loaimay','loaimay.id','=','lichsutrathietbidoitac.chungloai')
        ->leftJoin('hang','hang.id','=','lichsutrathietbidoitac.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','lichsutrathietbidoitac.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','lichsutrathietbidoitac.chusohuu')
         ->select('lichsutrathietbidoitac.*','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu',)->get();
        $loaimay=DB::table('loaimay')->get()->all();
        $chusohuu=chusohuu::where('id','>','1')->get();
        $option_loaimay = "<option hidden>Chọn Loại</option>";
        foreach ($loaimay as $key) {
        $option_loaimay .= '<option value="'.$key->id.'">'.$key->tenloaimay.'</option>';};
        $option_chusohuu = "";
        foreach ($chusohuu as $key) {
        $option_chusohuu .= '<option value="'.$key->id.'">'.$key->tenchusohuu.'</option>';};
        return view('detail.khohang.thietbidoitac',compact('data_thietbidoitac','data_lichsutrathietbidoitac','option_loaimay','option_chusohuu'));
    }
    function laysoluongton(Request $request)
    {
        $data1['soluongton'] = danhsachtongthietbi::where("mathietbi",'=',$request->idtruyenvao)
        ->get(["soluong"]);
        return response()->json($data1);
    }
     public function layhang(Request $request)
    {
        $data1['layhang'] = hang::where("id_loaimay",'=',$request->idtruyenvao)
        ->get(["tenhang", "id"]);
        return response()->json($data1);
    }
    function xuatthietbisua(Request $request){
        $a = $request->loaidonvisua;//$a = 0 -> donvicu, $a = 1-> donvimoi
        $b = $request->sl_loaimay;
        $c = $request->sl_hang;
        $d = $request->sl_cauhinh;
        $e = $request->sl_chusohuu;
        $f = $request->soluongton;
        $g = $request->soluong;
        $chuandoanloi = $request->chuandoanloi_1."-".$request->chuandoanloi_2;
        $soluongmoi = $f - $g;

        if($a == '1'){
            $new = new danhsachdonvisua;
            $new->tendonvisua = $request->ip_donvisua;
            $new->sodienthoai = "Chưa Có";
            $new->diachi = "Chưa Có";
            $new->save();
            $id_donvisua = danhsachdonvisua::where('tendonvisua','=',$request->ip_donvisua)->max('id');
        }
        else{
            $id_donvisua = $request->sl_donvisua;
        };
        $mathietbi = $b.$c.$d.$e;
        
        if ($soluongmoi > 0 ) {
            $thaydoisoluong = danhsachtongthietbi::where('mathietbi','=',$mathietbi)->update(['soluong'=>$soluongmoi]);
            $new2 = new danhsachthietbisua;
            $new2->mathietbisua = $mathietbi.$a;
            $new2->id_donvisua = $id_donvisua;
            $new2->loaimay = $b;
            $new2->hang = $c;
            $new2->cauhinh = $d;
            $new2->chusohuu = $e;
            $new2->chuandoanloi = $chuandoanloi;
            $new2->tinhtrang= '1';
            $new2->save();
        }elseif($soluongmoi == 0){
            $thaydoisoluong = danhsachtongthietbi::where('mathietbi','=',$mathietbi)->delete();
            $new2 = new danhsachthietbisua;
            $new2->mathietbisua = $mathietbi.$a;
            $new2->id_donvisua = $id_donvisua;
            $new2->loaimay = $b;
            $new2->hang = $c;
            $new2->cauhinh = $d;
            $new2->chusohuu = $e;
            $new2->chuandoanloi = $chuandoanloi;
            $new2->tinhtrang= '1';
            $new2->save();
        }else{
            return back()->with('error', 'Lỗi khi xuất biết bị (Không đủ thiết bị)');
        }
        $tendonvi = danhsachdonvisua::find($id_donvisua)->first('tendonvisua');
        $lscnkh = new lichsucapnhatkhohang;
        $lscnkh->loaimay = $b;
        $lscnkh->hang = $c;
        $lscnkh->cauhinh = $d;
        $lscnkh->chusohuu = $e;
        $lscnkh->soluong = $g;
        $lscnkh->noidungcapnhat = "Xuất máy mã serial [".$request->chuandoanloi_1."] cho ".$tendonvi['tendonvisua']." sửa do - ".$request->chuandoanloi_2;
        $lscnkh->save();

        return redirect('/danhsachtongthietbi');

    }
    function kiemtrathietbi(){
        $datachungloai=DB::table('loaimay')->get()->all();
        $chusohuu=DB::table('chusohuu')->get()->all();
        return view('detail.khohang.kiemtrathietbi',compact('datachungloai','chusohuu'));
    }
    function kiemtrathietbi_thietbi(Request $request){
        // return $request;
        $a = $request->sl_loaimay;
        $b = $request->sl_hang;
        $c = $request->sl_cauhinh;
        $d = $request->sl_chusohuu;
          $mathietbi = $a.$b.$c.$d;
         $thongtintonkho = DB::table('danhsachtongthietbi')
        ->leftJoin('loaimay','loaimay.id','=','danhsachtongthietbi.chungloai')
        ->leftJoin('hang','hang.id','=','danhsachtongthietbi.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','danhsachtongthietbi.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','danhsachtongthietbi.chusohuu')
        ->select('danhsachtongthietbi.*','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu',)
        ->where('danhsachtongthietbi.mathietbi','=',$mathietbi)
        ->get();
         $thongtindonhang =DB::table('danhsachyeucau')
        ->rightJoin('donhang','donhang.id_yeucau','=','danhsachyeucau.id_yeucau')
        ->select('danhsachyeucau.*','donhang.soluong')
        ->where('danhsachyeucau.tinhtrang','=',2)
        ->where('donhang.mathietbi','=',$mathietbi)
        ->get();
        return view('detail.khohang.thietbikiemtra',compact('thongtindonhang','thongtintonkho'));

    }
    function xuattrathietbi(Request $request){
        // return $request;
        $a = $request->sl_loaimay;
        $b = $request->sl_hang;
        $c = $request->sl_cauhinh;
        $d = $request->sl_chusohuu;
        $e = $request->soluong;
        $mathietbi = $a.$b.$c.$d;
        
        $slcu = DB::table('thietbicongty')
        ->where('created_at','=',$request->ngaynhap)
        ->where('mathietbi','=',$mathietbi)
        ->max('soluong');
        $sltoncu = DB::table('danhsachtongthietbi')
        ->where('mathietbi','=',$mathietbi)
        ->max('soluong');
        if($e > $slcu){
            return back()->withError('Số lượng trả lớn hơn thực tế, Vui lòng nhập lại');
        }else{
            if ($e > $sltoncu) {
                return back()->withError('Số máy trong kho không đủ để trả, vui lòng kiểm tra lại');
            }else{
                $slmoi = $slcu-$e;
                $thaydoi  = DB::table('thietbicongty')
                    ->where('created_at','=',$request->ngaynhap)
                    ->where('mathietbi','=',$mathietbi)
                    ->update(['soluong'=>$slmoi]);
                $check = lichsutrathietbidoitac::where('mathietbi',$mathietbi)->where('ngaythue','=',$request->ngaynhap)->exists();
                if($check == null){
                    $tramoi = new lichsutrathietbidoitac;
                    $tramoi->ngaythue = $request->ngaynhap;
                    $tramoi->mathietbi = $mathietbi;
                    $tramoi->chungloai = $a;
                    $tramoi->hang = $b;
                    $tramoi->cauhinh = $c;
                    $tramoi->chusohuu = $d;
                    $tramoi->soluong = $e;
                    $tramoi->save();
                }else{
                    $sltracu  = lichsutrathietbidoitac::where('mathietbi',$mathietbi)
                    ->where('ngaythue','=',$request->ngaynhap)
                    ->max('soluong');
                    $sltramoi = $sltracu + $e;
                    $thaydoimoi = lichsutrathietbidoitac::where('mathietbi',$mathietbi)
                    ->where('mathietbi','=',$mathietbi)
                    ->update(['soluong'=>$sltramoi]);
                }
            }

            $abc = chusohuu::where('id',$d)->first('tenchusohuu');
            $lichsu = new lichsucapnhatkhohang;
            $lichsu->loaimay = $a; 
            $lichsu->hang = $b; 
            $lichsu->cauhinh = $c; 
            $lichsu->chusohuu = $d; 
            $lichsu->soluong = $e; 
            $lichsu->noidungcapnhat = "Xuất trả máy của ".$abc['tenchusohuu']." cho đơn thuê ngày ".\Carbon\Carbon::parse($request->ngaynhap)->format('d/m/Y');
            $lichsu->save(); 

            return back();
        }


        
    }
    function xulimayloi($id){
            $data = DB::table('danhsachthietbisua')
            ->leftJoin('loaimay','loaimay.id','=','danhsachthietbisua.loaimay')
            ->leftJoin('hang','hang.id','=','danhsachthietbisua.hang')
            ->leftJoin('cauhinh','cauhinh.id','=','danhsachthietbisua.cauhinh')
            ->leftJoin('chusohuu','chusohuu.id','=','danhsachthietbisua.chusohuu')
            ->leftJoin('danhsachdonvisua','danhsachdonvisua.id','=','danhsachthietbisua.id_donvisua')
             ->select('danhsachthietbisua.*','danhsachdonvisua.tendonvisua','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','chusohuu.tenchusohuu')
            ->where('danhsachthietbisua.id','=',$id)
             ->get();
            return view('detail.khohang.xulimayloi',compact('data'));
        }
    function capnhatthietbisua(Request $request){
        // return $request;
        $capnhat = DB::table('danhsachthietbisua')->where('id','=',$request->id)
        ->update(['thucteloi'=>$request->thucteloi,'chiphisua'=>$request->chiphisua,'tinhtrang'=>'2']);
        $a = $request->loaimay;
        $b = $request->hang;
        $c = $request->cauhinh;
        $d = $request->chusohuu;
        $mathietbi = $a.$b.$c.$d;
        $slcu = DB::table('danhsachtongthietbi')->where('mathietbi','=',$mathietbi)->max('soluong');
        $slmoi = $slcu +1;
        $capnhat = DB::table('danhsachtongthietbi')->where('mathietbi','=',$mathietbi)->update(['soluong'=>$slmoi]);
        $tendonvisua = $request->tendonvisua;
        $lscnkh = new lichsucapnhatkhohang;
        $lscnkh->loaimay = $a;
        $lscnkh->hang = $b;
        $lscnkh->cauhinh = $c;
        $lscnkh->chusohuu = $d;
        $lscnkh->soluong = 1;
        $lscnkh->noidungcapnhat = "Nhận máy ".$tendonvisua." đã sửa về - ".$request->thucteloi;
        $lscnkh->save();

        return redirect('/danhsachtongthietbi');
    }

}
