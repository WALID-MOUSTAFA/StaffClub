<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>الملف الشخصي -  {{ config("app.name") }} </title>

	
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

		

		
		<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		     <span class="navbar-toggler-icon"></span>
		     </button>

		     <div class="collapse navbar-collapse" id="navbarSupportedContent">
		     <ul class="navbar-nav mr-auto">
		     <li class="nav-item active">
		     <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		     </li>
		     <li class="nav-item">
		     <a class="nav-link" href="#">Link</a>
		     </li>
		     <li class="nav-item dropdown">
		     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		     Dropdown
		     </a>
		     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		     <a class="dropdown-item" href="#">Action</a>
		     <a class="dropdown-item" href="#">Another action</a>
		     <div class="dropdown-divider"></div>
		     <a class="dropdown-item" href="#">Something else here</a>
		     </div>
		     </li>
		     <li class="nav-item">
		     <a class="nav-link disabled" href="#">Disabled</a>
		     </li>
		     </ul> -->
		     <ul class="navbar-nav ml-auto">

			 <button id="edit-member" class="mx-1 my-1 btn btn-warning">
			     تعديل بياناتي
			 </button>
			 
			 <button id="add-relative" class="mx-1 my-1 btn btn-success">
			     إضافة أفراد عائلة
			 </button>

		     </ul>
		     

		     </nav>
	    
	    <div class="container">

		<div class="row">
		    
		    <div class="side-section col-sm-4">
			<div class="avatar">
			    <img alt="" src="https://picsum.photos/300/300"/>
			</div>
			<hr/>


			<div class="side-info">

			    <table class="table side-info-table">
				<tbody>
				    <tr>
					<td class="td-key">المهنة</td>
					<td class="td-value">مدرس مساعد بكلية العلوم</td>
				    </tr>
				</tbody>
			    </table>
			    
			</div>
			
			
		    </div> <!-- side -->


		    
		    <div class="wide-section col-sm-8">
			<div>
			    <p class="h3">
				{{$user->fullname}}
			    </p>

			</div>
			

			

			<div class="contact-info">

			    <p class="other-color">
				معلومات الاتصال
			    </p>
			    
			    <table class="table contact-info-table">
				<tbody>

				    <tr>
					<td class="td-key">رقم الهاتف</td>
					<td>{{ $user->phone }}</td>
				    </tr>

				    <tr>
					<td class="td-key">العنوان</td>
					<td >{{ $user->address }}</td>
				    </tr>

				    <tr>
					<td class="td-key">البريد الإلكتروني</td>
					<td>{{ $user->email }}</td>
				    </tr>

				    
				    <tr>
					<td class="td-key">الجنس</td>
					<td> {{ $user->gender == "male"? "ذكر"
						: "أنثى"}}</td>
				    </tr>

				    
				</tbody>
			    </table>
			</div> <!-- contact info -->



			<div class="relatives">

			    <p class="other-color">
				الأقارب والعائلة
			    </p>

			    
			    @if(!$user->relatives()->get())
				لا يوجد
			    @else
				<div class="row relatives_gallery">

				    @foreach($user->relatives()->get() as $relative )

				    <!-- edit modal -->
				    <div id="edit-relative-modal" class="modal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
					    <div class="modal-content">
						<div class="modal-header">
						    <h5 class="modal-title">تعديل الأقارب</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						    </button>
						</div>

						<div class="modal-body">
						    <form action="">
							@csrf
							<div>
							    <label for="">الاسم</label>
							    <input name="fullname" type="text" value="{{ $relative -> fullname }}"/>
							</div>
							<div>
							    <label for="">الرقم القومي</label>
							    <input name="nat_id" type="text" value="{{ $relative -> nat_id }}"/>
							</div>
							
							<div class="custom-control custom-checkbox">
							    <label for="">الجنس</label>


							    

							    <div class="custom-control custom-radio">
								<input type="radio" id="" name="gender"
								       {{ $relative->gender == "male"? "checked": "" }}
								       class="custom-control-input">
								<label class="custom-control-label" for="">ذكر</label>
							    </div>
							    
							    <div class="custom-control custom-radio">
								<input type="radio" id="" name="gender"
								       {{ $relative->gender == "female"? "checked": "" }}
								       class="custom-control-input">
								<label class="custom-control-label" for="">أنثى</label>
							    </div>
							    

							    <div>
								<label for="">العمر</label>
								<input name="age" type="text" value="{{ $relative -> age }}"/>
							    </div>

							    <div class="custom-file">
								<input type="file" class="custom-file-input" id="" name="pic">
								<label class="custom-file-label" for="">تغيير الصورة</label>
							    </div>
							    
							</div>

							
						    </form>
						</div>
						
						<div class="modal-footer">
						    <button type="button" class="btn btn-primary">Save changes</button>
						    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					    </div>
					</div>
				    </div> <!-- edit relative modal -->
				    

				    <!-- view relative modal -->
				    <div id="view-relative-modal" class="modal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
					    <div class="modal-content">
						<div class="modal-header">
						    <h5 class="modal-title">عرض القريب</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						    </button>
						</div>

						<div class="modal-body">
						    <table class="table">
							<tr>
							    <td>الاسم</td>
							    <td>{{ $relative->fullname }}</td>
							</tr>

							<tr>
							    <td> السن</td>
							    <td>{{ $relative->age }}</td>
							</tr>
							
							<tr>
							    <td>الجنس</td>
							    <td>{{ $relative->gender }}</td>
							</tr>

							<tr>
							    <td>الصورة</td>
							    <td><img class="img-thumbnail" src="{{ $relative-> pic }}" /></td>
							</tr>

							
						    </table>
						</div>
						
						<div class="modal-footer">
						    <button type="button" class="btn btn-primary">Save changes</button>
						    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					    </div> 
					</div>
				    </div><!-- view relative modal -->

				    

				    

				    

					<div class="card relative col-md-5"
					     
					>

					    <div class="avatar">
						<img class="img-thumbnail"
						     alt=""
						     src="{{ $relative->pic }}">
					    </div>

					    <div class="">
						<table class="table">
						    <tr>
							<td>  {{ $relative->fullname }} </td>
						    </tr>
						</table>
					    </div>

					    

					    <div class=" row justify-content-around relative-actions">

						<button class="view-relative btn btn-success">
						    عرض
						</button>

						<button class="edit-relative btn btn-warning">
						    تعديل
						</button>

						<button class="delete-relative btn btn-danger">
						    حذف
						</button>
						
					    </div>
					    

					    
					    
					</div>
					
					
					
					
				@endforeach

				    </div> <!-- card -->

			    @endif
			    
			</div> <!-- relatives -->
			
			
			
		    </div> <!-- info<!--  --> 


		</div>
		
	    </div>
	    
	</div>



	<!-- loop indpendent modals -->

	<!-- add relatvie modal -->
	<div id="add-relative-modal" class="modal" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
			<h5 class="modal-title">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
		    </div>

		    <div class="modal-body">
			<form id="add-relative-form" class="add-relative-form" method="post" action="/add-relative">
			    @csrf
			    
			    
			    <div class="input-wrapper">
				<input type="text" name="fullname" class="form-control" id=""  placeholder="الاسم الكامل" />
			    </div>

			    <div class="input-wrapper">
				<input type="text" name="nat_id" class="form-control" id=""  placeholder="الرقم القومي" />
			    </div>

			    
			    <div class="input-wrapper">
				<select name="gender" class="custom-select">
				    <option value="male" selected>ذكر</option>
				    <option value="female">أنثى</option>
				</select>
			    </div>
			    
			    <div class="input-wrapper">
				<select name="kinship" class="custom-select">
				    @foreach($kinships as $kinship)

					<option value="{{$kinship->id }}">
					    {{ $kinship->type == "son"? "ابن" : "" }}
					    {{ $kinship->type == "daughter"? "ابنة" : "" }}
					</option>

				    @endforeach
				</select>
			    </div>

			    <div class="input-wrapper">
				<div class="custom-file">
				    <input type="file" class="custom-file-input" id="" name="pic">
				    <label class="custom-file-label" for="">أضف صورة</label>
				</div>
			    </div>

			    
			    
			</form>
		    </div>

		    <div class="modal-footer">
			<button type="submit" form="add-relative-form"  class="btn btn-success">إضافة</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء</button>
		    </div>
		</div>
	    </div>
	</div> <!-- add relatvie modal -->


	<!-- edit member modal -->
	<div id="edit-member-modal" class="modal" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
			<h5 class="modal-title">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
		    </div>

		    <div class="modal-errors"></div>
		    
		    <div class="modal-body">
			<form id="edit-member-form" class="edit-member-form" method="post" action="/edit-member/{{ $user->id }}">
			    @csrf

			    
			    <div class="input-wrapper">
				<input type="text" name="fullname" class="form-control" id=""  value="{{ $user->fullname }}" placeholder="الاسم الكامل" />
			    </div>

			    <div class="input-wrapper">
				<input type="text" name="phone" class="form-control" id=""  value="{{ $user->phone }}" placeholder="رقم الهاتف" />
			    </div>

			    <div class="input-wrapper">
				<div class="custom-file">
				    <input type="file" class="custom-file-input" id="" name="pic">
				    <label class="custom-file-label" for="">تغيير الصورة</label>
				</div>
			    </div>
			    
			    
			    <div class="input-wrapper">
				<select name="gender" class="custom-select">
				    <option value="male" {{ $user->gender=="male"? "selected" : "" }}>ذكر</option>
				    <option value="female"  {{ $user->gender=="female"? "selected" : "" }} >أنثى</option>
				</select>
			    </div>
			    
			    
			    
			    
			</form>
		    </div>

		    <div class="modal-footer">
			<button type="submit" form="edit-member-form" type="button" class="btn btn-success">إضافة</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء</button>
		    </div>
		</div>
	    </div>
	</div> <!-- edit member modal -->

	
	
	


	
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" ></script>
	<script src="{{ asset("/scripts/bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js") }}"></script>
	
	<script>

	 $(".edit-relative").on("click", function() {
	     $("#edit-relative-modal").modal("toggle");
	 });
	 
	 $(".view-relative").on("click", function() {
	     $("#view-relative-modal").modal("toggle");
	 });

	 
	 $("#add-relative").on("click", function() {
	     $("#add-relative-modal").modal("toggle");
	 });

	 $("#edit-member").on("click", function() {
	     $("#edit-member-modal").modal("toggle");
	 });
	 
	</script>
	


	{{-- handle if validation errors occured in edit member modal --}}
	@if(session()->has("edit-member-errors"))
	    <script>
		$("#edit-member-modal").modal("toggle");
		var error_element= "<div class='alert alert-danger' >";
		error_element += "<ul>";

		@foreach(session()->get("edit-member-errors") as $error)
		    error_element += "<li> " + "{{ $error }}" + "</li>";
		@endforeach

		error_element += "</ul>";
	     	error_element += "</div>";
		
	     $("#edit-member-modal div.modal-errors").append(error_element);
	    </script>
	@endif


	@if(session()->has("add-relative-success"))
	    $.notify({
	    message: 'dkjsdjsalkjlk' 
	    },{
	    type: 'success'
	    });
	@endif

	
    </body>

</html>
