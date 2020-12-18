@extends("admin/layout")


@section("title")
    <title>الأعضاء -  {{ config("app.name") }} </title>
@endsection

@section("content")


    <div class="card">
	<table class="table">
	    <thead>
		<th>الاسم الكامل</th>
		<th>الجنس</th>
		<th>رقم الهاتف</th>
		<th>خيارات</th>

	    </thead>
	    
	    <tbody>
		@foreach($members as $member)
		    <tr>
			<td> {{ $member->fullname }}</td>
			<td> {{ $member->gender }}</td>
			<td> {{ $member->phone }}</td>
			<td>
			    <a href="/admin/members/{{ $member->id }}">
				<button class="btn btn-primary">عرض</button>
			    </a>
			    <a href="/admin/members/edit/{{ $member->id }}">
				<button class="btn btn-warning">تعديل</button>
			    </a>
			    <button class="btn btn-danger">حذف</button>
			</td>
		    </tr>
		@endforeach
	    </tbody>
	</table>

    </div>


    


    @push("scripts")
    
    @endpush
    
@endsection
