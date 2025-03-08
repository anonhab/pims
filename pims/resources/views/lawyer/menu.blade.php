<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            <li>
                <a href="/dashboard">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-user-check"></i>
                    </span> my prisoners
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('prisoner.showAll') }}">View Prisoner Profile</a></li>
                    <li><a href="/assign_room">Assign Prisoner to Room</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span> Request Management
                </a>
                <ul class="submenu">
                    <li><a href="/create_request">Create/Update Request</a></li>
                    <li><a href="/view_requests">View Requests</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-calendar"></i>
                    </span> Appointment Management
                </a>
                <ul class="submenu">
                    <li><a href="/create_appointment">Create/Update Appointment</a></li>
                    <li><a href="/view_appointments">View Appointment Details</a></li>
                </ul>
            </li>


         

        </ul>
    </aside>
</div>
