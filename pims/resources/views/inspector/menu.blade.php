<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            <li>
                <a href="/idashboard">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Dashboard
                </a>
            </li>

          
            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-user-check"></i>
                    </span> Prisoners
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('prisoner.add') }}">Add/Update Prisoner</a></li>
                    <li><a href="{{ route('prisoner.show_allforin') }}">View Prisoner Profile</a></li>
                
                </ul>
            </li>
            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span> Assign Police   Requests 
                </a>
                <ul class="submenu">
          
                    <li><a href="{{ route('view.requests') }}">View Requests</a></li>
                </ul>
            </li>  -->


            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span>  Requests 
                </a>
                <ul class="submenu">
          
                    <li><a href="{{ route('view.requests') }}">View Requests</a></li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-calendar"></i>
                    </span> Appointments 
                </a>
                <ul class="submenu">
                  
                    <li><a href="{{ route('view.appointments') }}">View medical Appointment </a></li>
                    <li><a href="{{ route('lawyer.appointments') }}">View legal Appointment </a></li>
                </ul>
            </li> -->

            

            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-users"></i>
                    </span> Visitors 
                </a>
                <ul class="submenu">
                    <li><a href="/view_visitor_registrations">View Visitor Registrations</a></li>
                    <li><a href="/view_visiting_time_requests">View Requests</a></li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </span>  Programs
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('inspector.viewJobs') }}">View Prisoner Job Assignmentss</a></li>
                    <li><a href="{{ route('inspector.viewTrainingPrograms') }}">View Training Programs</a></li>
                </ul>
            </li>   -->

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-gavel"></i>
                    </span> Lawyer Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('lawyer.add') }}">Add/Update Lawyer Profile</a></li>
                    <li><a href="{{ route('lawyer.lawyershowall') }}">View Lawyer Profiles</a></li>
                    <li><a href="{{ route('assignments.view') }}">Assign Lawyer to Prisoner</a></li>
                </ul>
            </li>

            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-door-closed"></i>
                    </span> Room Allocation
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('room.show') }}">View Rooms</a></li>
                    <li><a href="{{ route('room.allocate') }}">Allocate room</a></li>
                    <li><a href="{{ route('room.assign') }}"> view allocations </a> </li>
                </ul>
            </li> -->
        </ul>
    </aside>
</div>
