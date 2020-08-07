@extends('layouts.front')
@section('contents')

<div style="height: 20px;"></div>

<div class="container">
  <div class="row breaking-news-row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="featured-carousel-area breaking-news">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                @php
                $x = 1;
                @endphp
                @foreach($topvids as $vi)
                <li data-target="#myCarousel" data-slide-to="{{$x++}}" class=""></li>
                @endforeach
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">

                <div class="item active">
                  @if($top->type == 0)
                  <img src="{{asset('assets/files/images/'.$top->thumbnail)}}" alt="Carousel image" style="width:855px; height: 480px;">
                  @else
                  <img src="{{$top->thumbnail}}" alt="Carousel image" style="width:855px; height: 480px;">
                  @endif
                  <div class="carousel-caption">
                    <a class="venobox" href="{{route('front.video',$top->id)}}"><i class="fa fa-play"></i></a>
                    <h3>{{$top->title}}</h3>
                    <ul class="featured">
                        <li>
                          <i class="fa fa-clock-o"></i>
                          <i>{{$top->created_at->diffForHumans()}}</i>
                        </li>
                        <li>
                          <i class="fa fa-eye"></i>
                          <i>{{$top->views}}</i>
                        </li>
                    </ul>
                  </div>
                </div>
               @foreach($topvids as $vid)
                <div class="item">
                  @if($vid->type == 0)
                  <img src="{{asset('assets/files/images/'.$vid->thumbnail)}}" alt="Carousel image" style="width:855px; height: 480px;">
                  @else
                  <img src="{{$vid->thumbnail}}" alt="Carousel image" style="width:855px; height: 480px;">
                  @endif
                  <div class="carousel-caption">
                    <a class="venobox" href="{{route('front.video',$vid->id)}}"><i class="fa fa-play"></i></a>
                    <h3>{{$vid->title}}</h3>
                    <ul class="featured">
                        <li>
                          <i class="fa fa-clock-o"></i>
                          <i>{{$vid->created_at->diffForHumans()}}</i>
                        </li>
                        <li>
                          <i class="fa fa-eye"></i>
                          <i>{{$vid->views}}</i>
                        </li>
                    </ul>
                  </div>
                </div>
              @endforeach
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        @foreach($lastvids as $last)
          <div class="single-breakingNews-area">
            @if($last->type == 0)
              <img  src="{{asset('assets/files/images/'.$last->thumbnail)}}" alt="">
            @else
              <img src="{{$last->thumbnail}}" alt="">
            @endif
              <a class="venobox single-news" href="{{route('front.video',$last->id)}}"><i class="fa fa-play"></i></a>
              <div class="breakingNews-content">
                  <p>{{$last->title}}</p>
              </div>
          </div> 
        @endforeach
      </div>
  </div>
</div>

<div style="height: 30px;"></div>

@foreach($cats as $cat)
<div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="featured-header todays-featured">
                      <h4>{{$cat->cat_name}}</h4>
                        <a href="{{route('front.types',$cat->cat_slug)}}" class="btn btn-default news-loadmore-btn">
                          <i class="fa fa-refresh"></i> Explore More
                        </a>
                  </div>
              </div>
          </div>

          <div class="row video-wrapper">
 			@php
 			$i = 1;
 			@endphp
          	@foreach($cat->videos()->where('is_top','=',0)->where('is_slider','=',0)->orderBy('created_at','desc')->get() as $video)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.video',$video->id)}}" class="single-video-wrap">
                <div class="video-background">
                	@if($video->type == 0)
                   <img src="{{asset('assets/files/images/'.$video->thumbnail)}}" style="height: 200px;" >
                   @else
                   <img src="{{$video->thumbnail}}" style="height: 200px;">                   
                   @endif
                </div>
                <div class="video-content">
                  <h4>{{$video->title}}</h4>
                  <p>{{$video->user_id == null ? "Admin":$video->user->name}}</p>
                  <p>{{$video->views}} views<span>•</span>{{$video->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>
 			@php
 			if($i==4)
 			break;
 			$i++;  
 			@endphp 

            @endforeach

          </div>
   		  @php
   		  $i=1;
   		  @endphp       
      </div>
<div style="height: 20px;"></div>
@endforeach
@endsection