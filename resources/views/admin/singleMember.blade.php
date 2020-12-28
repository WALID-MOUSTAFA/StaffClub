@extends("admin/layout")


@push("style")
<style>
.card {
    padding: 40px;
 }

</style>
@endpush

@section("content")


    <div class="card">
	<table class="table">
	    
	    <tbody>
		
		<tr>
		    <td>الاسم الكامل</td>
		    <td>{{ $member->fullname }}</td>
		</tr>

		<tr>
		    <td>الرقم القومي</td>
		    <td>{{ $member->nat_id }}</td>
		</tr>

		
		<tr>
		    <td>رقم الهاتف</td>
		    <td>{{ $member->phone }}</td>
		</tr>

		<tr>
		    <td>الكلية</td>
		    <td>{{ $member->faculty->name }}</td>
		</tr>

		<tr>
		    <td>الصورة الشخصية</td>
		    <td><img src="/uploads/{{ $member->pic }}"/></td>
		</tr>

		
		<tr>
		    <td>الأقارب</td>
		    <td>
			<ul>
			    @foreach($member->relatives()->get() as $relative)
				<div class="relative">
				    <li>
					    {{ $relative->fullname }}
					<button  class="btn btn-primary view-relative">عرض
					    <i class="fa fa-external-link-alt"></i>
					</button>
					<!-- <button class="btn btn-warning edit-relative">تعديل</button> -->


				    </li>


				<!-- view relative modal -->
				<div class="view-relative-modal modal" tabindex="-1" role="dialog">
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
							<td>الرقم القومي</td>
							<td>{{ $relative->nat_id }}</td>
						    </tr>

						    
						    <tr>
							<td> السن</td>
							<td>{{ $relative->age }}</td>
						    </tr>

						    <tr>
							<td>القرابة</td>
							<td>{{ $relative->kinship->type }}</td>
						    </tr>

						    

						    <tr>
							<td>الصورة</td>
							<td><img class="img-thumbnail" src="/uploads/{{ $relative-> pic }}" /></td>
						    </tr>

عرض						    
						</table>
					    </div>
					    
					    <div class="modal-footer">
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
						<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
					    </div>
					</div> 
				    </div>
				</div><!-- view relative moda -->



				
				<!-- edit relative modal -->
				<div class="edit-relative-modal modal" tabindex="-1" role="dialog">
				    <div class="modal-dialog" role="document">
					<div class="modal-content">
					    <div class="modal-header">
						<h5 class="modal-title">تعديل الأقارب</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>

					    <div class="modal-body">
						<form method="post" id="edit-relative-form"
						      action="/edit-relative/{{ $relative->id }}"
						      enctype="multipart/form-data">
						    @csrf
						    <div class="input-wrapper">
							<label for="">الاسم</label>
							<input class="form-control" name="fullname" type="text" value="{{ $relative -> fullname }}"/>
						    </div>
						    <div class="input-wrapper">
							<label for="">الرقم القومي</label>
							<input class="form-control" name="nat_id" type="text" value="{{ $relative -> nat_id }}"/>
						    </div>

						    
						    
						    <div class="input-wrapper">
							<label for="">السن</label>
							<input class="form-control" name="age" type="text" value="{{ $relative -> age }}"/>
						    </div>

						    <div class="input-wrapper">
							<label for="">صلة القرابة</label>
							<select name="kinship" class="form-control custom-select">
							    
							    
							    @foreach($kinships as $kinship)

								<option value="{{$kinship->id }}"
									{{ $relative->kinship->type ==  $kinship->type?  "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									{{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
								>  
								    {{ $kinship->type == "son"? "ابن" : "" }}
								    {{ $kinship->type == "daughter"? "ابنة" : "" }}
								    {{ $kinship->type == "father"? "اب" : "" }}
								    {{ $kinship->type == "mother"? "أم" : "" }}
								    {{ $kinship->type == "sister"? "أخت" : "" }}
								    {{ $kinship->type == "brother"? "أخ" : "" }}
								    {{ $kinship->type == "husband"? "زوج" : "" }}
								    {{ $kinship->type == "wife"? "زوجة" : "" }}

								</option>
								
							    @endforeach
							</select>
						    </div>

						    
						    
						    <div class="custom-file">
							<input type="file" class="custom-file-input" id="" name="pic">
							<label class="custom-file-label" for="">تغيير الصورة</label>
						    </div>
						    
						    
						    
					    </div>
					    
					    <div class="modal-footer">
						<button type="submit" class="btn btn-warning submit-edit-relative-form">تعديل</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
					    </div>

						</form>

					</div>
				    </div>
				</div> <!-- edit relative modal -->
				</div>
				
			    @endforeach
			</ul>
			
		    </td>
		</tr>
		
		
		
	    </tbody>
	</table>

    </div>


				    
    
    @push("scripts")
    <script>
     $(".view-relative").on("click", function() {
	 /* $("#view-relative-modal").modal("toggle"); */
	 $(this).closest(".relative").children(".view-relative-modal").modal("toggle");

	 
     });

     $(".edit-relative").on("click", function() {
	 $(this).closest(".relative").children(".edit-relative-modal").modal("toggle");
     });

     
     /* $("#edit-relative").on("click", function() {
	$("#edit-relative-modal").modal("toggle");
      * });
      */
    </script>
    @endpush
    
@endsection
