(function () {
    // Select two forms - Update profile form and Update password form
    const updateProfileForm = document.getElementById('updateProfileForm');
    const updatePassForm = document.getElementById('updatePassForm');

    // Add event listeners to forms and buttons
    updateProfileForm.addEventListener('submit', updateProfile);
    updatePassForm.addEventListener('submit', updatePassword);
    document.getElementById('deactivateAcc').addEventListener('click', deactivateDonorAccPrompt);

    // Function to update donor profile information using fetch API
    function updateProfile(e) {
        e.preventDefault();

        const fetchInit = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(updateProfileForm)
        };

        fetch('/donor/profile', fetchInit)
            .then(res => res.status === 200 ? res.json() : console.error(res.status))
            .then(data => {
                resetInputClass();

                // If validation failed
                if (data.validationFailed) {
                    for (inputField in data.validationData) {
                        let fieldElement = document.querySelector(`*[name="${inputField}"]`);
                        fieldElement.classList.add('is-invalid');
                        fieldElement.nextElementSibling.textContent = `${data.validationData[inputField][0]}`;
                    }
                }

                // Display alert message based on status
                switch (data.status) {
                    case 'success': {
                        $('#updateProfileModal').modal('hide');
                        updateProfileHTML(data.user);
                        showAlert('Profile Details Updated!', data.message);
                        break;
                    }
                    case 'error': {
                        $('#updateProfileModal').modal('hide');
                        showAlert('An error occurred', data.message);
                        break;
                    }
                }
            })
            .catch(err => console.log(err));
    }

    // Function to update donor password using fetch API
    function updatePassword(e) {
        e.preventDefault();

        const fetchInit = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(updatePassForm)
        };

        fetch('/donor/profile/password', fetchInit)
            .then(res => res.status === 200 ? res.json() : console.error(res.status))
            .then(data => {
                resetInputClass();

                // If validation failed
                if (data.validationFailed) {
                    for (inputField in data.validationData) {
                        let fieldElement = document.querySelector(`input[name="${inputField}"]`);
                        fieldElement.classList.add('is-invalid');
                        fieldElement.nextElementSibling.textContent = `${data.validationData[inputField][0]}`;
                    }
                }

                // Display alert message based on status
                switch (data.status) {
                    case 'success': {
                        $('#changePasswordForm').modal('hide');
                        showAlert('Password Changed!', data.message);
                        break;
                    }
                    case 'error': {
                        $('#changePasswordForm').modal('hide');
                        showAlert('An error occurred', data.message);
                        break;
                    }
                }
            })
            .catch(err => console.log(err));
    }

    //Function to prompt the user for deactivation confirmation
    function deactivateDonorAccPrompt() {
        const alertifyConfigs = {
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': {
                ok: 'Confirm',
                cancel: "Cancel"
            }
        };

        alertify.confirm("Confirm to deactivate your account?", function (e) {
            if (e) {
                $('#deactivateDonorAcc').submit();
            }
        }).setting(alertifyConfigs).setHeader("Deactivate Donor Account Confirmation").show();
    }

    // Function to reset input error class
    function resetInputClass() {
        document.querySelectorAll('.form-control').forEach(field => {
            field.classList.remove('is-invalid');
        });
    }

    // Function to update donor profile information displayed
    function updateProfileHTML(user) {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        const birthDate = new Date(user.birthDate);

        $('#profileImage').attr('src', `/storage/profileImage/${user.profileImage}`);
        $('#tDonorName').text(`${user.firstName} ${user.lastName}`);
        $('#tIcNum').text(`${user.ICNum}`);
        $('#tGender').text(user.gender === "1" ? 'Male' : 'Female');
        $('#tBirthDate').text(`${birthDate.getDate()}-${monthNames[birthDate.getMonth()]}-${birthDate.getFullYear()}`);
        $('#tBloodType').text(`${getBloodTypeString(user.bloodType)}`);
        $('#tEmail').text(`${user.emailAddress}`);
        $('#tPhone').text(`${user.phoneNum}`);
        $('#tHomeAddress').text(`${user.homeAddress}`);
    }

    // Function to show alert message
    function showAlert(header, message) {
        // Define alertify configs
        const alertifyConfigs = {
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': 'OK'
        };

        alertify.alert(message).setting(alertifyConfigs).setHeader(header).show();
    }

    // Function to convert blood type value to string
    function getBloodTypeString(bloodType) {
        let bloodTypeString = '';

        switch (parseInt(bloodType)) {
            case 1:
                bloodTypeString = "A Positive";
                break;
            case 2:
                bloodTypeString = "A Negative";
                break;
            case 3:
                bloodTypeString = "B Positive";
                break;
            case 4:
                bloodTypeString = "B Negative";
                break;
            case 5:
                bloodTypeString = "O Positive";
                break;
            case 6:
                bloodTypeString = "O Negative";
                break;
            case 7:
                bloodTypeString = "AB Positive";
                break;
            case 8:
                bloodTypeString = "AB Negative";
                break;
        }
        return bloodTypeString;
    }
})();

// // AJAX request using JQuery
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
// });
//
// $.ajax({
//     url: '/donor/profile',
//     dataType: 'json',
//     type: 'POST',
//     data: new FormData(updateProfileForm),
//     processData: false,
//     contentType: false,
//     success: function (res) {
//         if (res.status === 'success') {
//             $('#squarespaceModal').modal('hide');
//             resetInputClass();
//             alertify.alert(res.message).setting({
//                 'transition': 'zoom',
//                 'movable': false,
//                 'modal': true,
//                 'labels': 'OK'
//             }).setHeader("Profile Details Updated!").show();
//         } else {
//             for (inputField in res) {
//                 let fieldElement = document.querySelector(`*[name="${inputField}"]`);
//                 fieldElement.classList.add('is-invalid');
//                 fieldElement.nextElementSibling.textContent = `${res[inputField]}`;
//             }
//         }
//     },
//     error: function (err) {
//         console.log(`${err.statusText}: ${err.statusText}`);
//     }
// });