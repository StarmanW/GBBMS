(function () {
    const addRoomForm = document.getElementById('addRoomForm');

    addRoomForm.addEventListener('submit', addNewRoom);

    function addNewRoom(e) {
        e.preventDefault();

        const fetchInit = {
            headers: {

            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(addRoomForm);
        };

        fetch('/staff/hr/registration/room')
    }

});
//
// function registrationSuccess(message) {
//     //Display Staff registration success message
//     alertify.alert(message).setting({
//         'transition': 'zoom',
//         'movable': false,
//         'modal': true,
//         'labels': 'OK'
//     }).setHeader("Registration Successful").show();
// }
//
// function roomAddFailure(message) {
//     //Display room failure to add message
//     alertify.alert(message).setting({
//         'transition': 'zoom',
//         'movable': false,
//         'modal': true,
//         'labels': 'OK'
//     }).setHeader("Add New Room Failed").show();
// }
//
// function roomAddDuplicated(message) {
//     //Display room failure to add message
//     alertify.alert(message).setting({
//         'transition': 'zoom',
//         'movable': false,
//         'modal': true,
//         'labels': 'OK'
//     }).setHeader("Duplicated Room").show();
// }
//
// function occupiedRoom(message) {
//     //Display message stating occupied day & room
//     alertify.alert(message).setting({
//         'transition': 'zoom',
//         'movable': false,
//         'modal': true,
//         'labels': 'OK'
//     }).setHeader("Occupied Day").show();
// }