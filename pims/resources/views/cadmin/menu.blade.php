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
                    </span> Role Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('roles.addrole') }}">Add Role</a></li>
                    <li><a href="{{ route('roles.index') }}">View Roles</a></li>
                </ul>
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
           
                    <li><a href="{{ route('cprisoner.showAll') }}">View Prisoner Profile</a></li>
                    <li><a href="/view_jobs">View  Job Assignments</a></li>
                    <li><a href="/view_training_programs">View Training Programs</a></li>
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
                    </span> Backup and Recovery
                </a>
                <ul class="submenu">
                    <li><a href="/initiate_backup">Initiate Backup</a></li>
                    <li><a href="/view_backup_recovery_logs">View Backup/Recovery Logs</a></li>
                </ul>
            </li>


            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-building"></i>
                    </span> Prison Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('prison.add') }}">Add/Update Prison</a></li>
                    <li><a href="{{ route('prison.view') }}">View Prison Details</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-clock"></i>
                    </span> Visiting Time Requests
                </a>
                <ul class="submenu">
                
                    <li><a href="/view_visiting_time_requests">View Requests</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
