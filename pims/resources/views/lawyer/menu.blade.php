<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            <li>
                <a href="{{ route('mylawyer.ldashboard') }}">
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
                    <li><a href="{{ route('mylawyer.myprisoners') }}">View Prisoner Profile</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span> Request
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('mylawyer.createrequest')}}">Create/Update Request</a></li>
                    <li><a href="{{ route('mylawyer.viewrequest') }}">View Requests</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-calendar"></i>
                    </span> Appointment 
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('mylawyer.createlegalappo') }}">Create/Update Appointment</a></li>
                    <li><a href="{{ route('mylawyer.viewappointment') }}">View Appointment Details</a></li>
                </ul>
            </li> 


         

        </ul>
    </aside>
</div>
