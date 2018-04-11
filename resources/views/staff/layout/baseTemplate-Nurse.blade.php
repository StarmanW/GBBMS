<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="/assets/images/gLogo.png" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link rel="stylesheet" href="/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
    <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="/assets/tether/tether.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/assets/dropdown/css/style.css">
    <link rel="stylesheet" href="/assets/socicon/css/styles.css">
    <link rel="stylesheet" href="/assets/theme/css/style.css">
    <link rel="stylesheet" href="/assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/scrollToTop.css" type="text/css">

    @yield('additionalCSS')

</head>

<body>
<section class="menu cid-qMsJf9csN8" once="menu" id="menu1-17">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="/staff/nurse/homepage">
                            <img src="/assets/images/gLogo.png" alt="Gleneagles Logo"
                                 title="" style="height: 3.8rem;">
                        </a>
                    </span>
                <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-white display-7" href="/staff/nurse/homepage">Gleneagles Kota Kinabalu</a>
                    </span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="./schedule">VIEW SCHEDULES</a>
                    <!-- TEMP LINK -->
                </li>
                <li class="nav-item dropdown open">
                    <a class="nav-link link text-white dropdown-toggle display-4" data-toggle="dropdown-submenu"
                       aria-expanded="true">{{\Illuminate\Support\Facades\Auth::user()->firstName}}</a>
                    <div class="dropdown-menu">
                        <a class="text-white dropdown-item display-4" href="./profile">View Profile
                            <!-- TEMP LINK -->
                            <br>
                        </a>
                        <a class="nav-link link text-white display-4" href="/staff/nurse/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="mbri-lock mbr-iconfont mbr-iconfont-btn"></span>Logout
                        </a>
                        <form id="logout-form" action="/staff/nurse/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</section>

@yield('contents')

<section class="cid-qLZKjpnkMs" id="footer1-s">
    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="/staff/nurse/homepage">
                        <img src="/assets/images/gLogo.png" alt="Gleneagles Logo" title="">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Address
                </h5>
                <p class="mbr-text">Riverson@Sembulan, Block A-1, Lorong Riverson@Sembulan,
                    <br>88100 Kota Kinabalu, Sabah</p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Contacts
                </h5>
                <p class="mbr-text">General Line: +6088 518 888
                    <br>Appointment Line: +6088-518 810
                    <br>FAX: +6088-518 889
                    <br>24-Hour Emergency &amp; Ambulance: +6088-518 911</p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Links
                </h5>
                <p class="mbr-text">
                    <a href="http://gleneagleskk.com.my/" target="_blank">Gleneagles KK
                    </a>
                    <br>
                    <a href="http://gleneagleskk.com.my/contact-us/" target="_blank">Gleneagles Contact From
                    </a>
                    <br>
                    <a href="http://gleneagleskk.com.my/careers/" target="_blank">Careers</a>
                </p>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row mbr-white">
                <div class="col-sm-12 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2018 Gleneagles Kota Kinabalu Hospital. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/assets/web/assets/jquery/jquery.min.js"></script>
<script src="/assets/popper/popper.min.js"></script>
<script src="/assets/tether/tether.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/dropdown/js/script.min.js"></script>
<script src="/assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="/assets/parallax/jarallax.min.js"></script>
<script src="/assets/smoothscroll/smooth-scroll.js"></script>
<script src="/assets/theme/js/script.js"></script>
<script src="/assets/additional/js/scrolltotop.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
@yield('additionalJS')

<!-- Back to top -->
<div id="scrollToTop" class="scrollToTop mbr-arrow-up">
    <a style="text-align: center;">
        <i></i>
    </a>
</div>
</body>

</html>