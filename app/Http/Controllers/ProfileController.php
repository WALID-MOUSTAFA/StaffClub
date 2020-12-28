<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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




        //TODO(walid): prevent member from editing another member except super_admin;
        //TODO(walid): it's too late, finish the validator later;
        public function editMember($id)
        {
                
                $current_member_id= session()->get("user")->id;
                if($current_member_id != $id) {
                        return "error";
                }

                
                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "phone"=>"required",
                        // "kinship"=>"required",
                        "gender"=> "required",
                        "faculty"=>"required",
                ]);

                
                if($validator->fails()) {
                        session()->flash("edit-member-errors", ""    );
                        return redirect("/profile") ->withErrors($validator)
                                                    ->withInput();

                }
                
                $current_user= session()->get("user");
                $current_user->fullname= request()->get("fullname");
                $current_user->phone = request()->get("phone");
                $current_user->gender = request()->get("gender");
                $current_user->faculty()->associate(\App\Models\Faculty::find(request()->get("faculty")));

                if(request()->has("password") && request()->get("password") != null){
                        $current_user->password= request()->get("password");
                }
                if(request()->get("designation") != null) {
                        $member->designation = request()->get("designation");
                }

                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                session()->flash("edit-member-errors", ""    );

                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $current_user->pic= $pic;

                }

                
                if($current_user->save()) {
                        session()->put("user", $current_user);
                        session()->flash("success", "تم التعديل بنجاح");
                        return back();
                } else {
                        session()->flash("error", "حدث خطأ ما أثناء التعديل");
                        return back();
                } 

        }


        


        

        
        
        
        

}
