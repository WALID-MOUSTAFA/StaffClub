@extends("admin/layout")

@section("title")
    <title>  -  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card ">

	    <form method="post" action="/admin/questions/edit/{{$question->id}}">
		@csrf
		<div class="input-wrapper">
		    <label for="">السؤال</label>
		    <input class="form-control" name="question_body" type="text" value="{{ $question->question_body }}"/>

		</div>
		<button type="button" class="btn btn-primary add-option">إضافة خيار</button>

		<hr/>
		
		<ul class="options">
		    @foreach($question->options()->get() as $option)
			
			<div class="input-wrapper">
			    <input class="form-control" name="options[]" type="text" value="{{ $option->option_body }}"/>
			    <button type="button" class="btn btn-danger delete-option">حذف</button>
			</div>
		    @endforeach
		</ul>
		

		<button id="submit-edit" class="btn btn-warning btn-block">حفظ</button>
	    </form>
	    
	</div>

    </div>

@endsection


@push("scripts")

<script>
 $(document).on("click","button.delete-option", function() {
     $(this).closest(".input-wrapper").remove();
 });
 
 $("button.add-option").on("click", function() {
     console.log("d");
     var element= "<div class='input-wrapper'>"
     element += "<input class='form-control' name='options[]' />";
     element += "<button type='button' class='btn btn-danger delete-option'>حذف</button>";
     element += "</div>";
     $("ul.options").append(element);
 });


</script>
@endpush
