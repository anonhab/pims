<div class="column is-2 is-fullheight is-hidden-touch" id="sidebar">
    <aside class="menu">
        <ul class="menu-list">
            
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
                        <i class="fa fa-door-closed"></i>
                    </span> Room Allocation
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('room.show') }}">View Rooms</a></li>
                    <li><a href="{{ route('room.allocate') }}">Allocate room</a></li>
                    <li><a href="{{ route('room.assign') }}"> view allocations </a> </li>
                </ul>
            </li> 
        </ul>
    </aside>
</div>
