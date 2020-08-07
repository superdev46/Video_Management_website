@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Channel area -->
                        <div class="profile-wrap">
                            <div class="cover-wrap">
                                <img src="{{asset('assets/dashboard/img/d-cover.jpg')}}" alt="">
                                <div class="pro-avatar-wrap">
                                    <img src="{{asset('assets/dashboard/img/d-avatar.jpg')}}" alt="">
                                    <span>Name</span>
                                </div>

                            </div>
                        </div>
                        <div class="profile-links-wrap">
                            <ul>
                                <li><a href="{{route('user-channel')}}">Videos</a></li>
                                <li><a href="{{route('user-channelplaylist')}}">PlayLists</a></li>
                                <li class="active"><a href="{{route('user-channelliked')}}">Liked Videos</a></li>
                                <li><a href="{{route('user-channelabout')}}">About</a></li>
                            </ul>
                        </div>
                        <div class="profile-content-wrap text-center">
                            No videos found for now!
                        </div>
                        <!-- Ending of Channel area -->
                        </div>
                    </div>
                </div>
            </div>
@endsection