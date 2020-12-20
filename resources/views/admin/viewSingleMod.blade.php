@extends("admin/layout")


@section("title")
    <title>{{ $mod->fullname }} -  {{ config("app.name") }} </title>
@endsection



@section("content")

    <div class="card">

	<a class="btn btn-warning" href="/admin/mods/edit/{{$mod->id }}">
	    تعديل
	</a>
	
	<div class="card-header">
	    عرض مشرف
	</div>

	<table class="table">
	    <tr>
		<td>الاسم الكامل</td>
		<td> {{ $mod->fullname }}</td>
	    </tr>

	    <tr>
		<td>الرقم القومي</td>
		<td>{{ $mod->nat_id }}</td>
	    </tr>

	    <tr>
		<td>الصورة الشخصية</td>
		<td><img alt="" src="/uploads/{{ $mod->pic }}"/></td>
	    </tr>

	    
	</table>
	
	
	
    </div>
    
@endsection

