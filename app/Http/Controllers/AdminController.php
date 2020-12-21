<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
        public function index() {
                return view("admin/index");
        }



        public function viewMembers() {
                $members= \App\Models\Member::all();
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
        
        //TODO(walid): prevent member from editing another member except super_admin;
        //TODO(walid): it's too late, finish the validator later;
        public function editMember($id)
        {
                
                $validator= Validator::make(request()->all(), [

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
                        $current_user->pic= $pic;

                }

                
                
                if($current_user->save()) {
                        session()->put("user", $current_user);
                        return back();
                } //TODO(walid): handle errors;

        }

        
        public function postEditSingleMember($id) {
                
                $member= \App\Models\Member::find($id);

                       
                $fullname= request()->get("fullname");
                $phone = request()->get("phone");
                $gender = request()->get("gender");
                
                $member->fullname= $fullname;
                $member->phone= $phone;
                $member->gender= $gender;
                
                $member->logout= 1;
                
                if($member->save()) {
                        session()->flash("success", "تم التعديل بنجاح");
                        return redirect("/admin/members");
                } //TODO(walid): handle errors;

                
        }


        public function editRelative($id) {
                
        }
        
        //TODO(walid): delete member;
        
        
}
