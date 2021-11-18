<!DOCTYPE html>
<html lang="">

<head>
    <!-- Basic Page Needs -->
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="CreativeLayers">
    <title> Moray | @yield('title') </title>
    <!-- Boostrap style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('driver/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/daterangepicker.min.css')}}" />
    <!-- REVOLUTION LAYERS STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/layers.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/settings.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/date-pick.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive style -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    @yield('css')
    <style>
        .tp-splitted {
            font-size: 2.5rem !important;
        }

        .profile-drop-down {
            background: #fff;
            position: absolute;
            right: 136px;
            z-index: 9999;
            text-align: center;
            height: 137px;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
            display: none;
        }

        .profile-drop-down li>a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="layout-theme">
        {{-- <div id="loading-overlay">--}}
        {{-- <div class="loader"></div>--}}
        {{-- </div>--}}
        <!-- Start Header -->
        <header id="header" class="header-04">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <ul>
                                <li><img src="{{asset('images/icon/call.png')}}" alt="">{{\App\CmsHomePage::getValueForKey(\App\Utills\Constants\AppConsts::HOME_PHONE_NUMBER) ? \App\CmsHomePage::getValueForKey(\App\Utills\Constants\AppConsts::HOME_PHONE_NUMBER) : '+49 (0) 69 330 889 08'}}</li>
                                {{-- <li><img src="{{asset('images/icon/mail.png')}}" alt="">Email:--}}
                                {{-- {{\App\CmsHomePage::getValueForKey(\App\Utills\Constants\AppConsts::HOME_EMAIL_ADDRESS) ? \App\CmsHomePage::getValueForKey(\App\Utills\Constants\AppConsts::HOME_EMAIL_ADDRESS) : 'info@moray-limousines.com'}}--}}
                                {{-- </li>--}}
                                {{-- <li><img src="{{asset('images/icon/mail.png')}}" alt=""><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="10797e767f5060627f74796266753e737f7d">[email&#160;protected] Info@mylisft.com</a></li>--}}
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 d-none d-md-block d-lg-block d-sm-none right-content">
                            @if (Auth()->check())

                            @if(Auth()->user()->user_type == 'end_user')
                            <!-- <a class="text-white mr-4" href="{{url('user/profile')}}">Profil</a> -->
                            <a class="text-white mr-4 profileText" href="#">Profil</a>
                            <div class="profile-drop-down">
                                <ul>
                                    <li>
                                        <a href="{{url('user/reservation')}}">Meine Buchungen</a>
                                    </li>
                                    <li>
                                        <a href="{{url('user/profile')}}">Account</a>
                                    </li>
                                </ul>
                            </div>
                            @elseif(Auth()->user()->user_type == 'admin')
                            <a class="text-white mr-4" href="{{url('admin/index')}}">Profil</a>
                            @elseif(Auth()->user()->user_type == 'driver')
                            <a class="text-white mr-4" href="{{url('driver/profile')}}">Profil</a>
                            @elseif(Auth()->user()->user_type == 'partner')
                            <a class="text-white mr-4" href="{{url('partner/profile')}}">Profil</a>
                            @endif
                            {{Auth()->user()->first_name}} /<form id="logout-form" style="display: inline" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="p-0" style="height: 2rem ; font-size: 14px; font-family: serif">Log out</button>
                            </form>
                            @else
                            <div class="login">

                                <a href="{{url('/login')}}">Login/</a>
                                <a href="{{url('/register')}}">Registrieren</a>

                            </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-header">
                <div class="container-fluid">
                    <div id="logo" class="logo-pro pt-0" style="width: 20%; text-align: center;">
                        <a href="{{url('/')}}" title="Moray Limousines">
                            <img src="{{asset('images/moray-logo.png')}}" alt="logo" class="img-fluid" style="margin-top: -8px; max-height: 6rem;">
                        </a>
                    </div>
                    <div class="navigation w-75 pull-right">
                        <div class="mobile-menu pull-right" style="cursor: pointer;">
                            <span></span>
                        </div>
                        <div id="main-menu" class="main-menu">
                            <div class="top-text">
                                <span>
                                    <a href="{{url('/')}}" title="">
                                        <img src="{{asset('images/moray-logo.png')}}" alt="logo" class="img-fluid" style="margin-top: -8px; max-height: 6rem;">
                                    </a>
                                    @if (Auth()->check())

                                    @if(Auth()->user()->user_type == 'end_user')
                                    <a class="text-white mr-4" href="{{url('user/profile')}}">Profil</a>
                                    @elseif(Auth()->user()->user_type == 'admin')
                                    <a class="text-white mr-4" href="{{url('admin/index')}}">Profil</a>
                                    @elseif(Auth()->user()->user_type == 'driver')
                                    <a class="text-white mr-4" href="{{url('driver/profile')}}">Profil</a>
                                    @elseif(Auth()->user()->user_type == 'partner')
                                    <a class="text-white mr-4" href="{{url('partner/profile')}}">Profil</a>
                                    @endif
                                    {{Auth()->user()->first_name}} /<form id="logout-form" style="display: inline" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-0" style="height: 2rem ; font-size: 14px; font-family: serif">Log out</button>
                                    </form>
                                    @else
                                    <div class="login">

                                        <a href="{{url('/login')}}">Login/</a>
                                        <a href="{{url('/register')}}">Registrieren</a>

                                    </div>

                                    @endif
                                </span>



                                <i class="pe-7s-close"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert-wrong-city alert-danger alert-dismissible fade show position-absolute p-1 text-center" style="color: white; border: darkgoldenrod;  background: #f70000e3;margin-top: 6.1rem; display: none; " role="alert">
                        <strong class="alert-box-text"></strong>
                        <span id="alert_box_text" style="font-size: 17px;font-family: sans-serif;">Holy guacamole!</span>
                    </div>
                </div>
            </div>

        </header>

        @yield('content-area')
        <!-- Start Copyright -->
        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright Moray Group : © {{date('Y')}}. All Rights Reserved
                            <a href="{{url('/mpressum')}}" class="pl-2 pr-2" style="color: goldenrod; text-decoration: underline;"> Impressum</a>
                            <a href="{{url('/datenschutz')}}" class="pl-2" style="color: goldenrod;text-decoration: underline;"> Datenschutz</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Copyright -->
        <div class="scroll-top">
        </div>
    </div>


    <!-- Javascript -->
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/parallax.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/waves.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment_timezone.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment_load_timezone.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/owl.carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('js/gmap3.min.js')}}"></script>--}}

    <script type="text/javascript" src="{{asset('js/template.js')}}"></script>
    <!-- Revolution Slider -->
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/slider.js')}}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132330959-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-132330959-1');
    </script>
    {{--<script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.video.min.js')}}"></script>--}}
    @yield('js')
    <script>
        var i = 0;
        $(".profileText").click(function() {
            if ($(".profile-drop-down").css("display") == "none") {
                $(".profile-drop-down").css("display", "block")
            } else {
                $(".profile-drop-down").css("display", "none")
            }
        })
        jQuery('input[type="checkbox"]').on('change', function() {
            if (i == 0) {
                jQuery(".checkbox input[type='checkbox']:checked + label::after").css("opacity", "1")
                console.log("hello 0")

                i++;
            } else {
                i = 0;
                jQuery(".checkbox input[type='checkbox']:checked + label::after").css("opacity", "0")
                console.log("hello 1")

            }

        });
    </script>

</body>

</html>