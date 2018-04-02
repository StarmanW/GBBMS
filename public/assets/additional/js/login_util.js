//Function to display messages stating the account is deactivated
function deactivated(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Account Deactivated").show();
}

//Function to display account successfully deactivated message
function deactivationSuccess(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Account Deactivated").show();
}

//Function to display error message when deactivating account
function deactivationFailure(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Account Deactivation Unsuccessful").show();
}

//Function to display message after request for reset password
function passResetStatus(message) {
    alertify.alert(message).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Password Reset").show();
}

//Function to display invalid login credentials
function loginInvalid(message) {
    alertify.alert().setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Invalid email/password").show();

    //Parse the json data
    var msg = JSON.parse(JSON.stringify(message));

    //Loop through the data and display the message
    Object.keys(msg).forEach(function (key) {
        $('.ajs-content').append("- " + msg[key][0] + "<br/>");
    });
}
