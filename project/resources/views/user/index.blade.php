@extends('layouts.dashboard')
@section('contents')
            <div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard header items area -->
                        <div class="panel panel-default admin">
                          <div class="panel-heading admin-title">{{$lang->dni}}</div>
                              <div class="panel-body dashboard-body">
                                  <div class="dashboard-header-area">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{route('user-video-index')}}" class="title-stats title-blue">
                                                <div class="icon"><i class="fa fa-upload fa-5x"></i></div>
                                                <div class="number">{{count($uvideos)}}</div>
                                                <h4>{{$lang->bg}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{route('user-fetch-index')}}" class="title-stats title-green">
                                                <div class="icon"><i class="fa fa-cloud-download fa-5x"></i></div>
                                                <div class="number">{{count($fvideos)}}</div>
                                                <h4>{{$lang->lm}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{route('user-playlist-index')}}" class="title-stats title-gray">
                                                <div class="icon"><i class="fa fa-play fa-5x"></i></div>
                                                <div class="number">{{count($playlists)}}</div>
                                                <h4>{{$lang->hcs}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{route('user-channel-index')}}" class="title-stats title-skyblue">
                                                <div class="icon"><i class="fa fa-user fa-5x"></i></div>
                                                <div class="number">{{count($channels)}}</div>
                                                <h4>{{count($channels) > 1 ? "Channels!":"Channel!"}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{route('user-likedvideos')}}" class="title-stats title-red">
                                                <div class="icon"><i class="fa fa-thumbs-up fa-5x"></i></div>
                                                <div class="number">{{count($likes)}}</div>
                                                <h4>{{$lang->vd}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <a href="{{ route('user-subscription') }}" class="title-stats title-green">
                                                <div class="icon"><i class="fa fa-youtube-play fa-5x"></i></div>
                                                <div class="number">{{count($subscribes)}}</div>
                                                <h4>{{$lang->lns}}</h4>
                                                <span class="title-view-btn">{{$lang->search}}</span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                     

                </div>
            </div>
        </div>
    </div>
@endsection