<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            <!-- Dashboard Link -->
            <li>
                <a href="/dashboard">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Dashboard
                </a>
            </li>

            <!-- Request Management Menu -->
            <li class="has-submenu">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-clipboard-list"></i>
                    </span>
                    Request Management
                </a>
                <ul class="submenu">
                    <li><a href="/discipline_officer/view_requests">View Requests</a></li>
                    <li><a href="{{ route('discipline_officer.evaluate_request') }}">Evaluate Request</a></li>

                </ul>
            </li>

            <!-- Disciplinary Actions Menu -->
            <li class="has-submenu">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-user-shield"></i>
                    </span> Disciplinary Actions
                </a>
                <ul class="submenu">
                    <li><a href="/discipline_officer/assign_penalty">Assign Penalty</a></li>
                    <li><a href="/discipline_officer/view_penalties">View Penalties</a></li>
                </ul>
            </li>

            <!-- Reports & Logs Menu -->
            <li class="has-submenu">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-file-alt"></i>
                    </span> Reports & Logs
                </a>
                <ul class="submenu">
                    <li><a href="/discipline_officer/generate_reports">Generate Reports</a></li>
                    <li><a href="/discipline_officer/view_logs">View Logs</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
