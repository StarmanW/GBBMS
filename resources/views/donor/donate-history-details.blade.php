@extends('donor.layout.baseTemplate')

@section('title', "Donation History Details")

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/additional/css/scrollToTop.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/reservation-details.css"}} type="text/css">
@endsection

@section('contents')
<section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
    <div class="mbr-overlay" style="opacity: 0.1; background-color:black;"></div>

    <div class="container">
        <div class="media-container-column">
            <div class="mbr-testimonial align-center col-12 col-md-10">
                <div class="panel-item">
                    <div class="container">
                        <div class="media-container-row">
                            <div class="title col-12 align-center">
                                <h2 class="pb-3 mbr-fonts-style display-2">Donation History Details</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="profile-table-wrap">
                            <table class="table profile-table">
                                <tbody>
                                <th colspan="2" class="title pb-3 mbr-fonts-style display-2">Reservation</th>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Reservation ID</th>
                                    <td class="body-item mbr-fonts-style display-7">{{$donHistDetail->events->reservations[0]->resvID}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Date Reserved</th>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($donHistDetail->events->reservations[0]->resvDateTime), "d-M-Y")}}</td>
                                </tr>
                                <th colspan="2" class="title pb-3 mbr-fonts-style display-2">Blood Donation</th>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Donated Blood Amount</th>
                                    <td class="body-item mbr-fonts-style display-7">{{$donHistDetail->bloodVol}} ml</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Additional Remarks</th>
                                    @if($donHistDetail->remarks==null)
                                        <td class="body-item mbr-fonts-style display-7">Completed</td>
                                    @else
                                        <td class="body-item mbr-fonts-style display-7">{{$donHistDetail->remarks}}</td>
                                    @endif
                                </tr>
                                <th colspan="2" class="title pb-3 mbr-fonts-style display-2">Event</th>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Event ID</th>
                                    <td class="body-item mbr-fonts-style display-7">{{$donHistDetail->events->eventID}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Event Name</th>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($donHistDetail->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Date</th>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($donHistDetail->events->eventDate), "d-M-Y")}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Nurses On Duty</th>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <table class="table profile-table-nurse">
                                            <thead>
                                            <tr>
                                                <th>Nurse ID</th>
                                                <th>Nurse Name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($donHistDetail->events->eventSchedules as $nurses)
                                                <tr>
                                                    <td class="body-item mbr-fonts-style display-7">{{$nurses->staffs->staffID}}</td>
                                                    <td class="body-item mbr-fonts-style display-7">{{$nurses->staffs->firstName}} {{$nurses->staffs->lastName}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="card">
                                <div class="card-body">
                                    <a href="/donor/donation"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
