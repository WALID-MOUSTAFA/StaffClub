<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

        //TODO(walid): use bootstrap card pic instead of custom one;
        //TODO(walid): edit member data;

        
        public function getProfile ()
                
        {
                $kinships = \App\Models\Kinship::all();

                return view("profile")->with([

                        "user" => session()->get("user"),
                        "kinships"=> $kinships,
                ]);

        }

        

        
        
        
        

}
