(function () {
    // Select forms
    const addStaffForm = document.getElementById('addStaffForm');
    const addEventForm = document.getElementById('addEventForm');
    const addRoomForm = document.getElementById('addRoomForm');

    // Add event listeners
    addStaffForm.addEventListener('submit', addNewStaff);
    addEventForm.addEventListener('submit', addNewEvent);
    addRoomForm.addEventListener('submit', addNewRoom);

    // Function to make AJAX request for add new staff
    function addNewStaff(e) {
        e.preventDefault();

        // Fetch init
        const fetchInit = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(addStaffForm)
        };

        // Submit new add room request
        fetch('/staff/hr/registration/staff', fetchInit)
            .then(res => res.status === 200 ? res.json() : console.error(res.status))
            .then(data => {
                resetInputClass();

                // Highlight input field if error
                if (data.validationFailed) {
                    for (inputField in data.validationData) {
                        let fieldElement = document.querySelector(`*[name="${inputField}"]`);
                        fieldElement.classList.add('is-invalid');
                        fieldElement.nextElementSibling.textContent = `${data.validationData[inputField][0]}`;
                    }
                }

                // Display pop-up message
                switch (data.status) {
                    case 'success':
                        displayAlert('Staff Added', data.message);
                        break;
                }
            })
            .catch(err => console.error(err));
    }

    // Function to make AJAX request for add new event
    function addNewEvent(e) {
        e.preventDefault();

        // Fetch init
        const fetchInit = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(addEventForm)
        };

        // Submit new add room request
        fetch('/staff/hr/registration/event', fetchInit)
            .then(res => res.status === 200 ? res.json() : console.error(res.status))
            .then(data => {
                resetInputClass();

                // Highlight input field if error
                if (data.validationFailed) {
                    for (inputField in data.validationData) {
                        let fieldElement = document.querySelector(`*[name="${inputField}"]`);
                        fieldElement.classList.add('is-invalid');
                        fieldElement.nextElementSibling.textContent = `${data.validationData[inputField][0]}`;
                    }
                }

                // Display pop-up message
                switch (data.status) {
                    case 'success':
                        displayAlert('Event Added', data.message);
                        break;
                    case 'occupiedRoom':
                        displayAlert('Occupied Day', data.message);
                        break;
                    case 'error':
                        displayAlert('An error occurred', data.message);
                        break;
                }
            })
            .catch(err => console.error(err));
    }

    // Function to make AJAX request for add room
    function addNewRoom(e) {
        e.preventDefault();

        // Fetch init
        const fetchInit = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            credentials: "same-origin",
            body: new FormData(addRoomForm)
        };

        // Submit new add room request
        fetch('/staff/hr/registration/room', fetchInit)
            .then(res => res.status === 200 ? res.json() : console.error(res.status))
            .then(data => {
                resetInputClass();

                // Highlight input field if error
                if (data.validationFailed) {
                    for (inputField in data.validationData) {
                        let fieldElement = document.querySelector(`*[name="${inputField}"]`);
                        fieldElement.classList.add('is-invalid');
                        fieldElement.nextElementSibling.textContent = `${data.validationData[inputField][0]}`;
                    }
                }

                // Display pop-up message
                switch (data.status) {
                    case 'success':
                        displayAlert('Room Added', data.message);
                        break;
                    case 'duplicated':
                        displayAlert('Duplicated Room', data.message);
                        break;
                    case 'error':
                        displayAlert('An error occurred', data.message);
                        break;
                }
            })
            .catch(err => console.error(err));
    }

    // Function to reset input error class
    function resetInputClass() {
        document.querySelectorAll('.form-control').forEach(field => {
            field.classList.remove('is-invalid');
        });
    }

    // Function to display alert message
    function displayAlert(header, message) {
        const alertifyConfigs = {
            'transition': 'zoom',
            'movable': false,
            'modal': true,
            'labels': 'OK'
        };

        alertify.alert(message).setting(alertifyConfigs).setHeader(header).show();
    }
})();

