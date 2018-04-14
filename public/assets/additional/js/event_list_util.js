//Display reservation success pop-up message
function displayReservationStatus(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Blood Donation Reservation").show();
}

//Function to display cancellation confirm message
function reservationPrompt(eventID, eventName) {
    alertify.confirm("Confirm to make reservation for event " + eventName + " (" + eventID + ")" + "?", function (e) {
        if (e) {
            $('#reserve' + eventID).submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Confirm',
            cancel: "Cancel"
        }
    }).setHeader("Blood Donation Reservation Confirmation").show();
}