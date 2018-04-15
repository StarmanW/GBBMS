//Function to prompt the user for deactivation confirmation
function deactivateStaffAccPrompt(staffID, staffName) {
    alertify.confirm("Confirm to deactivate staff \"" + staffName + "\" " + "(" + staffID + ")" + " account?", function (e) {
        if (e) {
            $('#deactivateStaffAcc' + staffID).submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Confirm',
            cancel: "Cancel"
        }
    }).setHeader("Deactivate Staff Account Confirmation").show();
}

//Function to display error message when using staff registration/update form
function staffFormError(title, errMsg) {
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

function staffUpdateProfileSuccess(successMsg) {
    //Display Staff Profile Update Success message
    alertify.alert(successMsg).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Profile Details Updated!").show();
}

//Function to display staff account deactivation message by HR Manager
function staffAccDeactivationHR(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Staff Account Deactivation").show();
}

//Function to display message when the only HR trying to deactivate account
function oneHRAcc(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Staff Account Deactivation").show();
}
