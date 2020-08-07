@extends('layouts.front')
@section('contents')
<div style="height: 30px;"></div>

<div class="container">
          <div class="row">
              <div class="col-lg-12">
                      <h2>{{$playlist->title}}</h2>
              </div>
          </div>
          <hr style="margin-top: 0px; margin-bottom: 20px;">
            @php
            $i=0;
            @endphp
          <div class="row video-wrapper">
            @foreach($playlist->videos as $vid)
            @if($vid->video->is_top == 0 && $vid->video->is_slider == 0)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.playlist.video',['id1' => $vid->playlist_id,'id2' => $vid->video_id])}}" class="single-video-wrap">
                <div class="video-background">
                    @if($vid->video->type == 0)
                   <img src="{{asset('assets/files/images/'.$vid->video->thumbnail)}}" style="height: 200px;" >
                   @else
                   <img src="{{$vid->video->thumbnail}}" style="height: 200px;">                   
                   @endif                   
                </div>
                <div class="video-content">
                  <h4>{{$vid->video->title}}</h4>
                  <p>{{$vid->playlist->user->name}}</p>
                  <p>{{$vid->video->views}} views <span>•</span>{{$vid->video->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>
            @else
            @php
            $i--;
            @endphp
            @endif
            @php
            $i++;
            @endphp
            @if($i % 4 == 0)    
            {!!  "</div><div class='row video-wrapper'>"!!} 
            @endif
            @endforeach

          </div>

     
      </div>
<div style="height: 20px;"></div>


@endsection