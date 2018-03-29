//Function to prompt the user for deactivation confirmation
function deactivateStaffAccPrompt(staffName) {
    alertify.confirm("Confirm to deactivate staff (" + staffName + ") account?", function (e) {
        if (e) {
            $('#deactivateStaffAcc').submit();
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
