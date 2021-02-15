@extends("home_layout")

@section("content")

    @if($news)
    <!-- start news -->
    <div class="news-wrapper">
	<div class="container">

	    <p class="py-4 h2 text-center ">
	    <span class="text-blue"> الأخبار </span>
	    <span class="text-red"> والفعاليات </span>
	</p>
	<div class="py-4 row">

	    @if(count($news) >= 2)
		<div class="col-sm-4 list"> 
		    <div class="">
			<ul class="list-group">
			    @foreach($news as $key=>$one_news)
				@if($key > 0)
			    <li class=" list-group-item ">
				<div class="row">
				    <div class="col-sm-4">
					<img style="height:100px" class="w-100 img-thumbnail" alt="" src="/uploads/{{$one_news->news_images->first()->image}}"/>
				    </div>
				    <div class="col-sm-8">
					<a class="" href="">{{$one_news->title }}</a>
				    </div>

				</div>
			    </li>
				@endif
			    @endforeach
			    <li class=" list-group-item">
				<button class="btn btn-block bg-blue">
				    المزيد
				</button>
			    </li>

			</ul>
		    </div>
	    @endif
	    
		</div>
		<div class="col-sm-8">
		    <div class="row">

			<div class="col-sm-12 featured">
			    <img class="w-50 home-latest-featured img-thumbnail" alt="" 
				 src="/uploads/{{$latest_one->news_images->first()->image }}"/>
			    <a class="h3 " href="">{{$latest_one->title }}</a>

			</div>


			<!-- <div class="col-sm-12 content  ">
			     <p class="h6 text-center">
			     {!! Str::limit($latest_one->content, 79, "...") !!}
			     <a href="">متابعة</a>
			     </p>
			     </div>
			-->
		    </div>
		</div>
	</div>
    </div>

    </div>
    <!-- end news -->
    @endif
    
    <!-- Start Statistics -->
        <div class="stats text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3 stat-box">
                        <i class="fa fa-user fa-fw fa-5x"></i>
                        <span class="number">2343</span>
                        <p>عدد اعضاء هيئة التدريس</p>
                    </div>
                    <div class="col-sm-6 col-lg-3 stat-box">
                        <i class="fa fa-user-plus fa-fw fa-5x"></i>
                        <span class="number">-</span>
                        <p>عدد الاعضاءالذين قاموا باضافة بيناتهم</p>
                    </div>
                    <div class="col-sm-6 col-lg-3 stat-box">
                        <i class="fa fa-users fa-fw fa-5x"></i>
                        <span class="number">-</span>
                        <p>عدد الاسر الذين قاموا باضافة بيناتهم</p>
                    </div>
                    <div class="col-sm-6 col-lg-3 stat-box">
                        <i class="fa fa-map fa-fw fa-5x"></i>
                        <span class="number">1000م</span>
                        <p>مساحة النادي</p>
                    </div>
                </div>
            </div>
        </div>


@endsection
