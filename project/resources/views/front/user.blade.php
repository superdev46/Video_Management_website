@extends('layouts.front')

@section('contents')

<div style="height: 30px;"></div>
<div class="container user-information">
	<div class="row user-basic-info">
		<div class="col-sm-12">
			<div class="user-photo">
				<img width="100%" src="{{$user->photo != null ? asset('assets/files/images/'.$user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Logo" class="img-responsive">
			</div>
			<div class="user-info">
				<div class="basic-info">
					<h3>{{$user->name}}</h3>
					<p>
						<span>{{$subscribers}}</span>
						<span>Subscribers</span>
					</p>
				</div>

				<div class="info-buttons">
					@if($myscribe == 1)
	                <a class="btn btn-primary" id="user_subscribe" role="{{$user->id}}">Subscribed</a>
	                @else
	                <a class="btn btn-danger" id="user_subscribe" role="{{$user->id}}">Subscribe</a>              
	                @endif
				</div>

			</div>
		</div>
	</div>

	<div style="height: 6px;"></div>
	<div class="row user-video-info">
		<ul class="nav nav-tabs nav-tabs-list" style="left: 0px;">
            <li class="active"><a data-toggle="tab" href="#channel-videos" aria-expanded="false">Videos</a></li>
            <li class=""><a data-toggle="tab" href="#channel-about" aria-expanded="true">About</a></li>     
        </ul>

        <div class="tab-content">
			<div class="tab-pane active" id="channel-videos">
				@foreach($uservideos->orderBy('created_at','desc')->get() as $video)
				<div class="row">
			        <div class="col-md-4 col-sm-12">
			            <div class="video-background">
			            	<a href="{{route('front.video',$video->id)}}">
			            		@if($video->type == 0)
				               	<img src="{{asset('assets/files/images/'.$video->thumbnail)}}" style="height: 200px;" >
				               	@else
				               	<img src="{{$video->thumbnail}}" style="height: 200px;">                   
				               	@endif
			            	</a>
			            </div>
			        </div>
			        <div class="col-md-8 col-sm-12">
			            <div class="video-content">
			            	<h5 style="float: right;">{{ $video->created_at->diffForHumans() }}</h5>
			              	<h4>{{ $video->title }}</h4>
			              	<p>{!! html_cut($video->text, 200) !!}</p>
			            </div>
			        </div>
				</div>
				@endforeach
			</div>

			<div class="tab-pane" id="channel-about">

				<div class="row">
					<div class="col-md-3">
						<div class="user-photo">
							<img width="100%" src="{{$user->photo != null ? asset('assets/files/images/'.$user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Logo" class="img-responsive">
						</div>
						
						<h5 style="margin-top: 10px"> 
							<span>Created </span>
							<span>{{ $user->created_at->diffForHumans() }}</span>
						</h5>

						<h5>
							<i class="fa fa-eye"></i>
							<span>{{$subscribers}}</span>
							<span>Subscribers</span>	
						</h5>
						<h5>
							<i class="fa fa-video-camera"></i>
							<span>{{ $uservideos->count() }}</span>
							<span>Videos</span>	
						</h5>
					</div>

					<div class="col-md-9">
						<div>
							{!! $user->description !!}
						</div>
					</div>

				</div>
			
			</div>
		</div>

	</div>

	

	
</div>
<div style="height: 30px;"></div>


<script type="text/javascript">

//***************************** LIKE & DISLIKE******************************

var user_subscribe_url = "{{URL::to('usersubscribe')}}";

//***************************** SUBSCRIBE AND UNSUBSCRIBE ENDS******************************
</script>

@endsection