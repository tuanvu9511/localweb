<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Autocomplate extends Controller
{
     public function query(Request $request)
    {
      $input = $request->all();

        $data = User::select("name")
                  ->where("name","LIKE","%{$input['query']}%")
                  ->get();
   
        return response()->json($data);
    }
}
