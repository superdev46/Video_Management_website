@extends('layouts.front')
@section('contents')
<div style="height: 30px;"></div>

<div class="container">
          <div class="row">
              <div class="col-lg-12">
                      <h2>{{$lang->home2}}</h2>
              </div>
          </div>
          <hr style="margin-top: 0px; margin-bottom: 20px;">
         @foreach($playlists->chunk(4) as $playChunk)

          <div class="row video-wrapper">
            @foreach($playChunk as $playlist)
            <div class="col-md-3 col-sm-3">
              <a href="{{route('front.playlist',$playlist->id)}}" class="single-video-wrap">
                <div class="video-background">
                   <img src="{{asset('assets/files/images/'.$playlist->photo)}}" style="height: 200px;">                   
                </div>
                <div class="video-content">
                  <h4>{{$playlist->title}}</h4>
                  <p>{{$playlist->user->name}}</p>
                  <p>{{count($playlist->videos)}} videos <span>•</span>{{$playlist->created_at->diffForHumans()}}</p>
                </div>
              </a>
            </div>

            @endforeach

          </div>
        @endforeach
     
      </div>
                    <div class="text-center">
                    {!! $playlists->links() !!}                 
                    </div>
<div style="height: 20px;"></div>


@endsection