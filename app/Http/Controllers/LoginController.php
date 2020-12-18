<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;


//TODO(walid): replace eastern arabic numbers;

class LoginController extends Controller
{

        public function getLogin() {
                return view("login");
        }


        public function postLogin() {
                $nat_id= request()->get("nat_id");
                $validation_errors = [];
                
                if($nat_id == null) {
                        $validation_errors[] = "الرقم القومي مطلوب";
                        session()->flash("errors", $validation_errors);
                        return back();
                } else if (strlen($nat_id) != 14) {
                        $validation_errors[] = "الرقم القومي يجب أن يتكون من 14 رقم";
                        session()->flash("errors", $validation_errors);
                        return back();
                }
                
                $member= Member::where([
                        ["nat_id", "=", $nat_id]
                ])->with("relatives")->first();



                if($member) {

                        $password = $member->password;
                        if($password == null) {
                                session()->put("user", $member);
                                redirect("/profile");
                                
                                
                        } else if ($password != null && request()->get("password") == null){ 
                                session()->flash("use_password", "");
                                session()->flash("old_nat", $member->nat_id);
                                return back();
                                
                        } else if ($password != null && request()->get("password")) {

                                if($member-> password == request()->get("password")) {
                                        //TODO(walid): hash the password;
                                        
                                        session()->put("user", $member);
                                        return redirect("/profile");

                                } else {
                                        session()->flash("errors",  ["الرقم القومي أو كلمة المرور غير صحيحين"]);
                                        session()->flash("use_password",  true);

                                        return back();
                                }
                                
                        }//handle normal login;

                }else {
                        session()->flash("errors",  ["هذا العضو غير موجود! تأكد من الرقم القومي"]);
                        return back();
                        

                } // no member


        }


        public function logout(){
                session()->flush();
                return redirect("/login");
        }
        
}
