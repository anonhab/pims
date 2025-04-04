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
                        <i class="fa fa-calendar"></i>
                    </span> Appointment Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('medical.createAppointment') }}">Create Appointment </a></li>
                    <li><a href="{{ route('medical.viewAppointments') }}">View Appointment Details</a></li>
                </ul>
               
                
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-stethoscope"></i>
                    </span> Medical Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('medical.createReport') }}">Create/Update Medical Report</a></li>
                    <li><a href="{{ route('medical.viewReports') }}">View Medical Reports</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
