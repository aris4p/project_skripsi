<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use App\User;
use App\Supplier;
use App\Customer;
use App\Akun;
use App\Penjualan;
use App\Pembelian;
use App\Jurnal;
use Carbon\Carbon;

use Hash;
use Auth;
use File;

use App\Exports\LaporanExport;
use App\Exports\RekapExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
       
        $pembelian = Pembelian::all();
        $penjualan = Penjualan::all();
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        $pemasukan_hari_ini = DB::table('pembelians')
        ->select(DB::raw('SUM(nominal) as total'))
        ->whereDate('tanggal',$tanggal)
        ->first();

        $pemasukan_bulan_ini = DB::table('pembelians')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->whereMonth('tanggal',$bulan)
        ->first();

        $pemasukan_tahun_ini = DB::table('pembelians')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->whereYear('tanggal',$tahun)
        ->first();

        $seluruh_pemasukan = DB::table('pembelians')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->first();

        $penjualan_hari_ini = DB::table('penjualans')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->whereDate('tanggal',$tanggal)
        ->first();

        $penjualan_bulan_ini = DB::table('penjualans')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->whereMonth('tanggal',$bulan)
        ->first();

        $penjualan_tahun_ini = DB::table('penjualans')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->whereYear('tanggal',$tahun)
        ->first();

        $seluruh_penjualan = DB::table('penjualans')
        ->select(DB::raw('SUM(nominal) as total'))
        
        ->first();

        return view('app.index',
            [
                'pemasukan_hari_ini' => $pemasukan_hari_ini, 
                'pemasukan_bulan_ini' => $pemasukan_bulan_ini,
                'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
                'seluruh_pemasukan' => $seluruh_pemasukan,
                'penjualan_hari_ini' => $penjualan_hari_ini, 
                'penjualan_bulan_ini' => $penjualan_bulan_ini,
                'penjualan_tahun_ini' => $penjualan_tahun_ini,
                'seluruh_penjualan' => $seluruh_penjualan,
                'penjualan' => $penjualan,
                'pembelian' => $pembelian,
            ]
        );
    }

    public function akun()
    {
        $akun = Akun::orderBy('id','asc')->get();
        $jurnal = Jurnal::orderBy('tanggal','asc')->get();
        return view('app.akun',['akun' => $akun,'jurnal' => $jurnal]);
    }

    public function akun_aksi(Request $req)
    {
        $kode = $req->input('kode_akun');
        $nama = $req->input('nama_akun');
        $keterangan = $req->input('keterangan');
        Akun::create(['reff_akun' => $kode,
                       'nama_akun' => $nama,
                       'keterangan' => $keterangan 
    ]);
        return redirect('akun')->with('success','Akun telah disimpan');
    }

    public function akun_update($id, Request $req)
    {
        $kode = $req->input('reff_akun');
        $nama = $req->input('nama_akun');
        $ket = $req->input('keterangan');
        $akun = Akun::find($id);
        $akun->reff_akun = $kode;
        $akun->nama_akun = $nama;
        $akun->keterangan = $ket;
        $akun->save();
        return redirect('akun')->with('success','Akun telah diupdate');
    }

    public function akun_delete($id)
    {
        $akun = Akun::find($id);
        $akun->delete();
        return redirect()->back()->with("success","akun telah dihapus!");
    }



    public function rekapdata()
    {
    

        if(isset($_GET['dari'])){
        $supplier = Supplier::orderBy('nama','asc')->get();
        $pembelian = Pembelian::whereDate('tanggal','>=',$_GET['dari'])
        ->whereDate('tanggal','<=',$_GET['sampai'])
        ->orderBy('tanggal')
        ->get();

        $customer = Customer::orderBy('nama','asc')->get();
        $penjualan = Penjualan::whereDate('tanggal','>=',$_GET['dari'])
        ->whereDate('tanggal','<=',$_GET['sampai'])
        ->orderBy('tanggal')
        ->get();

        $total_keluar = DB::table('pembelians')
        ->select(DB::raw('SUM(nominal) as total'))
        ->whereDate('tanggal','>=',$_GET['dari'])
        ->whereDate('tanggal','<=',$_GET['sampai'])
        ->first();

        $total_masuk = DB::table('penjualans')
        ->select(DB::raw('SUM(nominal) as total'))
        ->whereDate('tanggal','>=',$_GET['dari'])
        ->whereDate('tanggal','<=',$_GET['sampai'])
        ->first();


      
      
        return view('app.rekapdata', [
            'pembelian' =>$pembelian,
            'supplier' =>$supplier, 
            'penjualan' =>$penjualan,
            'customer' =>$customer, 
            'total_masuk' =>$total_masuk, 
            'total_keluar' => $total_keluar
            ]);
        }else{
            
            return view('app.rekapdata');

        }

    
    }

    public function rekapdata_excel()
    {
        return Excel::download(new RekapExport, 'RekapLaporan.xlsx');
    }

    public function rekapdata_cetak()
    {       
        if(isset($_GET['dari'])){
            $supplier = Supplier::orderBy('nama','asc')->get();
            $pembelian = Pembelian::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
    
            $customer = Customer::orderBy('nama','asc')->get();
            $penjualan = Penjualan::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
            }
          
            return view('app.rekapdata_cetak',['pembelian' => $pembelian, 'penjualan' => $penjualan]);
        
    }


    public function supplier()
    {
        $supplier = Supplier::orderBy('nama','asc')->get();
        return view('app.supplier',['supplier' => $supplier]);
    }



    public function supplier_aksi(Request $req)
    {
        $nama = $req->input('nama');
        $notelpon = $req->input('notelpon');
        $email = $req->input('email');
        $jenis = $req->input('jenis');
        $alamat = $req->input('alamat');
        $kota = $req->input('kota');
        $status = $req->input('status');
        Supplier::create([
            'nama' => $nama,
            'no_telepon' => $notelpon,
            'Email' => $email,
            'jenis' => $jenis,
            'alamat' => $alamat,
            'kota' => $kota,
            'status' => $status,
            
        ]);
        return redirect('supplier')->with('success','Supplier telah disimpan');
    }

    public function supplier_update($id, Request $req)
    {
        $nama = $req->input('nama');
        $notelpon = $req->input('notelpon');
        $email = $req->input('email');
        $jenis = $req->input('jenis');
        $alamat = $req->input('alamat');
        $kota = $req->input('kota');
        $status = $req->input('status');

        $supplier = Supplier::find($id);
        $supplier->nama = $nama;
        $supplier->no_telepon = $notelpon;
        $supplier->Email = $email;
        $supplier->jenis = $jenis;
        $supplier->alamat = $alamat;
        $supplier->kota = $kota;
        $supplier->status = $status;
        $supplier->save();
        return redirect('supplier')->with('success','Supplier telah diupdate');
    }

    public function supplier_delete($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back()->with("success","supplier telah dihapus!");
    }

    public function customer()
    {
        $customer = Customer::orderBy('nama','asc')->get();
        return view('app.customer',['customer' => $customer]);
    }

    public function customer_aksi(Request $req)
    {
        $nama = $req->input('nama');
        $notelpon = $req->input('notelpon');
        $email = $req->input('email');
        $jenis = $req->input('jenis');
        $alamat = $req->input('alamat');
        $kota = $req->input('kota');
        $status = $req->input('status');
        Customer::create([
            'nama' => $nama,
            'no_telepon' => $notelpon,
            'email' => $email,
            'jenis' => $jenis,
            'alamat' => $alamat,
            'kota' => $kota,
            'status' => $status,
            
        ]);
        return redirect('customer')->with('success','Customer telah disimpan');
    }

    public function customer_update($id, Request $req)
    {
        $nama = $req->input('nama');
        $notelpon = $req->input('notelpon');
        $email = $req->input('email');
        $jenis = $req->input('jenis');
        $alamat = $req->input('alamat');
        $kota = $req->input('kota');
        $status = $req->input('status');

        $customer = Customer::find($id);
        $customer->nama = $nama;
        $customer->no_telepon = $notelpon;
        $customer->Email = $email;
        $customer->jenis = $jenis;
        $customer->alamat = $alamat;
        $customer->kota = $kota;
        $customer->status = $status;
        $customer->save();
        return redirect('customer')->with('success','Customer telah diupdate');
    }

    public function customer_delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with("success","customer telah dihapus!");
    }

    public function jurnal()
    {
        $jurnal = Jurnal::orderBy('tanggal')->get();
        $akun = Akun::orderBy('id','asc')->get();
        return view('app.jurnal',['jurnal' => $jurnal, 'akun' => $akun]);
    }
    

    public function jurnal_add()
    {
        $akun = Akun::orderBy('id','asc')->get();
        $jurnal = Jurnal::orderBy('id','asc')->get();
        return view('app.jurnal_tambah',['akun' => $akun, 'jurnal' => $jurnal]);
    }

    public function jurnal_aksi(Request $req)
    {
        $tanggal = $req->input('tanggal');
        $kode_akun = $req->input('kode_akun');
        $jenis = $req->input('jenis');
        $nominal = $req->input('nominal');
        $keterangan = $req->input('keterangan');
        Jurnal::create([
            'tanggal' => $tanggal,
            'kode_id' => $kode_akun,
            'jenis' => $jenis,
            'nominal' => $nominal,
            'keterangan' => $keterangan
            
            
        ]);
        return redirect('jurnal')->with('success','Customer telah disimpan');
    }

    public function jurnal_edit($id)
    {
    $akun = Akun::orderBy('id','asc')->get();
    $jurnal = Jurnal::find($id);
        return view('app.jurnal_edit', ['akun' => $akun, 'jurnal' => $jurnal]);
    }

    public function jurnal_update($id, Request $req)
    {
        $tanggal = $req->input('tanggal');
        $kode_akun = $req->input('kode_id');
        $jenis = $req->input('jenis');
        $nominal = $req->input('nominal');
        $keterangan = $req->input('keterangan');

        $jurnal = Jurnal::find($id);
        $jurnal->tanggal = $tanggal;
        $jurnal->kode_id = $kode_akun;
        $jurnal->jenis = $jenis;
        $jurnal->nominal = $nominal;
        $jurnal->keterangan = $keterangan;
        $jurnal->save();
        return redirect('jurnal')->with('success','Jurnal telah diupdate');
    }

    public function jurnal_delete($id)
    {
        $jurnal = Jurnal::find($id);
        $jurnal->delete();
        return redirect()->back()->with("success","customer telah dihapus!");
    }

    

    public function password()
    {
        return view('app.password');
    }

    public function password_update(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password telah diganti!");

    }

    public function pembelian()
    {
        
        $supplier = Supplier::orderBy('id','asc')->get();
        $pembelian = Pembelian::orderBy('tanggal','desc')->get();
        return view('app.pembelian',['pembelian' => $pembelian, 'supplier' => $supplier]);
    }

    public function pembelian_add()
    {
        $supplier = Supplier::orderBy('id','asc')->get();
        $now = Carbon::now();
        $thnbulan = $now->year . $now->month;
        $cek = Pembelian::count();
        if ($cek == 0){
            $urut =1000001;
            $nomer = 'PB' . $thnbulan . $urut;
        }else{
            $ambil = Pembelian::all()->last();
            $urut = (int)substr($ambil->kode_transaksi, -7) + 1;                     
            $nomer = 'PB' . $thnbulan . $urut;
        }
        return view('app.pembelian_tambah',['supplier' => $supplier, 'nomer' => $nomer]);
    }

    public function pembelian_aksi(Request $req)
    {

        $tanggal = $req->input('tanggal');
        $kode_transaksi = $req->input('kode_transaksi');
        $supplier = $req->input('supplier');
        $nominal = $req->input('nominal');
        $metode = $req->input('metode');
        $keterangan = $req->input('keterangan');

        Pembelian::create([
            'tanggal' => $tanggal,
            'kode_transaksi' => $kode_transaksi,
            'supplier_id' => $supplier,
            'nominal' => $nominal,
            'metode' => $metode,
            'Keterangan' => $keterangan
        ]);
        
        return redirect('pembelian')->with("success","pembelian telah disimpan!");
    }

    public function pembelian_edit($id)
    {
    $supplier = Supplier::orderBy('id','asc')->get();
    $pembelian = Pembelian::find($id);
        return view('app.pembelian_edit', ['pembelian' => $pembelian, 'supplier' => $supplier]);
    }

    public function pembelian_update($id, Request $req)
    {
        $tanggal = $req->input('tanggal');
        $kode_transaksi = $req->input('kode_transaksi');
        $supplier = $req->input('supplier');
        $nominal = $req->input('nominal');
        $metode = $req->input('metode');
        $keterangan = $req->input('keterangan');


        $pembelian = Pembelian::find($id);
        $pembelian->tanggal = $tanggal;
        $pembelian->kode_transaksi = $kode_transaksi;
        $pembelian->supplier_id = $supplier;
        $pembelian->nominal = $nominal;
        $pembelian->metode = $metode;
        $pembelian->Keterangan = $keterangan;
        $pembelian->save();

        return redirect()->back()->with("success","pembelian telah diupdate!");
    }

    public function pembelian_delete($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        return redirect(route('pembelian'))->with("success","pembelian telah dihapus!");
    }


    public function penjualan()
    {
        
        $customer = Customer::orderBy('id','asc')->get();
        $penjualan = Penjualan::orderBy('tanggal','desc')->get();
        return view('app.penjualan',['penjualan' => $penjualan, 'customer' => $customer]);
    }

    
    
    public function penjualan_add()
    {
        $customer = Customer::orderBy('id','asc')->get();
        $now = Carbon::now();
        $thnbulan = $now->year . $now->month;
        $cek = Penjualan::count();
        if ($cek == 0){
            $urut =1000001;
            $nomer = 'PJ' . $thnbulan . $urut;
        }else{
            $ambil = Penjualan::all()->last();
            $urut = (int)substr($ambil->kode_transaksi, -7) + 1;                     
            $nomer = 'PJ' . $thnbulan . $urut;
        }
        return view('app.penjualan_tambah',['customer' => $customer, 'nomer' => $nomer]);
    }

    public function penjualan_aksi(Request $req)
    {

        $tanggal = $req->input('tanggal');
        $kode_transaksi = $req->input('kode_transaksi');
        $customer = $req->input('customer');
        $nominal = $req->input('nominal');
        $metode = $req->input('metode');
        $keterangan = $req->input('keterangan');

        Penjualan::create([
            'tanggal' => $tanggal,
            'kode_transaksi' => $kode_transaksi,
            'customer_id' => $customer,
            'nominal' => $nominal,
            'metode' => $metode,
            'Keterangan' => $keterangan
        ]);
        
        return redirect('penjualan')->with("success","penjualan telah disimpan!");
    }

    public function penjualan_edit($id)
    {
    $customer = Customer::orderBy('id','asc')->get();
    $penjualan = Penjualan::find($id);
        return view('app.penjualan_edit', ['penjualan' => $penjualan, 'customer' => $customer]);
    }

    public function penjualan_update($id, Request $req)
    {
        $tanggal = $req->input('tanggal');
        $kode_transaksi = $req->input('kode_transaksi');
        $customer = $req->input('customer');
        $nominal = $req->input('nominal');
        $metode = $req->input('metode');
        $keterangan = $req->input('keterangan');


        $penjualan = Penjualan::find($id);
        $penjualan->tanggal = $tanggal;
        $penjualan->kode_transaksi = $kode_transaksi;
        $penjualan->customer_id = $customer;
        $penjualan->nominal = $nominal;
        $penjualan->metode = $metode;
        $penjualan->Keterangan = $keterangan;
        $penjualan->save();

        return redirect()->back()->with("success","penjualan telah diupdate!");
    }

    public function penjualan_delete($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->delete();

        return redirect(route('penjualan'))->with("success","penjualan telah dihapus!");
    }


    

    public function user()
    {
        $user = User::all();
        return view('app.user',['user' => $user]);
    }

    public function user_add()
    {
        return view('app.user_tambah');
    }

    public function user_aksi(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        
        // cek jika gambar kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);
        }else{
            $nama_file = "";
        }
 
 
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
            'foto' => $nama_file
        ]);

        return redirect(route('user'))->with('success','User telah disimpan');
    }

    public function user_edit($id)
    {
        $user = User::find($id);
        return view('app.user_edit', ['user' => $user]);
    }

     public function user_update($id, Request $req)
    {
         $this->validate($req, [
            'nama' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $name = $req->input('nama');
        $email = $req->input('email');
        $password = $req->input('password');
        $level = $req->input('level');
        

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        if($password != ""){
            $user->password = bcrypt($password);
        }

        // menyimpan data file yang diupload ke variabel $file
        $file = $req->file('foto');
        
        // cek jika gambar tidak kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);

            // hapus file gambar lama
            File::delete('gambar/user/'.$user->foto);

            $user->foto = $nama_file;
        }
        $user->level = $level;
        $user->save();

        return redirect(route('user'))->with("success","User telah diupdate!");
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        // hapus file gambar lama
        File::delete('gambar/user/'.$user->foto);
        $user->delete();

        return redirect(route('user'))->with("success","User telah dihapus!");
    }

    public function jurnalumum()
    {
        if(isset($_GET['dari'])){
            $akun = Akun::orderBy('id','asc')->get();
            $jurnal = Jurnal::whereMonth('tanggal','=',$_GET['dari'])
            ->whereYear('tanggal','=',$_GET['tahun'])
            ->orderBy('created_at')
            ->get();
            // DD($jurnal);
            return view('app.jurnalumum', [
                'akun' =>$akun,
                'jurnal' =>$jurnal
               
                ]);
        }else{
        return view('app.jurnalumum');

        }
    }

    public function jurnalumum_cetak()
    {
        if(isset($_GET['dari'])){
            $akun = Akun::orderBy('id','asc')->get();
            $jurnal = Jurnal::whereMonth('tanggal','=',$_GET['dari'])
            ->whereYear('tanggal','=',$_GET['tahun'])
            ->orderBy('created_at')
            ->get();
            // DD($jurnal);
            return view('app.jurnalumum_cetak', [
                'akun' =>$akun,
                'jurnal' =>$jurnal
               
                ]);
            }
    }


    public function bukubesar()
    {
        if(isset($_GET['dari'])){
            $akun = Akun::orderBy('id','asc')->get();
            $jurnal = Jurnal::whereMonth('tanggal','=',$_GET['dari'])
            ->whereYear('tanggal','=',$_GET['tahun'])
            ->orderBy('created_at')
            ->get();
            // DD($
            
            return view('app.bukubesar', [
                'akun' =>$akun,
                'jurnal' =>$jurnal
               
                ]);
        }else{ 

            
            return view('app.bukubesar');

        
        }
    }  

    public function bukubesar_cetak()
    {
        if(isset($_GET['dari'])){
            $akun = Akun::orderBy('id','asc')->get();
            $jurnal = Jurnal::whereMonth('tanggal','=',$_GET['dari'])
            ->whereYear('tanggal','=',$_GET['tahun'])
            ->orderBy('created_at')
            ->get();
            // DD($
            
            return view('app.bukubesar_cetak', [
                'akun' =>$akun,
                'jurnal' =>$jurnal
               
                ]);
        }
    }  
    

    public function neracasaldo()
    {
    
        if(isset($_GET['dari'])){
            $akun = Akun::all();
     
        $jurnal = Jurnal::with('akun')->whereMonth('tanggal','=',$_GET['dari'])
        ->whereYear('tanggal','=',$_GET['tahun'])
        
        ->get();
// dd($jurnal);
        // return response()->json($jurnal);
        $map =collect();

        foreach ($jurnal as $value) {
            $data=[
                'reff'=>$value->akun->reff_akun,
                'name'=>$value->akun->keterangan,
                'debit'=>($value->jenis=='debit')?$value->nominal:0,
                'kredit'=>($value->jenis=='kredit')?$value->nominal:0,
            ];
            $map[]=$data;

        }
    //    dd($map->name);
        return view('app.neracasaldo', compact('map','akun'));
        // return response()->json($map->groupBy('name')->all());
        }else{
            $akun = Akun::all();
            $jurnal = Jurnal::with('akun')
            ->get();
    // dd($jurnal);
            // return response()->json($jurnal);
            $map =collect();
    
            foreach ($jurnal as $value) {
                $data=[
                    'reff'=>$value->akun->reff_akun,
                    'name'=>$value->akun->keterangan,
                    'debit'=>($value->jenis=='debit')?$value->nominal:0,
                    'kredit'=>($value->jenis=='kredit')?$value->nominal:0,
                ];
                $map[]=$data;
    
            }
            return view('app.neracasaldo',compact('map','akun'));

        // }

    }}


    public function neracasaldo_cetak()
    {       
        if(isset($_GET['dari'])){
            $akun = Akun::all();
     
        $jurnal = Jurnal::with('akun')->whereMonth('tanggal','=',$_GET['dari'])
        ->whereYear('tanggal','=',$_GET['tahun'])
        ->get();
// dd($jurnal);
        // return response()->json($jurnal);
        $map =collect();

        foreach ($jurnal as $value) {
            $data=[
                'reff'=>$value->akun->reff_akun,
                'name'=>$value->akun->keterangan,
                'debit'=>($value->jenis=='debit')?$value->nominal:0,
                'kredit'=>($value->jenis=='kredit')?$value->nominal:0,
            ];
            $map[]=$data;

        }
    //    dd($map->name);
        return view('app.neracasaldo_cetak', compact('map','akun'));
        // return response()->json($map->groupBy('name')->all());
        }
    }
}

