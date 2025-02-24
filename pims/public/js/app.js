const getAll = (selector) => {
    return document.querySelectorAll(selector);
};
 
    document.querySelectorAll('.submenu-toggle').forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
 

window.onload = function() {
    // Check for click events on the navbar burger icon
    var $navbarBurger = getAll('.navbar-burger');
    var $touchMenu = document.getElementById('touchMenu');

    if ($navbarBurger.length > 0) {
        $navbarBurger.forEach(function ($el) {
            $el.addEventListener("click", function (event) {
                event.stopPropagation();
                $el.classList.toggle("is-active");
                $touchMenu.classList.toggle("is-active");
            });
        });
    }

    // Dropdowns
    var $dropdowns = getAll(".dropdown:not(.is-hoverable)");

    if ($dropdowns.length > 0) {
        $dropdowns.forEach(function ($el) {
            $el.addEventListener("click", function (event) {
                event.stopPropagation();
                $el.classList.toggle("is-active");
            });
        });

        document.addEventListener("click", function (event) {
            closeDropdowns();
        });
    }

    function closeDropdowns() {
        $dropdowns.forEach(function ($el) {
            $el.classList.remove("is-active");
        });
    }

    const logout = getAll('.app-logout');

    logout.forEach(function ($el) {
        $el.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Your session will be ended!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Yes, log me out!"
            }).then((result) => {

            });
        });
    });
    // Handling status change
const statusSelectors = document.querySelectorAll('.action-status');

statusSelectors.forEach(function($el) {
    $el.addEventListener('change', function(e) {
        const prisonerId = $el.getAttribute('data-id'); // Get prisoner ID from data-id attribute
        const newStatus = $el.value; // Get selected status value (active, inactive, released)

        // Log the prisoner ID and new status for debugging
        console.log(`Attempting to change status for prisoner with ID: ${prisonerId} to ${newStatus}`);

        // Check if the ID or status is missing
        if (!prisonerId || !newStatus) {
            console.error('Prisoner ID or status is missing!');
            return;
        }

        // SweetAlert2 confirmation
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change the status of this prisoner to " + newStatus + "!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, change it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Make the AJAX request to update the prisoner status
                fetch(`/prisoner/${prisonerId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Log the successful status change
                        console.log(`Prisoner with ID ${prisonerId} status changed to ${newStatus}.`);

                        // Update the status in the UI
                        const statusCell = $el.closest('tr').querySelector('.status-cell');
                        if (statusCell) {
                            statusCell.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1); // Capitalize the first letter

                            // Optionally update row color based on the new status
                            $el.closest('tr').classList.remove('active', 'inactive', 'released');
                            $el.closest('tr').classList.add(newStatus);
                        }

                        Swal.fire('Status Changed!', `The status of the prisoner has been updated to ${newStatus}.`, 'success');
                    } else {
                        // Log the failure
                        console.error(`Failed to change status for prisoner with ID ${prisonerId}.`);

                        Swal.fire('Error!', 'Failed to change the status.', 'error');
                    }
                })
                .catch(error => {
                    // Log the error
                    console.error('Error:', error);
                    Swal.fire('Error!', 'There was an error updating the status.', 'error');
                });
            }
        });
    });
});

// Handling account deletion
const deleteButtons = document.querySelectorAll('.action-delete');

deleteButtons.forEach(function($el) {
    $el.addEventListener('click', function(e) {
        e.preventDefault();
        const accountId = $el.getAttribute('data-id'); // Get account ID from data-id attribute

        // SweetAlert2 confirmation
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this account?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Make the AJAX request to delete the account
                fetch(`/accounts/${accountId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Log the successful deletion
                        console.log(`Account with ID ${accountId} deleted.`);

                        // Remove the row from the table
                        $el.closest('tr').remove();

                        Swal.fire('Deleted!', 'The account has been deleted.', 'success');
                    } else {
                        // Log the failure
                        console.error(`Failed to delete account with ID ${accountId}.`);

                        Swal.fire('Error!', 'Failed to delete the account.', 'error');
                    }
                })
                .catch(error => {
                    // Log the error
                    console.error('Error:', error);
                    Swal.fire('Error!', 'There was an error deleting the account.', 'error');
                });
            }
        });
    });
});


    const sidebarMenus = getAll('#sidebar ul li a');

    sidebarMenus.forEach(function($el) {
        $el.addEventListener('click', function() {
            const nextSibling = $el.nextElementSibling;

            if (!nextSibling) return;

            if (nextSibling.classList.contains('submenu')) {
                nextSibling.classList.toggle('is-block');
            }
        })
    });
}
