(function () {
    // Select two forms - Update profile form and Update password form
    const updateProfileForm = document.getElementById('updateProfileForm');
    const updatePassForm = document.getElementById('updatePassForm');

    // Add event listeners to forms and buttons
    updateProfileForm.addEventListener('submit', updateProfile);
    updatePassForm.addEventListener('submit', updatePassword);
    document.getElementById('deactivateAcc').addEventListener('click', deactivateStaffAccPrompt);

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

        fetch(`/staff/${window.location.pathname.split('/')[2]}/profile`, fetchInit)
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

        fetch(`/staff/${window.location.pathname.split('/')[2]}/profile/password`, fetchInit)
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
    function deactivateStaffAccPrompt() {
        const alertifyConfigs = {
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': {
                ok: 'Confirm',
                cancel: "Cancel"
            }
        };

        alertify.confirm("Confirm to deactivate your staff account?", function (e) {
            if (e) {
                $('form[id^=deactivateStaffAcc]').submit();
            }
        }).setting(alertifyConfigs).setHeader("Deactivate Staff Account Confirmation").show();
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
        $('#tStaffName').text(`${user.firstName} ${user.lastName}`);
        $('#tIcNum').text(`${user.ICNum}`);
        $('#tGender').text(user.gender === "1" ? 'Male' : 'Female');
        $('#tBirthDate').text(`${birthDate.getDate()}-${monthNames[birthDate.getMonth()]}-${birthDate.getFullYear()}`);
        $('#tStaffPos').text(`${getStaffPositionString(user.staffPos)}`);
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
    function getStaffPositionString(staffPos) {
        let staffPosString = '';

        switch (parseInt(staffPos)) {
            case 0:
                staffPosString = "Nurse";
                break;
            case 1:
                staffPosString = "Human Resource Manager";
                break;
        }
        return staffPosString;
    }
})();