<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MemberController extends Controller
{

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

        
}