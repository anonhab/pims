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

   
// Fetch Notifications and Update Bell Badge
document.getElementById("pimsNotificationBell").addEventListener("click", function () {
    fetchNotifications();
    document.getElementById("notification-modal").classList.add("is-active");
});

function fetchNotifications() {
    fetch('/notifications')
        .then(response => response.ok ? response.json() : response.text().then(text => { throw new Error(text); }))
        .then(data => {
            let notificationList = document.getElementById("notification-list");
            let notificationBadge = document.querySelector(".pims-notification-badge");
            notificationList.innerHTML = ""; // Clear previous notifications
            
            let unreadCount = data.filter(notification => !notification.read).length;
            if (unreadCount > 0) {
                notificationBadge.textContent = unreadCount;
                notificationBadge.style.display = "inline-block";
            } else {
                notificationBadge.style.display = "none";
            }
            
            if (data.length === 0) {
                notificationList.innerHTML = "<p class='has-text-centered'>No new notifications.</p>";
            } else {
                data.forEach(notification => {
                    let notificationItem = document.createElement("div");
                    notificationItem.classList.add("notification-item", "box", "mb-3");
                    notificationItem.dataset.id = notification.id;
                    
                    let timeAgo = getTimeAgo(new Date(notification.created_at));
                    
                    notificationItem.innerHTML = `
                        <div class="media">
                            <div class="media-content">
                                <p><strong>${notification.message}</strong></p>
                                <small class="has-text-grey">${timeAgo}</small>
                            </div>
                            <div class="media-right">
                                <button class="button is-small is-light mark-as-read" data-id="${notification.id}">✓</button>
                            </div>
                        </div>
                    `;
                    notificationList.appendChild(notificationItem);
                });
            }
        })
        .catch(error => console.error("Error fetching notifications:", error));
}

// Convert timestamp to "time ago" format
function getTimeAgo(timestamp) {
    const now = new Date();
    const seconds = Math.floor((now - timestamp) / 1000);
    
    if (seconds < 60) return `${seconds} seconds ago`;
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return `${minutes} minutes ago`;
    const hours = Math.floor(minutes / 60);
    if (hours < 24) return `${hours} hours ago`;
    const days = Math.floor(hours / 24);
    if (days < 7) return `${days} days ago`;
    const weeks = Math.floor(days / 7);
    if (weeks < 4) return `${weeks} weeks ago`;
    const months = Math.floor(days / 30);
    if (months < 12) return `${months} months ago`;
    const years = Math.floor(days / 365);
    return `${years} years ago`;
}

// Handle Click Event for Marking Notifications as Read
document.getElementById("notification-list").addEventListener("click", function (event) {
    if (event.target.classList.contains("mark-as-read")) {
        let notificationId = event.target.dataset.id;
        markNotificationAsRead(notificationId);
    }
});

// Mark a Notification as Read
function markNotificationAsRead(notificationId) {
    fetch(`/notifications/read/${notificationId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ read: true })
    })
    .then(response => response.ok ? response.json() : response.text().then(text => { throw new Error(text); }))
    .then(data => {
        if (data.success) {
            fetchNotifications(); // Refresh notifications
        }
    })
    .catch(error => {
        console.error('Error marking notification as read:', error);
        alert('Error marking notification as read: ' + error.message);
    });
}

// Mark All as Read
document.getElementById("mark-all-as-read").addEventListener("click", function () {
    fetch(`/notifications/read-all`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.ok ? response.json() : response.text().then(text => { throw new Error(text); }))
    .then(data => {
        if (data.success) {
            fetchNotifications(); // Refresh notifications
        }
    })
    .catch(error => {
        console.error('Error marking all notifications as read:', error);
        alert('Error marking all notifications as read: ' + error.message);
    });
});

// Close Modal
document.getElementById("close-modal").addEventListener("click", function () {
    document.getElementById("notification-modal").classList.remove("is-active");
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
