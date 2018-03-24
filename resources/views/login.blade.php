<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="{{'assets/images/gLogo.png'}}" type="image/x-icon">
    <meta name="description" content="">
    <title>Login</title>
    <link rel="stylesheet" href="{{'assets/web/assets/mobirise-icons/mobirise-icons.css'}}">
    <link rel="stylesheet" href="{{'assets/tether/tether.min.css'}}">
    <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap-grid.min.css'}}">
    <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap-reboot.min.css'}}">
    <link rel="stylesheet" href="{{'assets/socicon/css/styles.css'}}">
    <link rel="stylesheet" href="{{'assets/dropdown/css/style.css'}}">
    <link rel="stylesheet" href="{{'assets/theme/css/style.css'}}">
    <link rel="stylesheet" href="{{'assets/mobirise/css/mbr-additional.css'}}" type="text/css">
    <link rel="stylesheet" href="{{'assets/additional/css/scrollToTop.css'}}" type="text/css">
    <link rel="stylesheet" href="{{'assets/additional/css/registerForm.css'}}" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet'>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{'assets/additional/css/normalize.css'}}">
    <link rel="stylesheet" href="{{'assets/additional/css/login-page_style.css'}}">
    <link rel="stylesheet" href="{{'assets/additional/css/login-page_responsive.css'}}">
</head>

<body>
    <section class="menu cid-qLZn3ksm57" once="menu" id="menu1-i">
        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
            <div class="menu-logo">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <!-- TEMP LINK -->
                        <a href="login.blade.php">
                            <img src="{{'assets/images/gLogo.png'}}" alt="Gleneagles Logo" title="" style="height: 3.8rem;">
                        </a>
                    </span>
                    <span class="navbar-caption-wrap">
                        <!-- TEMP LINK -->
                        <a class="navbar-caption text-white display-4" href="login.blade.php">Gleneagles Kota Kinabalu</a>
                    </span>
                </div>
            </div>
        </nav>
    </section>
    <div class="login-page_container">
        <!--       Donor sign in Side      -->
        <div class="login-section page-side section-ope">
            <div class="section-page_intro">
                <div class="container" id="donorSignInContainer">
                    <img src="{{'assets/images/donor.png'}}" alt="signin-icon">
                    <p class="section-page-intro_title">DONOR SIGN IN</p>
                </div>
            </div>
            <div class="login-form-area">
                <p class="form-title">DONOR SIGN IN</p>
                <div class="section-form">
                    <form class="login-form" method="POST" action="/donor/login">
                        {{ csrf_field() }}
                        <div class="container">
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Email</label>
                                <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="login-page_input form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                    title="E.g. - john@hotmail.com" required="required">
                            </div>
                            <br/>
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Password</label>
                                <input type="password" name="password" id="password" class="login-page_input form-control" required="required">
                            </div>
                            <div class="login-page_forget">
                                    <a href="">Forgotten Your Password?</a>
                            </div>
                            <div class="submit-button button-div-center">
                                <button type="submit" class="btn btn-sm btn-success signin-tab-btn">SIGN IN</button>
                                <button type="button" class="btn btn-sm btn-primary signin-tab-btn">SIGN UP</button>
                            </div>
                        </div>
                    </form>

                    <form class="forget-form" method="POST" action="/donor/password/email">
                        {{ csrf_field() }}
                        <p class="forget-title">Forgotten Your Password</p>
                        <div class="container">
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Email</label>
                                <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                    title="E.g. - john@hotmail.com" required="required">
                            </div>
                        </div>
                        <div class="submit-button button-div-center">
                            <button type="submit" class="btn btn-sm btn-success reset-tab-btn">Reset Password</button>
                            <button type="button" class="btn btn-sm btn-primary reset-tab-btn" onclick="$('.login-form').slideDown();$('.forget-form').slideUp();">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--       Staff sign in Side      -->
        <div class="signup-section page-side section-clos">
            <div class="section-page_intro">
                <div class="container" id="staffSignInContainer">
                    <img src="{{'assets/images/staff.png'}}" alt="signup-icon">
                    <p class="section-page-intro_title">STAFF SIGN IN</p>
                </div>
            </div>
            <div class="login-form-area">
                <p class="form-title">STAFF SIGN IN</p>
                <div class="section-form">
                    <form class="staffLogin-form" method="POST" action="/staff/login">
                        <div class="container">
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Email</label>
                                <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                    title="E.g. - john@hotmail.com" required="required">
                            </div>
                            <br/>
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Password</label>
                                <input type="password" name="password" id="password" class="form-control" required="required">
                            </div>
                            <div class="staff_forget">
                                    <a href="">Forgotten Your Password?</a>
                            </div>
                            <br>
                            <div class="submit-button button-div-center">
                                <button type="submit" class="btn btn-sm btn-success signin-tab-btn">SIGN IN</button>
                            </div>
                        </div>
                    </form>

                    <form class="staffForget-form" method="POST" action="/staff/password/email">
                        <p class="forget-title">Forgotten Your Password</p>
                        <div class="container">
                            <div class="row">
                                <label>
                                    <span style="color:red;">*</span>Email</label>
                                <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                    title="E.g. - john@hotmail.com" required="required">
                            </div>
                        </div>
                        <div class="submit-button button-div-center">
                            <button type="submit" class="btn btn-sm btn-success reset-tab-btn">Reset Password</button>
                            <button type="button" class="btn btn-sm btn-primary reset-tab-btn" onclick="$('.staffLogin-form').slideDown();$('.staffForget-form').slideUp();">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="cid-qLZKjpnkMs" id="footer1-s">
        <div class="container">
            <div class="media-container-row content text-white">
                <div class="col-12 col-md-3">
                    <div class="media-wrap">
                        <!-- TEMP LINK -->
                        <a href="login.blade.php">
                            <img src="{{'assets/images/gLogo.png'}}" alt="Gleneagles Logo" title="">
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

    <!-- Back to top -->
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up">
        <a style="text-align: center;">
            <i></i>
        </a>
    </div>

    <script src="{{'assets/web/assets/jquery/jquery.min.js'}}"></script>
    <script src="{{'assets/popper/popper.min.js'}}"></script>
    <script src="{{'assets/tether/tether.min.js'}}"></script>
    <script src="{{'assets/bootstrap/js/bootstrap.min.js'}}"></script>
    <script src="{{'assets/dropdown/js/script.min.js'}}"></script>
    <script src="{{'assets/touchswipe/jquery.touch-swipe.min.js'}}"></script>
    <script src="{{'assets/parallax/jarallax.min.js'}}"></script>
    <script src="{{'assets/smoothscroll/smooth-scroll.js'}}"></script>
    <script src="{{'assets/theme/js/script.js'}}"></script>
    <script src="{{'assets/additional/js/scrolltotop.js'}}"></script>

    <script src="{{'assets/additional/js/jquery-1.12.1.min.js'}}"></script>
    <script src="{{'assets/additional/js/login-page_script.js'}}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>

</html>