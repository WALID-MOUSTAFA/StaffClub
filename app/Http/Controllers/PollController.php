<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//TODO(walid): all checks and validations and error messages;


class PollController extends Controller
{


        public function index() {

                $polls= \App\Models\Poll::all();
                
                return view("admin/polls")->with([
                        "polls"=> $polls
                ]);
        }





        public function viewSinglePoll($id) {

                $poll= \App\Models\Poll::find($id);
                return view("admin/singlePoll")->with([
                        "poll" => $poll
                ]);
        }

        public function getAddSinglePoll() {
                return view("admin/addSinglePoll");
        }

        
        public function postAddSinglePoll() {
                //TODO(walid): validations;
                $poll= new \App\Models\Poll();
                $poll->title= request()->get("title");
                $poll->desc= request()->get("desc");
                if($poll->save()) {
                        session()->flash("success", "تم إضافة الاستبيان بنجاح، يمكنك الآن إضافة الاسئلة كما تشاء");
                        return redirect("/admin/polls");
                }else {
                        session()->flash("error", "حدث خطأ ما");
                        return redirect("/admin/polls");

                }
        }

        
        public function getEditSinglePoll($id) {
                $poll = \App\Models\Poll::find($id);
                return view("admin/editSinglePoll")->with([
                        "poll"=>$poll
                ]);

        }


        public function postEditSinglePoll($id) {
                // dd(request()->all());
                $poll = \App\Models\Poll::find($id);
                $validator= Validator::make(request()->all(), [
                        "title" => "required",
                        "desc" => "required",
                ]);
                if($validator->fails()) {
                        return back()->withErrors($validator);

                }

                $poll->title= request()->get("title");
                $poll->desc= request()->get("desc");
                if(request()->has("active")){
                        if(request()->get("active") == "on"){
                                $poll->active = 1;
                        }else if(request()->get("active") == "") {
                                $poll->active = 0;
                        } 
                }else {
                        $poll->active = 0;
                }

                if($poll->save()) {
                        session()->flash("success", "تم تعديل الاستبيان");
                        return redirect("/admin/polls");
                } 

        }


        public function postDeleteSinglePoll($id) {
                $poll= \App\Models\Poll::find($id);
                if($poll->delete()) {
                         session()->flash("success", "تم الحذف بنجاح");
                         return redirect("/admin/polls/");
                }else {
                        session()->flash("success", "حدث خطأ ما أثناء الإضافة");
                        return redirect("/admin/polls/");
                }  
                
        } 

        

        
        
        public function getAddQuestion($id) {
                $poll = \App\Models\Poll::find($id);
                return view("admin/addSingleQuestion")->with(["poll"=>$poll]);
        }

        public function postAddQuestion($id) {
                $poll= \App\Models\Poll::find($id);
                $options=[];
                $question= new \App\Models\Question();
                foreach(request()->get("options") as $option) {
                        $o= new \App\Models\Option();
                        $o->option_body= $option;
                        $options[]= $o;
                }

                $question->poll()->associate($poll);
                $question->question_body= request()->get("question_body");
                if($question->save()) {
                        $question->options()->saveMany($options);
                        session()->flash("success", "تم الإضافة بنجاح");
                        return redirect("/admin/polls/".$id);
                
                }else {
                        session()->flash("success", "حدث خطأ ما أثناء الإضافة");
                        return redirect("/admin/polls/".$id);
                }

        }



        public function getEditQuestion($id) {
                $question = \App\Models\Question::find($id);
                return view("admin/editSingleQuestion")->with([
                        "question" => $question
                ]);
        }

        public function postEditQuestion($id) {
                $question = \App\Models\Question::find($id);
                $options= [];
                foreach(request()->get("options") as $option) {
                        $o= new \App\Models\Option();
                        $o->option_body= $option;
                        $options[]= $o;
                }
                $question->question_body= request()->get("question_body");
                $question->options()->delete();
                $question->options()->saveMany($options);
                if($question->save()) {
                        session()->flash("success", "تم التعديل بنجاح");
                        return redirect("/admin/polls/".$question->poll()->first()->id);
                }else {
                        session()->flash("error", "حدث خطأ ما أثناء التعديل");
                        return redirect("/admin/polls/".$question->poll()->first()->id);
                        
                } 
                
        }



        public function postDeleteQuestion($id) {
                $question = \App\Models\Question::find($id);
                $question->delete();
                return back();
        }
        


        //// reports /////
        
        public function singlePollReport($id) {
                $poll = \App\Models\Poll::find($id);
                $voters= \App\Models\PollVoters::where("poll_id","=",$id)->get();
                $questions = $poll->questions()->get();
                
                
                return view("admin/singlePollReport")->with([
                        "poll"=>$poll,
                        "qcount" => count($poll->questions()->get()),
                        "num_of_voters" => count($voters),
                ]);
        }  
        

        
}
