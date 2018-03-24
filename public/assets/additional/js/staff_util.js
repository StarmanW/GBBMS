//Function to prompt the user for deactivation confirmation
function deactivateStaffAccPrompt(member_id) {
    alertify.confirm("Confirm to deactivate staff " + member_id + " account?", function (e) {
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
    }).setHeader("Deactivate Staff Account Confirmation").show();
}