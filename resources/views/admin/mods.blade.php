@extends("admin/layout")


@section("title")
    <title>المشرفين -  {{ config("app.name") }} </title>
@endsection


@section("content")

    
    <div class="card">
	<!-- <div class="mb-4 text-center card-header bg-primary">
	     <p class="h3">
	     تعديل بيانات العضو
	     </p>
	     </div>
	-->

	<div class="card-body">

	    @if(session()->has("success"))
		<div class="alert alert-success alert-dismissible ">
		    {{ session()->get("success") }}
		</div>
	    @endif

	    
	    @if(session()->has("error"))
		<div class="alert alert-danger alert-dismissible ">
		    {{ session()->get("error") }}
		</div>
	    @endif

	    <a href="/admin/mods/add-mod/" class="btn btn-primary float-left">
	    إضافة مشرف
	    <i class="fa fa-plus"></i>
	</a>

	<table class="table">
	    
	    <thead>
		<tr>
		    <th>الاسم الكامل</th>
		    <th>الرقم القومي</th>
		    <th>خيارات</th>
		</tr>
	    </thead>

	    <tbody>
		@foreach($mods as $mod)
		    <tr>
			<td> <a href="/admin/mods/{{ $mod->id}}">{{$mod->fullname }}</a></td>
			<td>{{$mod->nat_id }}</td>

			<td>
			    <a class="btn btn-warning" href="/admin/mods/edit/{{ $mod->id }}">
				تعديل
				<i class="fa fa-edit"></i>
			    </a>
			    <form method="post" class="d-inline" action="/admin/mods/delete/{{ $mod->id }}">
				@csrf
				<button class="submit-delete btn btn-danger">
				    حذف
				    <i class="fa fa-trash"></i>
				</button>
			    </form>
			</td>
			
		    </tr>
		@endforeach
		
	    </tbody>
	    
	</table>
	</div>
    </div>
    
@endsection

