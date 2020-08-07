@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Video history area -->
                        
                        <div class="manage-videos-wrap">
                            <h2>History</h2>
                            <hr>
                            <div class="manage-videos-content">
                                <div class="single-video-wrap">
                                    <div class="video-title">
                                        <div class="pull-left">
                                            <img src="{{asset('assets/dashboard/img/wQZDYhNbRuHnCIX72ycb_27_33a204cf5894dfa8b3f4388dffb03607_image.jpg')}}" alt="">
                                            <strong><a href="">muny</a></strong>
                                        </div>
                                        <div class="pull-right">
                                            <a href="" class="delete-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="video-content">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <a href=""><img src="{{asset('assets/dashboard/img/mqdefault.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="col-md-8 col-sm-6">
                                                <div class="video-content-text">
                                                    <h4><a href="">SŁAWOMIR - Ty mała znów zarosłaś (Official Video Clip NOWOŚĆ 2018)</a></h4>
                                                    <strong><a href="">muny</a></strong>
                                                    <p class="meta-date">71 Views . 5 days ago</p>
                                                    <p><span>Cześć tu Sławomir. Z okazji moich urodzin dla WAS…</span></p>
                                                    <p><span>Sklep Sławomira </span> <a href=""> http://czucpiniadz.pl </a></p>
                                                    <p><span>Szaty Sławomira</span> <a href="">https://slawomir.teetres.com </a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Ending of Video history area -->
                        </div>
                    </div>
                </div>
            </div>
@endsection