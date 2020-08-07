<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{$seo->meta_keys}}">
        <meta name="author" content="GeniusOcean">

        <title>{{$gs->title}}</title>

        <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{asset('assets/files/images/'.$gs->favicon)}}"> 
        <style type="text/css">
            #sidebar-menu ul li a.active {
            color: #fff;
            background: rgba(207, 55, 58, 0.70);
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
                    <img src="{{asset('assets/admin/img/images.jpg')}}" alt="">
                    <div class="sidebar-menu-body">
                        <nav id="sidebar-menu">
                            <div class="sidebar-header">
                                <img src="{{asset('assets/files/images/'.$gs->logo)}}" alt="Sidebar header logo" class="sidebar-header-logo">
                            </div>
                            <ul class="list-unstyled profile">
                                <li class="active">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/files/images/'.Auth::guard('admin')->user()->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="profile image">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">    
                                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">{{ Auth::guard('admin')->user()->name}} <span>{{ Auth::guard('admin')->user()->role}}</span></a>
                                        </div>
                                    </div>
                                        <ul class="collapse list-unstyled profile-submenu" id="homeSubmenu">    
                                            <li><a href="{{ route('admin-profile') }}"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                                            <li><a href=" {{ route('admin-password-reset') }} "><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                                            <li><a href="{{ route('admin-logout') }}"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="list-unstyled components">
                                <li>
                                    <a href="{{route('front.index')}}" target="_blank"><i class="fa fa-home"></i> View Website</a>
                                </li>
                                <li>
                                    <a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="#videos" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-file-text"></i> Video Section</a>
                                    <ul class="collapse list-unstyled submenu" id="videos">
                                        <li><a href="{{route('admin-video-index')}}"><i class="fa fa-angle-right"></i> Uploaded Videos</a></li>   
                                        <li><a href="{{route('admin-fetch-index')}}"><i class="fa fa-angle-right"></i> Fetched Videos</a></li>   
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('admin-cat-index')}}"><i class="fa fa-fw fa-sitemap"></i>Categories</a>
                                </li>
                                <li>
                                    <a href="{{route('admin-user-index')}}"><i class="fa fa-fw fa-user-md"></i> Users</a>
                                </li>
                                <li>
                                    <a href="#pageSettings" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-file-code-o"></i> Page Settings</a>
                                    <ul class="collapse list-unstyled submenu" id="pageSettings">
                                        <li><a href="{{route('admin-ps-about')}}"><i class="fa fa-angle-right"></i> About us page</a></li>   
                                        <li><a href="{{route('admin-fq-index')}}"><i class="fa fa-angle-right"></i> FAQ page</a></li>
                                        <li><a href="{{route('admin-ps-contact')}}"><i class="fa fa-angle-right"></i> Contact us page</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{route('admin-lang-index')}}"><i class="fa fa-fw fa-language"></i>  Language Settings</a></li>
                                <li><a href="{{route('admin-social-index')}}"><i class="fa fa-fw fa-paper-plane"></i> Social settings</a></li>
                                <li>
                                    <a href="#seoTools" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-wrench"></i> SEO Tools</a>
                                    <ul class="collapse list-unstyled submenu" id="seoTools">
                                        <li><a href="{{route('admin-seotool-analytics')}}"><i class="fa fa-angle-right"></i> Google analytics</a></li>
                                        <li><a href="{{route('admin-seotool-keywords')}}"><i class="fa fa-angle-right"></i> Meta Keys</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#generalSettings" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-cogs"></i> General Settings</a>
                                    <ul class="collapse list-unstyled submenu" id="generalSettings">
                                        <li><a href="{{route('admin-gs-logo')}}"><i class="fa fa-angle-right"></i> Logo</a></li>
                                        <li><a href="{{route('admin-gs-fav')}}"><i class="fa fa-angle-right"></i> Favicon</a></li>
                                        <li><a href="{{route('admin-gs-contents')}}"><i class="fa fa-angle-right"></i> Website Contents</a></li>
                                        <li><a href="{{route('admin-gs-about')}}"><i class="fa fa-angle-right"></i> About Us</a></li>
                                        <li><a href="{{route('admin-gs-address')}}"><i class="fa fa-angle-right"></i> Office Address</a></li>
                                        <li><a href="{{route('admin-gs-footer')}}"><i class="fa fa-angle-right"></i> Footer</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('admin-subs-index')}}"><i class="fa fa-fw fa-group"></i> Subscribers</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            <!-- Ending of Dashboard Sidebar menu area --> 
            </div>
            @yield('contents')
</div>
        

         
        

        <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/jquery.canvasjs.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/main.js')}}"></script>
        <script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/admin-main.js')}}"></script>
        <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>    
        @yield('scripts')

    </body>
</html>
