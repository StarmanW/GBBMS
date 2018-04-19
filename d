[1mdiff --git a/app/Http/Controllers/ReservationController.php b/app/Http/Controllers/ReservationController.php[m
[1mindex d8e1e7e..026c643 100644[m
[1m--- a/app/Http/Controllers/ReservationController.php[m
[1m+++ b/app/Http/Controllers/ReservationController.php[m
[36m@@ -96,13 +96,7 @@[m [mclass ReservationController extends Controller {[m
                 $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;[m
 [m
                 //return to donor upcoming events page with message[m
[31m-                return redirect('/donor/upcoming-events')->with[m
[31m-                    ([m
[31m-                        'failure', 'You have donated blood at ' .[m
[31m-                        date_format(date_create($donation->events->eventDate), 'd F Y') .[m
[31m-                        ' Please try again after ' . $dateDiff . ' days. [m
[31m-                        (After ' . date_format($donationEventDate, 'd F Y') . ')'[m
[31m-                    );[m
[32m+[m[32m                return redirect('/donor/upcoming-events')->with('failure', 'You have donated blood at ' . date_format(date_create($donation->events->eventDate), 'd F Y') . ' Please try again after ' . $dateDiff . ' days.  (After ' . date_format ($donationEventDate, 'd F Y') . ')');[m
             }[m
         }[m
 [m
[36m@@ -122,11 +116,7 @@[m [mclass ReservationController extends Controller {[m
                 $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;[m
 [m
                 //return to donor upcoming events page with message[m
[31m-                return redirect('/donor/upcoming-events')->with[m
[31m-                    ([m
[31m-                        'failure', 'You have recently reserved a blood donation event that is within the 3 months period. [m
[31m-                        Please try again after ' . $dateDiff . ' days. (After ' . date_format($donationEventDate, 'd F Y') . ')'[m
[31m-                    );[m
[32m+[m[32m                return redirect('/donor/upcoming-events')->with('failure', 'You have recently reserved a blood donation event that is within the 3 months period. Please try again after ' . $dateDiff . ' days. (After ' . date_format($donationEventDate, 'd F Y') . ')');[m
             }[m
         }[m
 [m
[1mdiff --git a/resources/views/staff/event-list.blade.php b/resources/views/staff/event-list.blade.php[m
[1mindex ab7a6a4..5ea62f7 100644[m
[1m--- a/resources/views/staff/event-list.blade.php[m
[1m+++ b/resources/views/staff/event-list.blade.php[m
[36m@@ -55,7 +55,7 @@[m
                             @foreach($events as $event)[m
                             <tr>[m
                                 <td class="body-item mbr-fonts-style display-7">{{$event->eventID}}</td>[m
[31m-                                <td class="body-item mbr-fonts-style display-7">{{$event->eventName}}</td>[m
[32m+[m[32m                                <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</td>[m
                                 <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>[m
                                 <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>[m
                                 <td class="body-item mbr-fonts-style display-7">Room {{substr($event->rooms->roomID, 3)}}, Quadrant {{$event->rooms->quadrant}}, Floor {{$event->rooms->floor}}</td>[m
[1mdiff --git a/storage/app/.gitignore b/storage/app/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/public/.gitignore b/storage/app/public/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/framework/.gitignore b/storage/framework/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/framework/cache/.gitignore b/storage/framework/cache/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/framework/sessions/.gitignore b/storage/framework/sessions/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/framework/testing/.gitignore b/storage/framework/testing/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/framework/views/.gitignore b/storage/framework/views/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/logs/.gitignore b/storage/logs/.gitignore[m
[1mold mode 100644[m
[1mnew mode 100755[m
