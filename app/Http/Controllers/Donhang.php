<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\danhsachyeucau;
use App\Models\loaimay;
use App\Models\cauhinh;
use App\Models\hang;
use App\Models\donhangModel;
use App\Models\data_company;
use App\Models\bangthongbaoloi;
use App\Models\danhsachtongthietbi;
use App\Models\lichsucapnhatkhohang;
use Illuminate\Support\Facades\DB;



class Donhang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_donhang = DB::table('danhsachyeucau')
        ->where('tinhtrang','=','2')
        ->orderBy('thuctegiaomay', 'DESC')
        ->get();
         $idmax = DB::table('danhsachyeucau')->max('id_yeucau');
        return view('detail.order.danhsachdonhang',compact('data_donhang','idmax'));
    }
     public function lichsudonhang()
    {
        $data_donhang = DB::table('danhsachyeucau')
        ->get();
         $idmax = DB::table('danhsachyeucau')->max('id_yeucau');
        return view('detail.order.lichsudonhang',compact('data_donhang','idmax'));
    }

    public function createRequest()
    {
        $datacompany = DB::table('data_company')->orderByRaw('tencongty DESC')->get();
        $option_donvithoigian = "";
        $thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
        for ($i=0; $i < 4 ; $i++) { 
          $option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
        };
        $option_khachhang='<option value="" hidden>Lựa chọn khách hàng</option>';
        foreach ($datacompany as $data){
        $option_khachhang .= '<option class="form-control" value="'.$data->makhachhang.'"><tr><td>'.$data->tencongty.'</td><td>| Đại diện: '.$data->daidien.'</td></tr></option>';
}

        $idmax = DB::table('danhsachyeucau')->max('id_yeucau');
        $idmax = $idmax +1;
        return view('detail.order.taoyeucau',compact('idmax','datacompany','option_khachhang','option_donvithoigian'));
    }
    function yeucaukhachhang($id){
        
        $datakhachhang = DB::table('data_company')->where('makhachhang','=',$id)->get();
        return view('detail.order.yeucaukhachhang',compact('datakhachhang'));
   }
    function post_taoyeucau(Request $request)
    {
        if($request->khachhangcu0moi1==1){
            $khachhangmoi = new data_company;
            $khachhangmoi->loaikhachhang = $request->loaikhachhang;
            $khachhangmoi->masothue = $request->masothue;
            $khachhangmoi->tencongty  = $request->tencongty;
            $khachhangmoi->daidien  = $request->daidien;
            $khachhangmoi->dienthoai  = $request->dienthoai;
            $khachhangmoi->diachi  = $request->diachi;
            $khachhangmoi->email  = $request->email;
            $khachhangmoi->giaodichcuoi  = date("Y/m/d");
            $khachhangmoi->ghichu  = "";
            $khachhangmoi->save();
        }
        else{
            $capnhat = data_company::where('makhachhang','=',$request->makhachhang)->update(['giaodichcuoi'=>date("Y/m/d")]);
        }
        $gioihan = $request->sochungloaithietbi;
        for ($i=1; $i <= $gioihan; $i++) { 
            $loaithietbi = 'loaithietbi'.$i;
            $soluong  = 'soluong'.$i;
            $sothoigian  = 'sothoigian'.$i;
            $donvithoigian = 'donvithoigian'.$i;
            $dongia = 'dongia'.$i;
            $array_thongtinthietbi[$i] = array(
                $loaithietbi => $request->$loaithietbi,
                $soluong => $request->$soluong,
                $sothoigian => $request->$sothoigian,
                $donvithoigian => $request->$donvithoigian,
                $dongia => $request->$dongia
            );
            $array_thongtinthietbi['gioihan'] = $gioihan;
        };
        $ghichep = array('thutu1'=>'1','noidung1'=>'Tạo Yêu Cầu,','ngaycapnhat1'=>date('d/m/Y'),'tongghichep'=>'1');
        $danhsachyeucau = new danhsachyeucau;
        $danhsachyeucau->loaikhachhang = $request->loaikhachhang;
        $danhsachyeucau->masothue = $request->masothue;
        $danhsachyeucau->id_khachhang = $request->makhachhang;
        $danhsachyeucau->tencongty  = $request->tencongty;
        $danhsachyeucau->daidien  = $request->daidien;
        $danhsachyeucau->loaithue  = $request->loaithue;
        $danhsachyeucau->tiencoc  = $request->tiencoc;
        $danhsachyeucau->dienthoai  = $request->dienthoai;
        $danhsachyeucau->thoigiangiaomay  = $request->thoigiangiaomay;
        $danhsachyeucau->diachi  = $request->diachi;
        $danhsachyeucau->tinhtrang  = 1;
        $danhsachyeucau->ghichu  = $request->ghichu;
        $danhsachyeucau->thongtinthietbi = json_encode($array_thongtinthietbi,$gioihan);
        $danhsachyeucau->ghichepdonhang = json_encode($ghichep);
        $danhsachyeucau->save();
        return redirect('/danhsachyeucau');
    }
     public function danhsachyeucau()
    {

        $datacompany = DB::table('data_company')->orderByRaw('tencongty DESC')->get();
        $option_donvithoigian = "";
        $thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
        for ($i=0; $i < 4 ; $i++) { 
          $option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
        };
        $option_khachhang='<option value="" hidden>Lựa chọn khách hàng</option>';
        foreach ($datacompany as $data){
        $option_khachhang .= '<option class="form-control" value="'.$data->makhachhang.'"><tr><td>'.$data->tencongty.'</td><td>| Đại diện: '.$data->daidien.'</td></tr></option>';
}


        $idmax = DB::table('danhsachyeucau')->max('id_yeucau') +1;
        $data_danhsachyeucau = danhsachyeucau::where('tinhtrang','1')->get();
        return view('detail.order.danhsachyeucau',compact('data_danhsachyeucau','idmax','option_khachhang','option_donvithoigian'));
    }
     public function xoayeucau($id)
    {
        $yeucau = danhsachyeucau::where('id_yeucau',$id)->update(['tinhtrang'=>'10']);
        $data_danhsachyeucau = danhsachyeucau::where('tinhtrang','1')->get();
        return view('detail.order.danhsachyeucau',compact('data_danhsachyeucau'));
    }
     public function xoayeucau1($id)
    {
        $yeucau = danhsachyeucau::where('id_yeucau',$id)->update(['tinhtrang'=>'10']);
        $thaydoi = DB::table('donhang')->where('id_yeucau',$id)->get();
        foreach($thaydoi as $data){
            $slcu = DB::table('donhang')->where('id_yeucau',$id)->where('mathietbi',$data->mathietbi)->max('soluong');
            $slcukho = DB::table('danhsachtongthietbi')->where('mathietbi',$data->mathietbi)->max('soluong');
            $slmoi = $slcukho + $slcu;
            $slcukho = DB::table('danhsachtongthietbi')->where('mathietbi',$data->mathietbi)->update(['soluong'=>$slmoi]);
        }
        return redirect('/danhsachdonhang');

    }
     public function ketthucdonhang($id)
    {
        $yeucau = danhsachyeucau::where('id_yeucau',$id)->update(['tinhtrang'=>'1000']);
        $thaydoi = DB::table('donhang')->where('id_yeucau',$id)->get();
        foreach($thaydoi as $data){
            $slcu = DB::table('donhang')->where('id_yeucau',$id)->where('mathietbi',$data->mathietbi)->max('soluong');
            $slcukho = DB::table('danhsachtongthietbi')->where('mathietbi',$data->mathietbi)->max('soluong');
            $slmoi = $slcukho + $slcu;
            $slcukho = DB::table('danhsachtongthietbi')->where('mathietbi',$data->mathietbi)->update(['soluong'=>$slmoi]);
        }
        return redirect('/danhsachdonhang');
    }



    public function xuliyeucau($id, Request $request)
    {

        $data_yeucau = DB::table('danhsachyeucau')->where('id_yeucau',$id)->get();
        return view('detail.order.xuliyeucau',compact('data_yeucau'));
    }
     public function xuliyeucau1($id, Request $request)
    {

        $data_yeucau = DB::table('danhsachyeucau')->where('id_yeucau',$id)->get();
        return view('detail.order.xuliyeucau1',compact('data_yeucau'));
    }
    public function suayeucau( Request $request)
    {
        $gioihan = $request->sochungloaithietbi;
        for ($i=1; $i <= $gioihan; $i++) { 
            $loaithietbi = 'loaithietbi'.$i;
            $soluong  = 'soluong'.$i;
            $sothoigian  = 'sothoigian'.$i;
            $donvithoigian = 'donvithoigian'.$i;
            $dongia = 'dongia'.$i;
            $array_thongtinthietbi[$i] = array(
                $loaithietbi => $request->$loaithietbi,
                $soluong => $request->$soluong,
                $sothoigian => $request->$sothoigian,
                $donvithoigian => $request->$donvithoigian,
                $dongia => $request->$dongia
            );
            $array_thongtinthietbi['gioihan'] = $gioihan;
        };


        $danhsachyeucau = danhsachyeucau::find($request->id_yeucau) ;
        $danhsachyeucau->loaikhachhang = $request->loaikhachhang;
        $danhsachyeucau->masothue = $request->masothue;
        $danhsachyeucau->tencongty  = $request->tencongty;
        $danhsachyeucau->daidien  = $request->daidien;
        $danhsachyeucau->loaithue  = $request->loaithue;
        $danhsachyeucau->tiencoc  = $request->tiencoc;
        $danhsachyeucau->dienthoai  = $request->dienthoai;
        $danhsachyeucau->thoigiangiaomay  = $request->thoigiangiaomay;
        $danhsachyeucau->diachi  = $request->diachi;
        $danhsachyeucau->ghichu  = $request->ghichu;

        $danhsachyeucau->thongtinthietbi = json_encode($array_thongtinthietbi,$gioihan);
        $danhsachyeucau->save();
        return redirect('/xuliyeucau/'.$request->id_yeucau);
    }
    
   
   



    function chuyentiepyeucau($id, Request $request)
    {
        $data_yeucau = DB::table('danhsachyeucau')->where('id_yeucau',$id)->get();
        $datachungloai = DB::table('loaimay')->get();
        $chusohuu = DB::table('chusohuu')->get();
         $data_danhsachtongthietbi = DB::table('danhsachtongthietbi')
        ->leftJoin('loaimay','loaimay.id','=','danhsachtongthietbi.chungloai')
        ->leftJoin('hang','hang.id','=','danhsachtongthietbi.hang')
        ->leftJoin('cauhinh','cauhinh.id','=','danhsachtongthietbi.cauhinh')
        ->leftJoin('chusohuu','chusohuu.id','=','danhsachtongthietbi.chusohuu')
        ->select('danhsachtongthietbi.id','loaimay.tenloaimay','hang.tenhang','cauhinh.tencauhinh','danhsachtongthietbi.soluong','chusohuu.tenchusohuu')
        ->where('danhsachtongthietbi.soluong','>',0)
        ->get();
        $tinhtrang = DB::table('danhsachyeucau')->where('id_yeucau','=',$id)->max('tinhtrang');
        if ($tinhtrang == 1) {
            return view('detail.order.chuyentiepyeucau',compact('data_yeucau','datachungloai','chusohuu','data_danhsachtongthietbi'));
        }else{
            return redirect('/chitietdonhang/'.$id);
        }
        
    }





    public function create()
    {
        return view('detail.order.taodonhang');

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
    public function taodonhang(Request $request)
    {

        $soluongchungloaithietbidagiao = $request->soluongchungloai;
        for ($i=1; $i <= $soluongchungloaithietbidagiao; $i++) {
            $idyeucau = $request->id_yeucau;
            $chung_loai = 'chung_loai'.$i;
            $ten_hang = 'ten_hang'.$i;
            $cau_hinh = 'cau_hinh'.$i;
            $chu_sohuu = 'chu_sohuu'.$i;
            $soluong_giao = 'soluong_giao'.$i;
            $id = $request->$chung_loai.$request->$ten_hang.$request->$cau_hinh.$request->$chu_sohuu;
            $capnhatkhohang = DB::table('danhsachtongthietbi')
                                ->where('mathietbi','=', $id)
                                ->max('soluong');

            $capnhatkhohang = $capnhatkhohang - $request->$soluong_giao;
            if($capnhatkhohang < 0){
                return back()->withErrors(['Trong kho không đủ số lượng thiết bị. Vui Lòng kiểm tra lại']);;
            }else{
            $capnhat = danhsachtongthietbi::where('mathietbi','=', $id)
                        ->update(['soluong'=>$capnhatkhohang]);
            }

            $donhang = new donhangModel;             
            $donhang->id_yeucau = $idyeucau;
            $donhang->mathietbi = $request->$chung_loai.$request->$ten_hang.$request->$cau_hinh.$request->$chu_sohuu;

            $donhang->chungloai = $request->$chung_loai;
            $donhang->hang = $request->$ten_hang;
            $donhang->cauhinh = $request->$cau_hinh;
            $donhang->chusohuu = $request->$chu_sohuu;
            $donhang->tinhtrang = 1;
            $donhang->soluong = $request->$soluong_giao;
            $donhang->ghichu = "";
            $donhang->ngay_giaomay = $request->ngay_giaomay;
            $donhang->save();

            $abc = danhsachyeucau::where('id_yeucau',$idyeucau)->first('tencongty');
            $def = danhsachyeucau::where('id_yeucau',$idyeucau)->first('daidien');
            $lichsu = new lichsucapnhatkhohang;
            $lichsu->loaimay = $request->$chung_loai; 
            $lichsu->hang = $request->$ten_hang; 
            $lichsu->cauhinh = $request->$cau_hinh; 
            $lichsu->chusohuu = $request->$chu_sohuu; 
            $lichsu->soluong = $request->$soluong_giao; 
            $lichsu->noidungcapnhat = "Xuất máy cho (".$abc['tencongty'].")".$def['daidien'].". Đơn hàng số:".$idyeucau." - Giao ngày:".\Carbon\Carbon::parse($request->ngay_giaomay)->format('d/m/Y');
            $lichsu->save(); 
        };


        $ghichepdonhang = $request->ghichepdonhang;
        $ghichepdonhang = json_decode($ghichepdonhang, TRUE);
        $i = $ghichepdonhang['tongghichep'] +1;
        $ghichepdonhang['thutu'.$i] = $i;
        $ghichepdonhang['noidung'.$i] = 'Xác nhận Giao Hàng';
        $ghichepdonhang['ngaycapnhat'.$i] = date('d/m/Y');
        $ghichepdonhang['tongghichep'] = $i;


        $chinhyeucau = danhsachyeucau::find($request->id_yeucau);
        $chinhyeucau->tinhtrang = 2;
        $chinhyeucau->thuctegiaomay = $request->ngay_giaomay;
        $chinhyeucau->ngay_ketthuc = $request->ngay_ketthuc;
        $chinhyeucau->ghichepdonhang = json_encode($ghichepdonhang);
        $chinhyeucau->save();

        


        return redirect('/danhsachdonhang');
    }

    public function layhang(Request $request)
    {
        $data1['layhang'] = hang::where("id_loaimay",'=',$request->idtruyenvao)->get(["tenhang", "id"]);
        return response()->json($data1);
    }
    public function laycauhinh(Request $request)
    {
        $data2['cauhinh'] = cauhinh::where("id_hang",'=',$request->idtruyenvao)->get(["tencauhinh", "id"]);
        return response()->json($data2);
    }
    public function laythongtinkhachhang(Request $request)
    {
        $data2['thongtinkhachhang'] = data_company::where("makhachhang",'=',$request->idtruyenvao)->get(["makhachhang", "masothue","tencongty","daidien","dienthoai","email","diachi"]);
        return response()->json($data2);
    }
    function chitietdonhang($id, Request $request){
        $dt_thongbaoloi = DB::table('bangthongbaoloi')->where('id','=',$id)->get();
        $id_yeucau = DB::table('bangthongbaoloi')->where('id','=',$id)->max('id_yeucau');
        $soluong = DB::table('donhang')->where('donhang.id_yeucau','=',$id_yeucau)->count();
        $datachungloai = DB::table('loaimay')->get();
        $chusohuu = DB::table('chusohuu')->get();
        $data_donhang = DB::table('donhang')
            ->leftJoin('loaimay','loaimay.id','=','donhang.chungloai')
            ->leftJoin('hang','hang.id','=','donhang.hang')
            ->leftJoin('cauhinh','cauhinh.id','=','donhang.cauhinh')
            ->leftJoin('chusohuu','chusohuu.id','=','donhang.chusohuu')
            ->leftJoin('danhsachyeucau','danhsachyeucau.id_yeucau','=','donhang.id_yeucau')
            ->where('donhang.id_yeucau','=',$id)
            ->where('donhang.soluong','>',0)
            ->get(); 
        $data_yeucau = DB::table('danhsachyeucau')->where('id_yeucau','=',$id)->get();
         $dt_thongbaoloi = DB::table('bangthongbaoloi')
        ->where('id_yeucau','=',$id)
        ->get();
        $coloi = 0;
         $checkloi = DB::table('bangthongbaoloi')
        ->where('id_yeucau','=',$id)
        ->exists();
        if($checkloi){
              $coloi = 1;
        }
        return view('detail.order.chitietdonhang',compact('data_donhang','data_yeucau','dt_thongbaoloi','coloi','datachungloai','chusohuu'));
    }
    function giahandonhang($id ,Request $request){
        // return $id;
        if ($request->baotrasom == 0) {
        $ngayketthuc1 = $request->ngay_ketthuc1;
        $ghichu = $request->ghichumoi;
        $giahan = danhsachyeucau::where('id_yeucau','=',$id)->update(['ngay_ketthuc'=>$ngayketthuc1]);
        }else{
        $ngayketthuc2 = $request->ngay_ketthuc2;
        $ghichu = $request->ghichumoi;
        $giahan = danhsachyeucau::where('id_yeucau','=',$id)->update(['ngay_ketthuc'=>$ngayketthuc2]);

        }
        
        $ghichumoi = danhsachyeucau::where('id_yeucau','=',$id)->update(['ghichu'=>$ghichu]);
        return redirect('/chitietdonhang/'.$id);
    }
    function capnhatghichu($id ,Request $request){
        // return $id;
        if($request->ghichu_new){
        $ghichucu = $request->ghichu_old.today();
        $ghichu = $request->ghichu_new;
        $giahan = danhsachyeucau::where('id_yeucau','=',$id)->update(['ghichu'=>$ghichu]);}
        return redirect('/chitietdonhang/'.$id);
    }
    function capnhatloi($id, Request $request){
        // return $request;
        $tbl = new bangthongbaoloi;
        $tbl->id_yeucau = $id;
        $tbl->noidungloi = $request->noidungloi;
        $tbl->cachxuliloi = "Chưa có";
        $tbl->tinhtrangloi = "1";
        $tbl->save();
        return redirect('/chitietdonhang/'.$id);
    }
    function xuliloi($id){
        $dt_thongbaoloi = DB::table('bangthongbaoloi')->where('id','=',$id)->get();
        $id_yeucau = DB::table('bangthongbaoloi')->where('id','=',$id)->max('id_yeucau');
        $soluong = DB::table('donhang')->where('donhang.id_yeucau','=',$id_yeucau)->count();
        $datachungloai = DB::table('loaimay')->get();
        $chusohuu = DB::table('chusohuu')->get();
        $data_donhang = DB::table('donhang')
            ->leftJoin('loaimay','loaimay.id','=','donhang.chungloai')
            ->leftJoin('hang','hang.id','=','donhang.hang')
            ->leftJoin('cauhinh','cauhinh.id','=','donhang.cauhinh')
            ->leftJoin('chusohuu','chusohuu.id','=','donhang.chusohuu')
            ->leftJoin('danhsachyeucau','danhsachyeucau.id_yeucau','=','donhang.id_yeucau')
            ->where('donhang.id_yeucau','=',$id_yeucau)->get(); 
        return view('detail.order.xuliloi',compact('dt_thongbaoloi','id','data_donhang','id_yeucau','soluong','datachungloai','chusohuu'));
    }
    function capnhatxuliloi(Request $request){
        $a = $request->phuonganxuli;
        $b = $request->doimay;
        $c = $request->thietbihong;
        $d = $request->sltb_nhan;
        $e = $request->thietbimoi;
        $f = $request->sltb_xuat;
        // return $request;
        $capnhatloi1 = DB::table('bangthongbaoloi')
                        ->where('id',$request->id)
                        ->update(['tinhtrangloi'=>'2']);
        $capnhatloi2 = DB::table('bangthongbaoloi')
                        ->where('id',$request->id)
                        ->update(['cachxuliloi'=>$a]);
        if($b == 1){ //xác nhận có sự thay đổi số lượng máy
            if($c == 1){
                //Nhận lại thiết bị hỏng
                for ($i=1; $i <= $d; $i++) { 
                    $chungloai_nhap = 'chungloai_nhap'.$i;
                     $_aaa = $request->$chungloai_nhap;
                    $hang_nhap = 'hang_nhap'.$i;
                     $_bbb = $request->$hang_nhap;
                    $cauhinh_nhap = 'cauhinh_nhap'.$i;
                     $_ccc = $request->$cauhinh_nhap;
                    $chusohuu_nhap = 'chusohuu_nhap'.$i;
                     $_ddd = $request->$chusohuu_nhap;
                    $soluong_nhap = 'soluong_nhap'.$i;
                    $_eee = $request->$soluong_nhap;
                      $mtbn_nhap = $_aaa.$_bbb.$_ccc.$_ddd;
                    //kiểm tra trong đơn hàng có đủ máy không
                      $sldonhang_nhap = DB::table('donhang')
                    ->where('id_yeucau','=',$request->id_yeucau)
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->max('soluong');
                      $slmoi2_nhap = $sldonhang_nhap - $_eee;
                    if( $slmoi2_nhap < 0){
                        return back()->withErrors('Số lượng máy trả sai, vui lòng kiểm tra lại');
                        }
                    
                    else{
                         $slnhap123 = DB::table('donhang')
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->where('mathietbi','=',$mtbn_nhap)
                        ->update(['soluong'=>$slmoi2_nhap]);
                        // $abc = danhsachyeucau::where('id_yeucau',$idyeucau)->first('tencongty');
                        
                    }

                    //Cộng máy vào trong kho
                     $slcu_nhap = DB::table('danhsachtongthietbi')
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->max('soluong');
                    $slmoi_nhap = $slcu_nhap + $_eee;
                    $slcu_nhap = DB::table('danhsachtongthietbi')
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->update(['soluong'=>$slmoi_nhap]);

                    $abc1 = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('tencongty');
                    $def1 = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('daidien');  
                    $lichsu1 = new lichsucapnhatkhohang;
                    $lichsu1->loaimay = $_aaa; 
                    $lichsu1->hang = $_bbb; 
                    $lichsu1->cauhinh = $_ccc; 
                    $lichsu1->chusohuu = $_ddd; 
                    $lichsu1->soluong = $_eee; 
                    $lichsu1->noidungcapnhat =  "Đơn hàng số: ".$request->id_yeucau."Nhận trả máy của (".$abc1['tencongty'].")".$def1['daidien'].". Giao ngày:".\Carbon\Carbon::parse($request->ngay_giaomay)->format('d/m/Y');
                    $lichsu1->save(); 

          
                    
                }
            };

            if($e == 1){
                for ($ii=1; $ii <= $f; $ii++) { 
                    $chungloai_xuat = 'chungloai_xuat'.$ii;
                      $_iii = $request->$chungloai_xuat;
                    $hang_xuat = 'hang_xuat'.$ii;
                    $_kkk = $request->$hang_xuat;
                    $cauhinh_xuat = 'cauhinh_xuat'.$ii;
                    $_lll = $request->$cauhinh_xuat;
                    $chusohuu_xuat = 'chusohuu_xuat'.$ii;
                    $_nnn = $request->$chusohuu_xuat;
                    $soluong_xuat = 'soluong_xuat'.$ii;
                    $_mmm = $request->$soluong_xuat;
                     $mtbn_xuat = $_iii.$_kkk.$_lll.$_nnn;
                     $slcu_xuat = DB::table('danhsachtongthietbi')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->max('soluong');
                     $slmoi_xuat = $slcu_xuat - $_mmm;
                    if ($slmoi_xuat < 0 ) {
                        return back()->withErrors('Số lượng hàng trong kho không đủ');
                    }else{
                    $capnhat_slxuat = DB::table('danhsachtongthietbi')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->update(['soluong'=>$slmoi_xuat]);}
                     $slcu2_xuat = DB::table('donhang')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->max('soluong');
                    


                    if($slcu2_xuat){
                         $slmoi2_xuat = $slcu2_xuat + $_mmm;
                         $abc = DB::table('donhang')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->update(['soluong'=>$slmoi2_xuat]);
                    }else{
                        $dhmoi = new donhangModel;
                        $dhmoi->id_yeucau = $request->id_yeucau;
                        $dhmoi->mathietbi = $mtbn_xuat;
                        $dhmoi->chungloai = $_iii;
                        $dhmoi->hang = $_kkk;
                        $dhmoi->cauhinh = $_lll;
                        $dhmoi->chusohuu = $_nnn;
                        $dhmoi->soluong = $_mmm;
                        $dhmoi->ngay_giaomay = today();
                        $dhmoi->tinhtrang = '1';
                        $dhmoi->ghichu = '';
                        $dhmoi->save();
                    };

          
         

                $abc = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('tencongty');
                $def = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('daidien');   
        // $abc = danhsachyeucau::where('id_yeucau',$idyeucau)->first('tencongty');
                $lichsu = new lichsucapnhatkhohang;
                $lichsu->loaimay = $_iii; 
                $lichsu->hang = $_kkk; 
                $lichsu->cauhinh = $_lll; 
                $lichsu->chusohuu = $_nnn; 
                $lichsu->soluong = $_mmm; 
                $lichsu->noidungcapnhat = "Đơn hàng số: ".$request->id_yeucau."Xuất thêm máy cho (".$abc['tencongty'].")".$def['daidien'].". Giao ngày:".\Carbon\Carbon::parse($request->ngay_giaomay)->format('d/m/Y');
                $lichsu->save(); 

                }
            };
        }//ket thuc viec nhap xuat du lieu
        return redirect('/chitietdonhang/'.$request->id_yeucau);
    }
    function thaydoithietbi(Request $request){
          $c = $request->thietbihong;
        $d = $request->sltb_nhan;
        $e = $request->thietbimoi;
        $f = $request->sltb_xuat;
        if($c == 1){
                //Nhận lại thiết bị hỏng
                for ($i=1; $i <= $d; $i++) { 
                    $chungloai_nhap = 'chungloai_nhap'.$i;
                     $_aaa = $request->$chungloai_nhap;
                    $hang_nhap = 'hang_nhap'.$i;
                     $_bbb = $request->$hang_nhap;
                    $cauhinh_nhap = 'cauhinh_nhap'.$i;
                     $_ccc = $request->$cauhinh_nhap;
                    $chusohuu_nhap = 'chusohuu_nhap'.$i;
                     $_ddd = $request->$chusohuu_nhap;
                    $soluong_nhap = 'soluong_nhap'.$i;
                    $_eee = $request->$soluong_nhap;
                     $mtbn_nhap = $_aaa.$_bbb.$_ccc.$_ddd;
                    //kiểm tra trong đơn hàng có đủ máy không
                     $sldonhang_nhap = DB::table('donhang')
                    ->where('id_yeucau','=',$request->id_yeucau)
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->max('soluong');
                      $slmoi2_nhap = $sldonhang_nhap - $_eee;
                    if( $slmoi2_nhap < 0){
                        return back()->withErrors('Số lượng máy trả sai, vui lòng kiểm tra lại');
                    }
                    elseif($slmoi2_nhap == 0){
                        $sldonhang_nhap = DB::table('donhang')
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->where('mathietbi','=',$mtbn_nhap)
                        ->delete();
                    }
                    else{
                        $sldonhang_nhap = DB::table('donhang')
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->where('mathietbi','=',$mtbn_nhap)
                        ->update(['soluong'=>$slmoi2_nhap]);
                    }

                    //Cộng máy vào trong kho
                     $slcu_nhap = DB::table('danhsachtongthietbi')
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->max('soluong');
                    $slmoi_nhap = $slcu_nhap + $_eee;
                    $slcu_nhap = DB::table('danhsachtongthietbi')
                    ->where('mathietbi','=',$mtbn_nhap)
                    ->update(['soluong'=>$slmoi_nhap]);

                    $abc1 = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('tencongty');
                    $def1 = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('daidien');  
                    $lichsu1 = new lichsucapnhatkhohang;
                    $lichsu1->loaimay = $_aaa; 
                    $lichsu1->hang = $_bbb; 
                    $lichsu1->cauhinh = $_ccc; 
                    $lichsu1->chusohuu = $_ddd; 
                    $lichsu1->soluong = $_eee; 
                    $lichsu1->noidungcapnhat =  "Đơn hàng số: ".$request->id_yeucau."Nhận trả máy của (".$abc1['tencongty'].")".$def1['daidien'].". Giao ngày:".\Carbon\Carbon::parse($request->ngay_giaomay)->format('d/m/Y');
                    $lichsu1->save(); 
          
                    
                }
            };
            if($e == 1){
                for ($i=1; $i <= $f; $i++) { 
                    $chungloai_xuat = 'chungloai_xuat'.$i;
                    $_iii = $request->$chungloai_xuat;
                    $hang_xuat = 'hang_xuat'.$i;
                    $_kkk = $request->$hang_xuat;
                    $cauhinh_xuat = 'cauhinh_xuat'.$i;
                    $_lll = $request->$cauhinh_xuat;
                    $chusohuu_xuat = 'chusohuu_xuat'.$i;
                    $_nnn = $request->$chusohuu_xuat;
                    $soluong_xuat = 'soluong_xuat'.$i;
                    $_mmm = $request->$soluong_xuat;
                    $mtbn_xuat = $_iii.$_kkk.$_lll.$_nnn;
                    $slcu_xuat = DB::table('danhsachtongthietbi')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->max('soluong');
                    $slmoi_xuat = $slcu_xuat - $_mmm;
                    if ($slmoi_xuat < 0 ) {
                        return back()->withErrors('Số lượng hàng trong kho không đủ');
                    }else{
                    $capnhat_slxuat = DB::table('danhsachtongthietbi')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->update(['soluong'=>$slmoi_xuat]);}
                    $slcu2_xuat = DB::table('donhang')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->max('soluong');
                    if($slcu2_xuat){
                        $slmoi2_xuat = $slcu2_xuat + $_mmm;
                        $slmoi2_xuat = DB::table('donhang')
                        ->where('mathietbi','=',$mtbn_xuat)
                        ->where('id_yeucau','=',$request->id_yeucau)
                        ->update(['soluong'=>$slmoi2_xuat]);
                    }else{
                        $dhmoi = new donhangModel;
                        $dhmoi->id_yeucau = $request->id_yeucau;
                        $dhmoi->mathietbi = $mtbn_xuat;
                        $dhmoi->chungloai = $_iii;
                        $dhmoi->hang = $_kkk;
                        $dhmoi->cauhinh = $_lll;
                        $dhmoi->chusohuu = $_nnn;
                        $dhmoi->soluong = $_mmm;
                        $dhmoi->ngay_giaomay = today();
                        $dhmoi->tinhtrang = '1';
                        $dhmoi->ghichu = '';
                        $dhmoi->save();
                    }
                $abc = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('tencongty');
                $def = danhsachyeucau::where('id_yeucau',$request->id_yeucau)->first('daidien');   
                // $abc = danhsachyeucau::where('id_yeucau',$idyeucau)->first('tencongty');
                $lichsu = new lichsucapnhatkhohang;
                $lichsu->loaimay = $_iii; 
                $lichsu->hang = $_kkk; 
                $lichsu->cauhinh = $_lll; 
                $lichsu->chusohuu = $_nnn; 
                $lichsu->soluong = $_mmm; 
                $lichsu->noidungcapnhat = "Đơn hàng số: ".$request->id_yeucau."Xuất thêm máy cho (".$abc['tencongty'].")".$def['daidien'].". Giao ngày:".\Carbon\Carbon::parse($request->ngay_giaomay)->format('d/m/Y');
                $lichsu->save(); 
                }
            };
        return redirect('/chitietdonhang/'.$request->id_yeucau);

    }

    

}
