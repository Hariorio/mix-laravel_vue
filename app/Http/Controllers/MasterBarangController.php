<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use


class MasterBarangController extends Controller
{
    
    public function index() 
    {


        return view('master.barang');   
    }

    function insertBarang(Request $request) {

        $kodeBarang = $request->kodeBarang;
        $namaBarang = $request->namaBarang;
        $basePriceBarang = $request->basePriceBarang;
        $sellPriceBarang = $request->sellPriceBarang;

        $insertMasterBarang = DB::table('items')
                            ->insert([
                                'id' => rand(1, 100), // <-- sementara id nya pakai random
                                'kode_barang' => $kodeBarang,
                                'descr' => $namaBarang,
                                'base_price' => $basePriceBarang,
                                'sell_price' => $sellPriceBarang,
                                'tr_date' => now()
                            ]);

        return response()->json(['result' => 'ok']);
        
    }

    function getData(){

        // $result = DB::table('items')
        //                 ->get();

        // return response()->json(['result' => $result]);

        return response()->json(['result' => 'asdasdas']);
                        
    }
        
}
