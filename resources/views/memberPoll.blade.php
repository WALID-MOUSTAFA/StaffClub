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


    <body>

	<div class="content-wrapper profile-wrapper">

	    
			    <nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="/profile">الملف الشخصي - نادي أعضاء هيئة التدريس</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav ml-auto">

					<a href="/profile" id="" class="mx-1 my-1 btn btn-primary">
					    الرجوع
					</a>

				    </ul>
				</div>

			    </nav>

			    
	    <div class="container">
		@foreach($active_polls as $poll)
		    @if(memberAllowedToVote(session()->get("user"), $poll))
			<a href="/polls/{{$poll->id}}">
			    <p class="h3"> {{ $poll->title }}</p>
			</a>
		    @endif
		@endforeach
	    </div>
	    
	


	
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" ></script>
	<script src="{{ asset("/scripts/bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js") }}"></script>
	
	
    </body>

</html>
