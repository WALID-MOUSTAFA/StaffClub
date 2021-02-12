<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
            return view("admin.news");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view("admin.createNews");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validaor= Validator::make(request()->all(), [
                    "title"=> "required",
                    "content"=> "required",
                    "image"=>"required|between:0,2048|mimes:jpeg,png,svg,gif",
                    
            ], ["content.required"=> "محتوى الخبر لا يمكن ان يكون فارغا",
                "image.required"=> "الصورة مطلوبة"
            ], []) ;

            if($validaor->fails()) {
                    return back()->withErrors($validaor)->withInput();
            }


            $title= request()->get("title");
            $content= request()->get("content");
            $active= false;
            $image= "";
            
            if(request()->has("active")){
                    if(request()->get("active") == "on"){
                            $active = 1;
                    }else if(request()->get("active") == "") {
                            $active = 0;
                    } 
            }
            

            $news=new \App\Models\News();
            $success= $this->saveNews($news,
                            $title,
                            $content,
                            $active,
                            session()->get("user")) ;

            if($success) {
                    session()->flash("success", "تم إضافة الخبر");
                    return redirect("/admin/news");
            }else {
                    session()->flash("error", "حدث خطأ ما أثناء إضافة الخبر");

            }
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }


        public function saveNews($news, $title, $content, $active,  $mod) {
                $image= "";
                $news->title= $title;
                $news->content= $content;
                $news->active=$active;
                $news->mod()->associate($mod);

                if($news->save()) {
                        //uploading the image
                        if(request()->hasFile("image")
                           && request()->file("image") != null) {
                                $returned_name=
                                             uploadImage(request()->file("image"));
                                if( $returned_name!= null){
                                        $image=$returned_name;
                                }
                        }
                
                        $news_image= new \App\Models\NewsImage();
                        $news_image->news()->associate($news);
                        $news_image->image=$image;
                        $news_image->save();
                        return true;

                } else {
                        return false;
                }
                
        }


}
