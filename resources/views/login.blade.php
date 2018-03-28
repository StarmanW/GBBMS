@extends('baseTemplates')

@section('title')
    <title>Login</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet'>
    <link rel="stylesheet" href="{{'/assets/additional/css/normalize.css'}}">
    <link rel="stylesheet" href="{{'/assets/additional/css/login-page_style.css'}}">
    <link rel="stylesheet" href="{{'/assets/additional/css/login-page_responsive.css'}}">
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/notify.css" type="text/css">
@endsection

@section('contents')
<div class="login-page_container">
    <!--       Donor sign in Side      -->
    <div class="login-section page-side section-ope">
        <div class="section-page_intro">
            <div class="container" id="donorSignInContainer">
                <img src="{{'/assets/images/donor.png'}}" alt="signin-icon">
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
                            <input type="email" name="emailAddress" placeholder="email@hotmail.com"
                                   class="login-page_input form-control"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                   title="E.g. - john@hotmail.com" required="required">
                        </div>
                        <br/>
                        <div class="row">
                            <label>
                                <span style="color:red;">*</span>Password</label>
                            <input type="password" name="password" id="password" class="login-page_input form-control"
                                   required="required">
                        </div>
                        <div class="login-page_forget">
                            <a href="">Forgotten Your Password?</a>
                        </div>
                        <div class="submit-button button-div-center">
                            <button type="submit" class="btn btn-sm btn-success signin-tab-btn">SIGN IN</button>
                            <a href="/donor/register"><button type="button" class="btn btn-sm btn-primary signin-tab-btn">SIGN UP</button></a>
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
                            <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                   title="E.g. - john@hotmail.com" required="required">
                        </div>
                    </div>
                    <div class="submit-button button-div-center">
                        <button type="submit" class="btn btn-sm btn-success reset-tab-btn">Reset Password</button>
                        <button type="button" class="btn btn-sm btn-primary reset-tab-btn"
                                onclick="$('.login-form').slideDown();$('.forget-form').slideUp();">Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--       Staff sign in Side      -->
    <div class="signup-section page-side section-clos">
        <div class="section-page_intro">
            <div class="container" id="staffSignInContainer">
                <img src="{{'/assets/images/staff.png'}}" alt="signup-icon">
                <p class="section-page-intro_title">STAFF SIGN IN</p>
            </div>
        </div>
        <div class="login-form-area">
            <p class="form-title">STAFF SIGN IN</p>
            <div class="section-form">
                <form class="staffLogin-form" method="POST" action="/staff/login">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row">
                            <label>
                                <span style="color:red;">*</span>Email</label>
                            <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                   title="E.g. - john@hotmail.com" required="required">
                        </div>
                        <br/>
                        <div class="row">
                            <label>
                                <span style="color:red;">*</span>Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                   required="required">
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
                    {{ csrf_field() }}
                    <p class="forget-title">Forgotten Your Password</p>
                    <div class="container">
                        <div class="row">
                            <label>
                                <span style="color:red;">*</span>Email</label>
                            <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                   title="E.g. - john@hotmail.com" required="required">
                        </div>
                    </div>
                    <div class="submit-button button-div-center">
                        <button type="submit" class="btn btn-sm btn-success reset-tab-btn">Reset Password</button>
                        <button type="button" class="btn btn-sm btn-primary reset-tab-btn"
                                onclick="$('.staffLogin-form').slideDown();$('.staffForget-form').slideUp();">Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalJS')
    <script src="{{'/assets/additional/js/jquery-1.12.1.min.js'}}"></script>
    <script src="{{'/assets/additional/js/login-page_script.js'}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if (count($errors) > 0)
    <script>
        //Function to display error message when using donor registration form
        alertify.alert().setting({
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': 'OK'
        }).setHeader("Invalid email/password").show();

        //Parse the json data
        var msg = JSON.parse(JSON.stringify({!! $errors !!}));

        //Loop through the data and display the message
        Object.keys(msg).forEach(function (key) {
            $('.ajs-content').append("- " + msg[key][0] + "<br/>");
        });
    </script>
    @elseif(session('deactivated'))
    <script>
        //Function to display error message when using donor registration form
        alertify.alert('{{session('deactivated')}}').setting({
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': 'OK'
        }).setHeader("Account Deactivated").show();
    </script>
    @endif
@endsection
