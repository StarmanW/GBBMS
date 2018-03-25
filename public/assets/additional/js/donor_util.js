//Function to prompt the user for deactivation confirmation
function deactivateDonorAccPrompt(member_id) {
    alertify.confirm("Confirm to deactivate donor " + member_id + " account?", function (e) {
        if (e) {
            $('#deleteMember').submit();
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
function donorRegisterError(title, errMsg) {
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