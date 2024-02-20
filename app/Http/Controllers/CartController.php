<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    function index(){

        return view('cart');   
        
    }

    function getBarang(Request $request) 
    {
        
        $id = $request->id;
        if($id != ''){
            
            try{
                $result = DB::table('items')
                            ->whereRaw("kode_barang like '%$id%' or descr like '%$id%'")
                            ->get();
                return response()->json(['result' => $result]);
            } catch (\Exception $e) {

            }

        } else {

            try{
                $result = DB::table('items')
                            ->get();
                return response()->json(['result' => $result]);
            } catch (\Exception $e) {
                
            }

        }

    }

    function insertBarangCart(Request $request) {

        $kodeBarang = $request->kodeBarang;
        $qty = $request->qty;

        $insertMasterBarang = DB::table('cart')
                            ->insert([
                                'kode_barang' => $kodeBarang,
                                'qty' => $qty,
                            ]);

        return response()->json(['result' => 'ok']);
        
    }

    function getDataCart()
    {
        
        $result = DB::table('cart as a')
                    ->join('items as b', 'a.kode_barang' , '=', 'b.kode_barang')
                    ->get();

        return response()->json(['result' => $result]);

    }

    function deleteBarang(Request $request)
    {

        $id = $request->id;

        $update = DB::table('cart')
                        ->where('kode_barang', '=', $id)
                        ->delete();

        return response()->json(['result' => 'ok']);

    }

}
