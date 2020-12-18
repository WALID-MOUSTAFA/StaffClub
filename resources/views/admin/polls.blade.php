@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <a href="/admin/polls/add">
		<button class="btn btn-primary">إضافة استبيان</button>
	    </a>
	    <table class="table">

		<thead>
		    <th>العنوان</th>
		    <th>الوصف</th>
		    <th>خيارات</th>
		</thead>

		@foreach($polls as $poll)
		    <tr>
			<td>{{ $poll->title }}</td>
			<td>{{ $poll->desc }}</td>
			<td>
			    <div>
				<a href="/admin/polls/{{ $poll->id }}"><button class="btn btn-primary">عرض الاسئلة</button></a>
				<a href="/admin/polls/edit/{{ $poll->id }}"><button class="btn btn-warning">تعديل</button></a>
				<form method="post" class="delete-poll-form inline-form" action="/admin/polls/delete/{{ $poll->id }}">
				    @csrf
				    <button class="btn btn-danger">
					حذف
				    </button>
				</form>
			    </div>
			</td>
		    </tr>
		@endforeach
		
	    </table>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
