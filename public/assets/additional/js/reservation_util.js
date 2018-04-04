//Display reservation cancellation success pop-up message
function displayCancellationStatus(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Reservation Cancellation").show();
}

//Function to display cancellation confirm message
function cancellationPrompt(resvID) {
    alertify.confirm("Confirm to cancel reservation " + resvID + "?", function (e) {
        if (e) {
            $('#cancel' + resvID).submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Confirm',
            cancel: "Cancel"
        }
    }).setHeader("Reservation Cancellation Confirmation").show();
}