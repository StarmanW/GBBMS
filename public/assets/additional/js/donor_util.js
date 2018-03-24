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