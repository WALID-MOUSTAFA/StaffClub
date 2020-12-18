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
        
        
        public function postEditSingleMember($id) {
                
                $member= \App\Models\Member::find($id);

                       
                $fullname= request()->get("fullname");
                $phone = request()->get("phone");
                $gender = request()->get("gender");
                
                $member->fullname= $fullname;
                $member->phone= $phone;
                $member->gender= $gender;
                
                
                if($member->save()) {
                        session()->flash("success", "تم التعديل بنجاح");
                        return redirect("/admin/members");
                } //TODO(walid): handle errors;

        }


        public function editRelative($id) {
                
        }
        
        //TODO(walid): delete member;
        
        
}
