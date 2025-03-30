<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            <li>
                <a href="{{ route('cadmin.dashboard') }}">
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
           
                    <li><a href="{{ route('cprisoner.showAll') }}">View Prisoner Profile</a></li>
                  
                </ul>
            </li>       
            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-chart-line"></i>
                    </span> Report Generation
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('cadmin.generate') }}">Generate Report</a></li>
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
        

           
        </ul>
    </aside>
</div>
