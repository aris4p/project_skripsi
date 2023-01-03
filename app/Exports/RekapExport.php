<?php

namespace App\Exports;

use App\Pembelian;
use App\Penjualan;
use App\Customer;
use App\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
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
          
            return view('app.rekapdata_excel',['pembelian' => $pembelian,
             'penjualan' => $penjualan,
             'customer' => $customer,
             'supplier' => $supplier]);
    }
}
