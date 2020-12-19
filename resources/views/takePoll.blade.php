<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>الاستبيانات -  {{ config("app.name") }} </title>

	
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
	<link href="{{asset("css/profile.css")}}" rel="stylesheet"/>
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet"> 
    </head>

    <!-- TODO(walid): add font awesome -->
    <!-- TODO(walid): download jquery and bootstrap locally -->

    <body>

	<div class="content-wrapper profile-wrapper">

	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">نادي أعضاء هيئة التدريس</a>

		

		
		     
		     
	    </nav>
	    
	    <div class="container">

		<div class="poll" data-id ="{{ $poll->id }}">
		@foreach($poll->questions()->get() as $question)
		    <div class="question" data-question-id="{{ $question->id }}">
			{{ $question->question_body }}
			@foreach($question->options()->get() as $option)
			    <div class="option">
				<label for="">{{ $option->option_body }}</label>
				<input type="radio" id="male" name="poll{{$question->id}}" value="{{ $option->id }}">
			    </div>
			@endforeach
		    </div>
		@endforeach
		</div>
		
		<button class="btn btn-success send">إرسال</button>
	    </div>
	    
	


	
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" ></script>
	<script src="{{ asset("/scripts/bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js") }}"></script>

	<script>
	 $("button.send").on("click", function() {
	     var answers= {};
	     var questions= $("div.poll .question");
	     questions.each(function() {
		 var qid= $(this).data("question-id");
		 var options= $(this).find(".option");
		 options.each(function() {
		     var radio_input = $(this).find("input");
		     if(radio_input.is(":checked")) {
			 answers[qid] = radio_input.val();
		     } 
		 });
	     });


	     var final_data= {
		 _token: "{{ csrf_token() }}",
		 poll_id: $(".poll").data("id"),
		 answers: answers
	     } 

	     $.ajax({
		 type: "POST",
		 url: "/polls/save-answers",
		 data: final_data,
		 success: function(result) {
		     if(result == "success") { 
			 window.location= "/profile";
		     } else {
			 //TODO(walid): handle error;
		     }
		 }
		 
	     });
	     
	 });
	</script>
	
    </body>

</html>
