{{dd(Auth::guard('staff'))}}@extends('baseTemplates')

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/additional/css/error.css" type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10 main-wrapper">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">Uh Oh!</h1>
                    <hr />
                    <p class="mbr-text pb-3 mbr-fonts-style display-2 blackFont">
                        Whoops, looks like something went wrong.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection


