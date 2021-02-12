@extends("admin/layout")

@section("title")
    <title>الأخبار-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">
	
	<div class="card">

	    
	    <div class="mb-4 text-center card-header bg-primary">
		<p class="h3">الأخبار</p>
	    </div>

	    
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

		<a href="/admin/news/create" class="">
		    <button class="btn btn-primary float-left my-3">إضافة خبر
			<i class="fa fa-plus"></i>
		    </button>
		</a>

	    </div>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
