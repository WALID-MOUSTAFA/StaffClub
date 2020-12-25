@extends("admin/layout")


@section("title")
    <title>الأعضاء -  {{ config("app.name") }} </title>
@endsection

@section("content")


    <div class="card">
	

	<div class="card-body">
	    <a href="/admin/members/add" class="btn btn-primary clearfix float-left">إضافة عضو
		<i class="fa fa-plus"></i>

	    </a>

	    
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

	    
	    <table class="table">
		<thead>
		    <th>الاسم الكامل</th>
		    <th>الرقم القومي</th>
		    <th>رقم الهاتف</th>
		    <th>خيارات</th>

		</thead>
		
		<tbody>
		    @foreach($members as $member)
			<tr>
			    <td> <a href="/admin/members/{{$member->id}}"> {{ $member->fullname }} </a></td>
			    <td> {{ $member->nat_id }}</td>
			    <td> {{ $member->phone }}</td>
			    <td>
				<a href="/admin/members/edit/{{ $member->id }}">
				    <button class="btn btn-warning">
					تعديل
					<i class="fa fa-edit"></i>

				    </button>
				</a>
				<form class="d-inline" method="post" action="/admin/members/delete/{{$member->id }}">
				    @csrf
				    <button type="submit" class="submit-delete btn btn-danger">
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
	<div class="d-flex justify-content-center">
	    {!!  $members->links("vendor.pagination.bootstrap-4") !!}

	</div>
    </div>


    


    @push("scripts")
    
    @endpush
    
@endsection
