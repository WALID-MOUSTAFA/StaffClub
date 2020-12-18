<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyRelativeController extends Controller
{
                
        
        public function addRelative()
        {
                // dd(request()->all());
                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=> "required|digits:14",
                        "kinship"=>"required"
                ]);

                if($validator->fails()) {
                        session()->flash("add-relative-errors");
                        return redirect("/profile") ->withErrors($validator)
                        ->withInput();
                }

                $relative= new \App\Models\FamilyRelative();

                
                $fullname= request()->get("fullname");
                $nat_id= request()->get("nat_id");
                $req_kinship= request()->get("kinship");
                
                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                                        $relative->pic= $pic;

                }
                
                //TODO(walid): check if exists;
                $kinship= \App\Models\Kinship::find($req_kinship);

                $relative->fullname= $fullname;
                $relative->nat_id= $nat_id;
                $relative->kinship()->associate($kinship);

                //NOTE(walid): the condition will controll which memeber
                //is associated with the relative;
                if(true) {
                        $relative->member()->associate(session()->get("user"));
                }
                
                if($relative->save()) {
                        session()->flash("add-relative-success", "تم الإضافة بنجاح");
                        return back();
                }
                
                
        }
        
        
        public function editRelative($relativeId)
        {
                
                // dd(request()->all());
                //TODO(walid): make validator;

                
                                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=> "required|digits:14",
                        "kinship"=>"required"
                ]);

                if($validator->fails()) {
                        session()->flash("edit-relative-errors");
                        return redirect("/profile") ->withErrors($validator)
                        ->withInput();
                } 

                $relative= \App\Models\FamilyRelative::find($relativeId);

                
                $fullname= request()->get("fullname");
                $nat_id= request()->get("nat_id");
                $age= request()->get("age");
                $req_kinship= request()->get("kinship");
                $gender="";
                
                // dd(request()->all());
                if(request()->hasFile("pic") || request()->file("pic") != null) {
                        $pic="";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $relative->pic= $pic;

                }

                
                //TODO(walid): check if exists;
                $kinship= \App\Models\Kinship::find($req_kinship);
                
                

                $relative -> fullname= $fullname;
                $relative -> nat_id= $nat_id;
                if($req_kinship == "son"
                   || $req_kinship == "father"
                   || $req_kinship == "husband"
                   || $req_kinship == "brother")
                {
                        
                        $gender="male";
                }else {
                        $gender="female";
                }

                $relative->gender=$gender;
                $relative->age= $age;
                $relative -> kinship()->associate($kinship);
                
                if($relative->save()) {
                        session()->flash("edit-relative-success",
                                         ["تم التعديل بنجاح"]
                        );
                        return back();
                }
                        
        }


        public function deleteRelative($id) {
                $relative= \App\Models\FamilyRelative::find($id);
                if($relative != null) {
                        $relative->delete();
                        session()->flash("delete-relative-success", "تم الحذف بنجاح");
                        return back();
                } else {
                        session()->flash("delete-relative-errors", "لم يتم العثور على القريب!");
                        return back();
                }
        }
        
}