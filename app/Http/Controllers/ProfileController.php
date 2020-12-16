<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

        //TODO(walid): start design the admin dashboard using old lte3;
        //TODO(walid): add the rest of relative functionality;
        //TODO(walid): add member modify data functionality;
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

        

        
        public function editMember($id)
        {

                // if(request()->get("fullname") == null ) {
                //         session()->flash("edit-member-errors", ["هذا الحقل مطلوب"] );
                //         return back();
                // }
                
                $current_user= session()->get("user");
                $current_user->fullname= request()->get("fullname");
                $current_user->phone = request()->get("phone");
                $current_user->gender = request()->get("gender");

                
                if($current_user->save()) {
                        session()->put("user", $current_user);
                        return back();
                } //TODO(walid): handle errors;

        }
        
        
        
        public function addRelative()
        {
                //TODO(walid): add validator;
                
                $fullname= request()->get("fullname");
                $nat_id= request()->get("nat_id");
                $gender= request()->get("gender");
                $req_kinship= request()->get("kinship");

                //TODO(walid): check if exists;
                $kinship= \App\Models\Kinship::find($req_kinship);

                $relative= new \App\Models\FamilyRelative();
                $relative->fullname= $fullname;
                $relative->nat_id= $nat_id;
                $relative->kinship()->associate($kinship);
                $relative->member()->associate(session()->get("user"));

                if($relative->save()) {
                        session()->flash("add-relative-success", "تم الإضافة بنجاح");
                        return back();
                }
                

        }


        public function editRelative($relativeId)
        {
                
        }

        
        

}
