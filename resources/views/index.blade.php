@extends('baseTemplates')

@section('additionalCSS')
    <link rel="stylesheet" href="{{'/assets/additional/css/index.css'}}">
@endsection

@section('title')
    <title>GBBMS</title>
@endsection

@section('contents')
    <section class="cid-qOJqjMLUFF mbr-fullscreen mbr-parallax-background" id="header2-f">
        <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(35, 35, 35);"></div>

        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10 main-wrapper">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">Gleaneagles Blood Donation</h1>
                    <div class="">
                        <p class="mbr-text pb-3 mbr-fonts-style display-5">
                            <i>Donating one unit of blood can save three lives.</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
            <a href="#next">
                <i class="mbri-down mbr-iconfont"></i>
            </a>
        </div>
    </section>

    <section class="header3 cid-qOJrElQdi2" id="header3-o">
        <div class="container">
            <div class="media-container-row">
                <div class="mbr-figure" style="width: 125%;">
                    <img src="assets/images/blood-2-1138x640.png" alt="Mobirise" title="">
                </div>

                <div class="media-content">
                    <h3 class="mbr-section-subtitle align-left mbr-white mbr-light pb-3 mbr-fonts-style display-2">
                        Register as a new Donor now!</h3>
                    <div class="mbr-section-text mbr-white pb-3 ">
                        <p class="mbr-text mbr-fonts-style display-5">
                            Start register an account now to begin your blood donation.</p>
                    </div>
                    <div class="mbr-section-btn">
                        <a href="/donor/register"><button class="btn btn-md btn-primary display-4">Register Now</button></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="map2 cid-qOJqKB5o4N" id="map2-k">
        <div class="container">
            <div class="media-container-row">
                <h1>Our Location</h1>
            </div>
            <div class="media-container-row">
                <div class="col-md-8">
                    <div class="google-map">
                        <iframe frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:ChIJJSwuo79pOzIRAkRn5qMJsI4"
                                allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection