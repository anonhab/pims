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
                        <i class="fa fa-users"></i>
                    </span> Visitor Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('security.registerVisitor') }}">Register Visitor</a></li>
                    <li><a href="{{ route('security_officer.viewvisitors') }}">View Visitors</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-calendar"></i>
                    </span> Appointment Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('security.viewAppointments') }}">View Appointments</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-user-check"></i>
                    </span> Prisoner Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('security.viewPrisoners') }}">View Prisoner Profile</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
