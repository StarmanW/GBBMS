//Function to prompt the user for deactivation confirmation
function cancelEventPrompt(eventName) {
    alertify.confirm("Confirm to cancel event \"" + eventName + "\"?", function (e) {
        if (e) {
            $('#cancelEventForm').submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Confirm',
            cancel: "Cancel"
        }
    }).setHeader("Event Cancellation Confirmation").show();
}

//Function to display error message when using update event form
function eventUpdateFormError(title, errMsg) {
    alertify.alert().setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader(title).show();

    //Parse the json data
    var msg = JSON.parse(JSON.stringify(errMsg));

    //Loop through the data and display the message
    Object.keys(msg).forEach(function (key) {
        $('.ajs-content').append("- " + msg[key][0] + "<br/>");
    });
}

//Display Event Details Update Success message
function eventUpdateSuccess(successMsg) {
    alertify.alert(successMsg).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Event Details Updated!").show();
}
