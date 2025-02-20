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
    const remove = getAll('.action-delete');

remove.forEach(function ($el) {
    $el.addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Remove the record or element from the DOM
                $el.closest('.record-item').remove(); // assuming each record is within a .record-item

                // Optionally, delete from the database or array
                // For example, using an API:
                // fetch('/delete-record', { method: 'DELETE', body: JSON.stringify({ id: recordId }) });
                
                Swal.fire('Deleted!', 'The record has been deleted.', 'success');
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
