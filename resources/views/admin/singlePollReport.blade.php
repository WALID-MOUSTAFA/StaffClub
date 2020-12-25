@extends("admin/layout")

@section("title")
    <title>نتيجة الاستبيان-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <p class="h2 text-center">نتيجة استبيان: {{ $poll->title }}</p>

	    <table class="table table-bordered">
		<tbody>
		    <tr>
			<td>عدد الأسئلة</td>
			<td>{{ $qcount }}</td>
		    </tr>

		    <tr>
			<td>عدد المجيبين</td>
			<td>{{ $num_of_voters }}</td>
		    </tr>

		    @foreach($poll->questions()->get() as $question)
			<tr>
			    <td>{{ $question->question_body }}</td>
			    <td>
				<table class="table table-borderless">
				    <tbody>
					@foreach($question->options()->get() as $option)
					    <tr>

						<td>
						    {{ $option->option_body }}
						</td>
						<td>
						    @if($num_of_voters != 0)
							({{ count($option->answers()->get()) / $num_of_voters*100  }}%)
						    @endif
						</td>
						<td>
						    عدد المصوتين: 
						    {{ count($option->answers()->get()) }}
						</td>
					    </tr>
					@endforeach
				    </tbody>
				</table>
				
			    </td>
			</tr>
		    @endforeach
		    
		</tbody>
	    </table>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
