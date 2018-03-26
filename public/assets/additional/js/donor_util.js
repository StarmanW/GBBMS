//Function to prompt the user for deactivation confirmation
function deactivateDonorAccPrompt(donorName) {
    alertify.confirm("Confirm to deactivate donor (" + donorName + ") account?", function (e) {
        if (e) {
            $('#deactivateDonorAcc').submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Confirm',
            cancel: "Cancel"
        }
    }).setHeader("Deactivate Donor Account Confirmation").show();
}

//Function to display error message when using donor registration form
function donorFormError(title, errMsg) {
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

function donorUpdateProfileSuccess(successMsg) {
    //Display Donor Profile Update Success message
    alertify.alert(successMsg).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': 'OK'
    }).setHeader("Profile Details Updated!").show();
}