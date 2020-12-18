@extends("admin/layout")

@section("title")
    <title> {{$poll->title }}-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card ">
	    <div class="card-header">
		<p class="h1 text-center">{{ $poll-> title }}
		</p>
	    </div>

	    <a href="/admin/polls/{{ $poll->id }}/add-question">
		<button class="btn btn-primary">إضافة سؤال جديد</button>
	    </a>

	    <table class="table">
		<thead>
		    <tr>
			<th>السؤال</th>
			<th>الخيارات</th>
			<th></th>

		    </tr>
		</thead>
		<tbody>

		    @foreach($poll->questions()->get() as $question)
			<tr class="question">
			    			    
			    
			    <td> {{$question->question_body }}</td>
			    <td class="options">
				<ul class="options-list">
				    @foreach($question->options()->get() as $option)
					<li>{{ $option -> option_body }}</li>
				    @endforeach
				</ul>
			    </td>
			    <td>
				<a href="/admin/questions/edit/{{ $question->id }}">
				    <button class="btn btn-warning edit-question">
					تعديل
				    </button>
				    
				</a>
				<form method="post" class="inline-form" action="/admin/questions/delete/{{$question->id }}">
				    @csrf
				    <button class="btn btn-danger delete-question">حذف</button>
				</form>
			    </td>
			</tr>
		    @endforeach
		</tbody>
	    </table>
	    
	</div>

    </div>

@endsection


@push("scripts")


<script>

</script>
@endpush
