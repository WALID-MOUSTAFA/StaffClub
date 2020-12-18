@extends("admin/layout")

@section("title")
    <title>  -  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card ">
	    <card class="card-heade">
		<p class="h1">إضافة سؤال</p>
	    </card>
	    <button type="button" class="btn btn-primary add-option">إضافة خيار</button>

	    <form method="post" action="/admin/polls/{{ $poll->id }}/add-question">
		@csrf
		
		<div class="input-wrapper">
		    <label for="">السؤال</label>
		    <input class="form-control" name="question_body" type="text" value=""/>
		</div>
		
		<hr/>
		
		<ul class="options">
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
