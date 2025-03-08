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
                    </span> Prisoner Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('prisoner.showAll') }}">View Prisoner Profile</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span> Process Request 
                </a>
                <ul class="submenu">
                    <li><a href="/create_request">Create/Update Request</a></li>
                    <li><a href="/view_requests">View Requests</a></li>
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
        </ul>
    </aside>
</div>
