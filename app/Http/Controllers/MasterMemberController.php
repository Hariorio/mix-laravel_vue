<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterMemberController extends Controller
{
    
    public function index() 
    {


        return view('master.member');   
    }

    function insertMember(Request $request) {

        $name = $request->name;
        $address = $request->address;
        $city = $request->city;
        $phone = $request->phone;

        $insertMasterBarang = DB::table('members')
                            ->insert([
                                'id' => rand(1, 100), // <-- sementara id nya pakai random
                                'name' => $name,
                                'address' => $address,
                                'phone' => $phone,
                                'active_flag' => 'Y',
                                'tr_date' => now()
                            ]);

        return response()->json(['result' => 'ok']);
        
    }

    function getDataMember(){

        $result = DB::table('members')
                        ->get();

        return response()->json(['result' => $result]);

        // return response()->json(['result' => 'asdasdas']);
                        
    }

}
