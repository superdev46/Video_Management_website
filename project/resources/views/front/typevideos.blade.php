@extends('layouts.front')
@section('contents')
<div style="height: 30px;"></div>

<div class="container">
          <div class="row">
              <div class="col-lg-12">
                      <h2>{{$cat->cat_name}}</h2>
              </div>
          </div>
          <hr style="margin-top: 0px; margin-bottom: 20px;">
         @foreach($videos->chunk(4) as $videoChunk)

          <div class="row video-wrapper">
            @foreach($videoChunk as $video)
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
                  <p>{{$video->views}} views <span>•</span>{{$video->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>

            @endforeach

          </div>
        @endforeach
     
      </div>
                    <div class="text-center">
                    {!! $videos->links() !!}                 
                    </div>
<div style="height: 20px;"></div>


@endsection