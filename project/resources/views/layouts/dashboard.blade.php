<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$gs->title}}</title>

        <link href="{{asset('assets/dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/dashboard/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/dashboard/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/dashboard/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/dashboard/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{asset('assets/files/images/'.$gs->favicon)}}"> 
        <style type="text/css">
            #sidebar-menu ul li a.active {
            color: #fff;
            background: rgba(4, 171, 242, 0.40);
}
        </style>
        @yield('styles')
        
    </head>
    <body>
        <div class="dashboard-wrapper">
            <div class="left-side">
            <!-- Starting of Dashboard Sidebar menu area -->
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-right">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </nav>
                
                <div class="dashboard-sidebar-area">
                    <img src="{{asset('assets/dashboard/img/images.jpg')}}" alt="">
                    <div class="sidebar-menu-body">
                        <nav id="sidebar-menu">
                            <div class="sidebar-header">
                                <img src="{{asset('assets/files/images/'.$gs->logo)}}" alt="Sidebar header logo" class="sidebar-header-logo">
                            </div>
                            <ul class="list-unstyled profile">
                                <li class="active">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <img src="{{Auth::guard('user')->user()->photo ? asset('assets/files/images/'.Auth::guard('user')->user()->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="profile image">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">    
                                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">{{Auth::guard('user')->user()->name}} <span>{{Auth::guard('user')->user()->role}}</span></a>
                                        </div>
                                    </div>
                                        <ul class="collapse list-unstyled profile-submenu" id="homeSubmenu">    
                                            <li><a href="{{route('user-profile')}}"><i class="fa fa-fw fa-user"></i> {{$lang->edit}}</a></li>
                                            <li><a href="{{route('user-password')}}"><i class="fa fa-fw fa-cog"></i> {{$lang->reset}}</a></li>
                                            <li><a href="{{route('user-logout')}}"><i class="fa fa-fw fa-power-off"></i> {{$lang->logout}}</a></li>
                                        </ul>
                                </li>
                            </ul>
                            <ul class="list-unstyled components">
                                <li>
                                    <a href="{{ route('front.index')}}" target="_blank"><i class="fa fa-home fa-fw"></i> {{$lang->vt}}</a>
                                </li>
                                <li>
                                    <a href="{{ route('user-dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> {{$lang->dashboard}}</a>
                                </li>
                                <li>
                                    <a href="{{ route('user-video-create') }}"><i class="fa fa-upload fa-fw"></i> {{$lang->gt}}</a>
                                </li>
                                <li>
                                    <a href="{{ route('user-fetch-create') }}"><i class="fa fa-cloud-download fa-fw"></i> {{$lang->vdn}}</a>
                                </li>
                                <li><a href="#manage" data-toggle="collapse" aria-expanded="false"><i class="fa fa-video-camera fa-fw"></i> {{$lang->bgs}}</a></li>
                                    <ul class="collapse list-unstyled submenu" id="manage">
                                        <li><a href="{{ route('user-video-index') }}"><i class="fa fa-angle-right"></i> {{$lang->bg}}</a></li>
                                        <li><a href="{{ route('user-fetch-index') }}"><i class="fa fa-angle-right"></i> {{$lang->lm}}</a></li>
                                    </ul>
                                <li>
                                    <a href="{{ route('user-channel-index') }}"><i class="fa fa-user fa-fw"></i> {{$lang->rds}}</a>
                                </li>
                                <li><a href="{{ route('user-playlist-index') }}"><i class="fa fa-play fa-fw"></i> {{$lang->hcs}}</a></li>
                                <li>
                                    <a href="{{ route('user-subscription') }}"><i class="fa fa-youtube-play fa-fw"></i>  {{$lang->lns}}</a>
                                </li>
                                <li><a href="{{ route('user-likedvideos') }}"><i class="fa fa-thumbs-up fa-fw"></i> {{$lang->vd}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            <!-- Ending of Dashboard Sidebar menu area --> 
            </div>

            @yield('contents')
</div>
        <script src="{{asset('assets/dashboard/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/jquery.canvasjs.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/main.js')}}"></script>
        <script src="{{asset('assets/admin/js/admin-main.js')}}"></script>
        <script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
        @yield('scripts')
    </body>
</html>
