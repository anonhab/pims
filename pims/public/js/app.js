window.onload = function () {

    // Utility function to select all elements matching a selector
    function getAll(selector) {
        return Array.from(document.querySelectorAll(selector));
    }

    // Handle Navbar Burger Toggle
    const $navbarBurger = getAll('.navbar-burger');
    const $touchMenu = document.getElementById('touchMenu');
    if ($navbarBurger.length > 0) {
        $navbarBurger.forEach($el => {
            $el.addEventListener("click", event => {
                event.stopPropagation();
                $el.classList.toggle("is-active");
                $touchMenu.classList.toggle("is-active");
            });
        });
    }

    // Handle Dropdowns
    const $dropdowns = getAll(".dropdown:not(.is-hoverable)");
    if ($dropdowns.length > 0) {
        $dropdowns.forEach($el => {
            $el.addEventListener("click", event => {
                event.stopPropagation();
                $el.classList.toggle("is-active");
            });
        });

        document.addEventListener("click", closeDropdowns);
    }

    function closeDropdowns() {
        $dropdowns.forEach($el => {
            $el.classList.remove("is-active");
        });
    }

    // Fetch Notifications
    fetchNotifications();

    function fetchNotifications() {
        fetch('/notifications')
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.text().then(text => { throw new Error(text); });
                }
            })
            .then(data => {
                let notificationDropdown = document.getElementById("notification-dropdown");
                let notificationCount = document.getElementById("notification-count");

                notificationDropdown.innerHTML = '<div class="dropdown-content"></div>'; // Clear old notifications

                if (data.length === 0) {
                    notificationDropdown.innerHTML = `<div class="dropdown-item">No new notifications.</div>`;
                    notificationCount.style.display = 'none';
                } else {
                    notificationCount.style.display = 'inline-block';
                    notificationCount.textContent = data.length;

                    let dropdownContent = notificationDropdown.querySelector('.dropdown-content');

                    data.forEach(notification => {
                        let notificationItem = document.createElement('a');
                        notificationItem.classList.add('dropdown-item');
                        notificationItem.dataset.id = notification.id;
                        notificationItem.dataset.message = notification.message;
                        notificationItem.dataset.timestamp = new Date(notification.created_at).toLocaleString();

                        notificationItem.innerHTML = `
                            <strong>${notification.message}</strong>
                            <br><small>${new Date(notification.created_at).toLocaleString()}</small>
                        `;
                        dropdownContent.appendChild(notificationItem);

                        let divider = document.createElement('hr');
                        divider.classList.add('dropdown-divider');
                        dropdownContent.appendChild(divider);
                    });
                }
            })
            .catch(error => {
             
            });
    }
    setInterval(fetchNotifications, 1000); 
    // Handle Click Event for Notifications
    document.getElementById("notification-dropdown").addEventListener("click", function (event) {
        let notificationItem = event.target.closest('.dropdown-item');
        if (notificationItem) {
            let message = notificationItem.dataset.message;
            let timestamp = notificationItem.dataset.timestamp;
            let notificationId = notificationItem.dataset.id;

            document.getElementById("modal-message").innerHTML = `<strong>${message}</strong><br><small>${timestamp}</small>`;
            document.getElementById("notification-modal").classList.add("is-active");

            // Store ID for marking as read
            document.getElementById("mark-as-read").dataset.id = notificationId;
        }
    });

    // Mark as Read
    document.getElementById("mark-as-read").addEventListener("click", function () {
        let notificationId = this.dataset.id;

        fetch(`/notifications/read/${notificationId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ read: true })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => { throw new Error(text); });
            }
        })
        .then(data => {
            if (data.success) {
                document.getElementById("notification-modal").classList.remove("is-active");
                fetchNotifications(); // Refresh notifications
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
            alert('Error marking notification as read: ' + error.message);
        });
    });

    // Close Modal
    document.getElementById("close-modal").addEventListener("click", function () {
        document.getElementById("notification-modal").classList.remove("is-active");
    });

    document.querySelector(".modal-background").addEventListener("click", function () {
        document.getElementById("notification-modal").classList.remove("is-active");
    });

    // Handle logout
    const logoutButtons = document.querySelectorAll('.app-logout');
    logoutButtons.forEach(($el) => {
        $el.addEventListener('click', (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Your session will be ended!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, log me out!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/logout";
                }
            });
        });
    });

    // Handling status change
    const statusSelectors = document.querySelectorAll('.action-status');
    statusSelectors.forEach(function ($el) {
        $el.addEventListener('change', function (e) {
            const prisonerId = $el.getAttribute('data-id');
            const newStatus = $el.value;

            if (!prisonerId || !newStatus) return;

            Swal.fire({
                title: "Are you sure?",
                text: `You want to change the status of this prisoner to ${newStatus}!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, change it!"
            }).then((result) => {
                if (result.isConfirmed) {
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
                            const statusCell = $el.closest('tr').querySelector('.status-cell');
                            if (statusCell) {
                                statusCell.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                                $el.closest('tr').classList.remove('active', 'inactive', 'released');
                                $el.closest('tr').classList.add(newStatus);
                            }
                            Swal.fire('Status Changed!', `The status of the prisoner has been updated to ${newStatus}.`, 'success');
                        } else {
                            Swal.fire('Error!', 'Failed to change the status.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'There was an error updating the status.', 'error');
                    });
                }
            });
        });
    });

    // Handling account deletion
    const deleteButtons = document.querySelectorAll('.action-delete');
    deleteButtons.forEach(function ($el) {
        $el.addEventListener('click', function (e) {
            e.preventDefault();
            const accountId = $el.getAttribute('data-id');

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this account?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
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
                            $el.closest('tr').remove();
                            Swal.fire('Deleted!', 'The account has been deleted.', 'success');
                        } else {
                            Swal.fire('Error!', 'Failed to delete the account.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'There was an error deleting the account.', 'error');
                    });
                }
            });
        });
    });

    // Handle sidebar submenu toggle
    const sidebarMenus = getAll('#sidebar ul li a');
    sidebarMenus.forEach(function ($el) {
        $el.addEventListener('click', function () {
            const nextSibling = $el.nextElementSibling;
            if (nextSibling && nextSibling.classList.contains('submenu')) {
                nextSibling.classList.toggle('is-block');
            }
        });
    });

    // Password visibility toggle
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.classList.replace("bx-show", "bx-hide");
        } else {
            passwordInput.type = "password";
            togglePassword.classList.replace("bx-hide", "bx-show");
        }
    });

    // Auto-hide alert messages after 3 seconds
    const alertBox = document.getElementById("alert");
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.display = "none";
        }, 3000);
    }

    // Modal logic for forgot password
    const modal = document.getElementById("contact-admin-modal");
    const forgotPasswordLink = document.getElementById("forgot-password-link");
    const closeModal = document.getElementById("close-modal");
    const closeModalBtn = document.getElementById("close-modal-btn");

    forgotPasswordLink.addEventListener("click", function (event) {
        event.preventDefault();
        modal.style.display = 'flex';
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = 'none';
    });

    closeModalBtn.addEventListener("click", function () {
        modal.style.display = 'none';
    });
};
