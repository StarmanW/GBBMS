@extends((Auth::guest() === true) ? 'baseTemplates' : ((Auth::user() instanceof \App\Donor) ? 'donor.layout.baseTemplate' : ((Auth::user()->staffPos === 1) ? 'staff.layout.baseTemplate-HR' : 'staff.layout.baseTemplate-Nurse')))

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/additional/css/error.css" type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10 main-wrapper">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-2">Uh Oh!</h1>
                    <hr />
                    <p class="mbr-text pb-3 mbr-fonts-style display-5 blackFont">
                        Whoops, looks like something went wrong.
                    </p>
                    <div class="card">
                        <div class="card-body">
                            <a href="{{URL::previous()}}"><button type="button" class="btn btn-sm btn-primary">Back to previous page</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


