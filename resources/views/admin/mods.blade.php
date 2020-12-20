@extends("admin/layout")


@section("title")
    <title>المشرفين -  {{ config("app.name") }} </title>
@endsection


@section("content")

    @if(session()->has("success"))
	<div class="alet alert-success">
	    session()->get("success");
	</div>
    @endif
    
    <div class="card">

	
	<a href="/admin/mods/add-mod/" class="btn btn-primary">
	    إضافة مشرف
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
			<td>{{$mod->fullname }}</td>
			<td>{{$mod->nat_id }}</td>

			<td>
			    <a class="btn btn-primary" href="/admin/mods/{{ $mod->id }}">عرض</a>
			    <a class="btn btn-warning" href="/admin/mods/edit/{{ $mod->id }}">تعديل</a>
			    <form method="post" class="inline-form" action="/admin/mods/delete/{{ $mod->id }}">
				@csrf
				<button class="btn btn-danger">
				    حذف
				</button>
			    </form>
			</td>
			
		    </tr>
		@endforeach
		
	    </tbody>
	    
	</table>
	
    </div>
    
@endsection

