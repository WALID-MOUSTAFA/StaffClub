@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="wrapper">
	
	<div class="card">

	    
	    @if($errors->any())
		<div class="alert alert-danger">
		    <ul>
			@foreach($errors->all() as $error)
			    <li>{{ $error }}</li>
			@endforeach
		    </ul>
		</div>
	    @endif

	    
	    <form method="post" class="delete-poll-form d-inline" action="/admin/polls/edit/{{$poll->id }}">
		@csrf
		<div class="input-wrapper">
		    <label for="">عنوان الاستبيان</label>
		    <input class="form-control" name="title" type="text" value=" {{ $poll->title }}"/>
		</div>
		

		<div class="input-wrapper">
		    <label for="">الوصف</label>
		    <textarea class="form-control" cols="30" id="" name="desc" rows="10">{{$poll->desc }}</textarea>
		</div>


		<div class="input-wrapper">
		    <div class="custom-control custom-switch">
			<input name="active" type="checkbox" {{ $poll->active == 1? "checked" : "" }} class="custom-control-input" id="activeswitch">
			<label class="custom-control-label" for="activeswitch">تفعيل</label>
		    </div>

		</div>

		<button type="submit" class="btn btn-warning btn-block">تعديل</button>
	    </form>

	    
	</div>
    </div>
	    
	    
@endsection


@push("scripts")

@endpush
