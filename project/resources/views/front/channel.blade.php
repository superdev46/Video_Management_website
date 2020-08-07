@extends('layouts.front')
@section('contents')
<div style="height: 30px;"></div>

<div class="container">
          <div class="row">
              <div class="col-lg-12">
                      <h2>{{$channel->title}}</h2>
              </div>
          </div>
          <hr style="margin-top: 0px; margin-bottom: 20px;">
            @php
            $i=0;
            @endphp
          <div class="row video-wrapper">
            @foreach($channel->contents as $cid)
             @if($cid->type == 1)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.playlist',$cid->playlist->id)}}" class="single-video-wrap">
                <div class="video-background">
                <img src="{{asset('assets/files/images/'.$cid->playlist->photo)}}" style="height: 200px;" >
                </div>
                <div class="video-content">
                  <h4>{{$cid->playlist->title}}</h4>
                  <p>{{$cid->playlist->user->name}}</p>
                  <p>{{count($cid->playlist->videos)}} videos <span>•</span>{{$cid->playlist->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>
            @else
            @if($cid->video->is_top == 0  && $cid->video->is_slider == 0)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.video',$cid->video->id)}}" class="single-video-wrap">
                <div class="video-background">
                  @if($cid->video->type == 0)
                   <img src="{{asset('assets/files/images/'.$cid->video->thumbnail)}}" style="height: 200px;" >
                   @else
                   <img src="{{$cid->video->thumbnail}}" style="height: 200px;">                   
                   @endif 
                </div>
                <div class="video-content">
                  <h4>{{$cid->video->title}}</h4>
                  <p>{{$cid->video->user->name}}</p>
                <p>{{$cid->video->views}} views <span>•</span>{{$cid->video->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>
            @else
            @php
            $i--;
            @endphp            
            @endif
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