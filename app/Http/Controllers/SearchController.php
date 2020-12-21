<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
        public function index() {
                $q= request()->get("q");
                if($q == null || $q == "") {
                        $members= null;
                        return view("admin/search")->with([
                                "members"=> $members
                        ])->withInputs();
                }

                
                $members= \App\Models\Member::where("fullname", "like", "%$q%")
                        ->orWhere("nat_id","=","$q")
                        ->orWhereHas("relatives", function($query) use($q) {
                                $query->where("fullname", "like", "%$q%");
                                $query->where("nat_id", "=", "%$q%");
                        })
                        ->get();
                
                
                return view("admin/search")->with([
                        "members"=> $members
                ]);
        }
}
