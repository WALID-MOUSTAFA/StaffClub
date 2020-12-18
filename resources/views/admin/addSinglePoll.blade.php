@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <card class="card-header">
		<p class="h1">إضافة استبيان جديد</p>

		<card class="card-body">

		    <form  method="post" action="/admin/polls/add">
			@csrf
			<div class="input-wrapper">
			    <label for="">عنوان الاستبيان</label>
			    <input class="form-control" name="title" type="text" value=""/>
			</div>

			<div class="input-wrapper">
			    <label for="">الوصف</label>

			    <textarea cols="30" id="" name="desc" rows="10"></textarea>
			</div>

			<button class="btn btn-success btn-block">إضافة</button>
		    </form>
		    
		</card>

	    </card>
	    
	    
	    
	    
@endsection


@push("scripts")

@endpush
