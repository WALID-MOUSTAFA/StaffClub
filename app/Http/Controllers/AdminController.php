<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        public function index() {
                return view("admin/index");
        }



        public function viewMembers() {
                $members= \App\Models\Member::paginate(10);
                return view("admin/members")->with([
                        "members"=>$members
                ]);
        }



        public function viewSingleMember($id) {
                
                $member= \App\Models\Member::find($id);
                $kinships= \App\Models\Kinship::all();
                return view("admin/singleMember")->with([
                        "member" => $member,
                        "kinships"=> $kinships
                ]); 
        }


        public function getEditSingleMember($id) {
                $member= \App\Models\Member::find($id);
                return view("admin/editSingleMember")->with(["member"=>$member]);
        }
        

        
        public function postEditSingleMember($id) {
                //TODO(walid): add validation;
                //TODO(walid): prevent member from editing another member except super_admin;

                $member= \App\Models\Member::find($id);

                       
                $fullname= request()->get("fullname");
                $phone = request()->get("phone");
                $gender = request()->get("gender");

                if(request()->has("nat_id") ) {
                        $member->nat_id= request()->get("nat_id");
                                                
                }
                
                
                if(request()->has("password")) {
                        $member->password= request()->get("password");
                } 
                
                
                $member->fullname= $fullname;
                $member->phone= $phone;
                $member->gender= $gender;
                
                $member->logout= 1;
                
                if($member->save()) {
                        session()->flash("success", "تم التعديل بنجاح");
                        return redirect("/admin/members");
                } //TODO(walid): handle errors;

                
        }



        
        public function getAddMember() {
                return view("admin/addMember");
        } 

       
        //TODO(walid): it's too late, finish the validator later;
        public function postAddMember()
        {
                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=>"required:digits:14",
                        "phone"=>"required",
                        "password"=> "required",
                        // "kinship"=>"required",
                        "gender"=> "required",
                ]);

                
                if($validator->fails()) {
                        session()->flash("add-member-errors", ""    );
                        return back() ->withErrors($validator)
                                      ->withInput();
                        
                }

                $member= new \App\Models\Member();

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
                        $member->pic= $pic;

                }

                

                
                $member->fullname= request()->get("fullname");
                $member->nat_id= request()->get("nat_id");
                $member->password= request()->get("password");
                $member->phone = request()->get("phone");
                $member->gender = request()->get("gender");

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
                        $member->pic= $pic;

                }

                
                if($member->save()) {
                        session()->flash("success", "تم إضافة العضو بنجاح");
                        return redirect("/admin/members");
                } //TODO(walid): handle errors;

        }


        

        public function editRelative($id) {
                
        }
        
        //TODO(walid): delete member;
        
        
}
