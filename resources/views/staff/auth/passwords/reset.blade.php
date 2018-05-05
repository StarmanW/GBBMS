@extends('baseTemplates')

@section('title', "Staff Reset Password")

@section('additionalCSS')
    <link rel="stylesheet" href="{{'/assets/additional/css/registerForm.css'}}" type="text/css">
@endsection

@section('contents')
    <section class="header4 cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header4-z">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <div class="container align-center">
                        <br/>
                        <br/>
                        <div class="form-container">
                            <h1 class="well">Staff Reset Password</h1>
                            <hr style="border-top:1px solid gray;"/>
                            <div class="col-lg-12 well">
                                <div class="row">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/staff/password/reset') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <p style="color:red; float: left;">"*" Required fields</p><br/><br/>
                                        </div>
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group{{ $errors->has('emailAddress') ? ' has-error' : '' }}">
                                            <label for="emailAddress" class="col-md-4 control-label"><span style="color:red;">*</span>E-Mail Address</label>

                                            <div class="col-md-12">
                                                <input id="emailAddress" type="email" class="form-control" name="emailAddress" value="{{ $emailAddress or old('emailAddress') }}" autofocus>
                                                @if ($errors->has('emailAddress'))
                                                    <span class="help-block" style="color:red;"><strong>{{ $errors->first('emailAddress') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label"><span style="color:red;">*</span>Password</label>

                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control"
                                                       name="password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block" style="color:red;"><strong>{{ $errors->first('password') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="password-confirm" class="col-md-4 control-label"><span style="color:red;">*</span>Confirm
                                                Password</label>
                                            <div class="col-md-12">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation">

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block" style="color:red;"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="submit-button">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Reset Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

