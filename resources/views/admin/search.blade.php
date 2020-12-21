@extends("admin/layout")


@section("title")
    <title>الأعضاء -  {{ config("app.name") }} </title>
@endsection

@section("content")


    <div class="card">

	<p class="h4 my-4">
	    نتائج البحث عن: 
	    {{ request()->q }}

	</p>
	
	@if($members == null || count($members) == 0)
	    <p class="h4">لا يوجد نتائج!</p>
	@else
	
	<table class="table">
	    <thead>
		<th>الاسم الكامل</th>
		<th>الرقم القومي</th>

		<th>الأقارب</th>
		<th>خيارات</th>

	    </thead>
	    
	    <tbody>
		@foreach($members as $member)
		    <tr>
			<td> {{ $member->fullname }}</td>
			<td> {{ $member->nat_id}}</td>
			<td><ul>
			    @foreach($member->relatives()->get() as $relative)
				<li>{{ $relative->fullname }}</li>
			    @endforeach
			</ul></td>
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
	@endif
	
    </div>


    


    @push("scripts")
    
    @endpush
    
@endsection
