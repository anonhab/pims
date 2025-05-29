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
                        <i class="fa fa-user"></i>
                    </span> Account Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('account.add') }}">Create Account</a></li>
                    <li><a href="{{ route('account.show_all') }}">View Account Details</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-user-check"></i>
                    </span> Prisoner Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('prisoner.add') }}">Add/Update Prisoner</a></li>
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

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-stethoscope"></i>
                    </span> Medical Management
                </a>
                <ul class="submenu">
                    <li><a href="/create_medical_report">Create/Update Medical Report</a></li>
                    <li><a href="/view_medical_reports">View Medical Reports</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-users"></i>
                    </span> Visitor Registration
                </a>
                <ul class="submenu">
                    <li><a href="/register_visitor">Register Visitor</a></li>
                    <li><a href="/view_visitor_registrations">View Visitor Registrations</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </span> Training Programs
                </a>
                <ul class="submenu">
                    <li><a href="/create_training_program">Create/Update Training Program</a></li>
                    <li><a href="/view_training_programs">View Training Programs</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-briefcase"></i>
                    </span> Job Management
                </a>
                <ul class="submenu">
                    <li><a href="/assign_job">Assign Job to Prisoner</a></li>
                    <li><a href="/view_jobs">View Prisoner Job Assignments</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-certificate"></i>
                    </span> Certification Management
                </a>
                <ul class="submenu">
                    <li><a href="/assign_certification">Assign Certification to Prisoner</a></li>
                    <li><a href="/view_certifications">View Certifications</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-chart-line"></i>
                    </span> Report Generation
                </a>
                <ul class="submenu">
                    <li><a href="/generate_report">Generate Report</a></li>
                    <li><a href="/view_reports">View Generated Reports</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-database"></i>
                    </span> Backup   
                </a>
                <ul class="submenu">
                    <li><a href="/initiate_backup">Initiate Backup</a></li>
                    <li><a href="/view_backup_recovery_logs">View Backup Logs</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-gavel"></i>
                    </span> Lawyer Management
                </a>
                <ul class="submenu">
                    <li><a href="/add_lawyer">Add/Update Lawyer Profile</a></li>
                    <li><a href="/view_lawyers">View Lawyer Profiles</a></li>
                    <li><a href="/assign_lawyer">Assign Lawyer to Prisoner</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-door-closed"></i>
                    </span> Room Allocation
                </a>
                <ul class="submenu">
                    <li><a href="/allocate_room">Allocate Room to Prisoner</a></li>
                    <li><a href="/view_room_allocations">View Room Allocations</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-building"></i>
                    </span> Prison Management
                </a>
                <ul class="submenu">
                    <li><a href="/add_prison">Add/Update Prison</a></li>
                    <li><a href="/view_prison">View Prison Details</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-clock"></i>
                    </span> Visiting Time Requests
                </a>
                <ul class="submenu">
                    <li><a href="/create_visiting_time_request">Create/Update Request</a></li>
                    <li><a href="/view_visiting_time_requests">View Requests</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
