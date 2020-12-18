@extends("admin/layout")


@section("content")

    
    <div class="card">
	<form id="edit-member-form" class="edit-member-form" method="post" action="/admin/members/edit/{{ $member->id }}">
			    @csrf

			    
	    <div class="input-wrapper">
		<label for="">الاسم الكامل</label>
				<input type="text" name="fullname" class="form-control" id=""  value="{{ $member->fullname }}" placeholder="الاسم الكامل" />
			    </div>

			    <label for="">رقم الهاتف</label>
			    <div class="input-wrapper">
				<input type="text" name="phone" class="form-control" id=""  value="{{ $member->phone }}" placeholder="رقم الهاتف" />
			    </div>

			    <label for="">الصورة</label>

			    <div class="input-wrapper">
				<div class="custom-file">
				    <input type="file" class="custom-file-input" id="" name="pic">
				    <label class="custom-file-label" for="">تغيير الصورة</label>
				</div>
			    </div>
			    
			    <label for="">الجنس</label>
			    <div class="input-wrapper">
				<select name="gender" class="custom-select">
				    <option value="male" {{ $member->gender=="male"? "selected" : "" }}>ذكر</option>
				    <option value="female"  {{ $member->gender=="female"? "selected" : "" }} >أنثى</option>
				</select>
			    </div>

			    <button class="btn btn-warning float-left"> تعديل</button>
			    
			    
			    
	</form>
	
    </div>


				    
    
    @push("scripts")
    <script>
     $("#view-relative").on("click", function() {
	 $("#view-relative-modal").modal("toggle");

     });
    </script>
    @endpush
    
@endsection
