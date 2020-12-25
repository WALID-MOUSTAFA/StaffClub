@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">

	    
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


	    <div class="card-body">
		<a href="/admin/polls/add" class="">
		    <button class="btn btn-primary float-left my-3">إضافة استبيان
			<i class="fa fa-plus"></i>
		    </button>
		</a>

		<table class="table">

		<thead>
		    <th>العنوان</th>
		    <th>الوصف</th>
		    <th>مفعّل</th>
		    <th>خيارات</th>
		</thead>

		@foreach($polls as $poll)
		    <tr>
			<td><a href="/admin/polls/{{$poll->id}}">{{ $poll->title }}</a></td>
			<td>{{ $poll->desc }}</td>
			<td>
			    @if($poll->active == 1)
				<span class="text-success">مفعّل</span>
			    @else
				<span class="text-danger">غير مفعّل</span>
			    @endif
			</td>
			<td>
			    <div>
				<a href="/admin/polls/edit/{{ $poll->id }}"><button class="btn btn-warning">تعديل</button></a>
				
				
				<form method="post" class="delete-poll-form d-inline" action="/admin/polls/delete/{{ $poll->id }}">
				    @csrf
				    <button class="submit-delete btn btn-danger">
					حذف
				    </button>
				</form>

				@if(count(\App\Models\PollVoters::where("poll_id", "=", $poll->id)->get()) > 0)
				    <a href="/admin/polls/report/{{$poll->id}}" class="btn btn-primary">عرض النتائج</a>
				@endif
			    </div>
			</td>
		    </tr>
		@endforeach
		
	    </table>
	    </div>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
