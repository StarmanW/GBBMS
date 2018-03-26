@extends('staff.layout.baseTemplate-Nurse')

@section('title')
    <title>Blood Management</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <div class="container align-center">
                        <br />
                        <br />
                        <div class="form-container">
                            <h1 class="well">Blood Managememt</h1>
                            <hr style="border-top:1px solid gray;" />
                            <div class="col-lg-12 well">
                                <div class="row">
                                    <form method="POST" action="">
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br />
                                        <br />
                                        <div class="col-sm-12">
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Blood Bag ID</label>
                                                <input type="text" name="fName" placeholder="NA16AA00001" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                                    required="required">
                                            </div>
                                            <br>
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Donor ID</label>
                                                    <select name="donor-id" class="form-control" required="required">
                                                        <option>Select a donor ID</option>
                                                        <option>DNOPAA0001 Samuel Wong Kim Foong</option>
                                                        <option>DNANEC0002 Shrilina Koo Yung Ja</option>
                                                        <option>DABPER0004 Zion Tseu</option>
                                                        <option>DNBPEF0005 Chong Jia Herng</option>
                                                    </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Donated Blood Volume (mL)</label>
                                                    <input class="form-control" type="text" name="blood-amount" placeholder="450">
                                                </div>
                                            </div>
                                            <div class="row" style="margin:auto">
                                                <label>Remarks</label>
                                                <textarea class="form-control" name="remarks"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="submit-button">
                                            <button type="submit" class="btn btn-lg btn-success form-btn">Submit</button>
                                            <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
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