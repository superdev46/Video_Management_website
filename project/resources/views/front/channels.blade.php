@extends('layouts.front')
@section('contents')
<div style="height: 30px;"></div>

<div class="container">
          <div class="row">
              <div class="col-lg-12">
                      <h2>{{$lang->fht}}</h2>
              </div>
          </div>
          <hr style="margin-top: 0px; margin-bottom: 20px;">
         @foreach($channels->chunk(4) as $channelChunk)

          <div class="row video-wrapper">
            @foreach($channelChunk as $channel)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.channel',$channel->id)}}" class="single-video-wrap">
                <div class="video-background">
                   <img src="{{asset('assets/files/images/'.$channel->photo)}}" style="height: 200px;">                   
                </div>
                <div class="video-content">
                  <h4>{{$channel->title}}</h4>
                  <p>{{$channel->user->name}}</p>
                  <p>{{count($channel->contents()->where('type','=',1)->get())}} playlists<span>•</span>{{count($channel->contents()->where('type','=',2)->get())}} videos<span>•</span>{{$channel->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>

            @endforeach

          </div>
        @endforeach
     
      </div>
                    <div class="text-center">
                    {!! $channels->links() !!}                 
                    </div>
<div style="height: 20px;"></div>


@endsection