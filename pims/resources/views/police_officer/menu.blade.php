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
                    <li><a href="{{ route('police.viewPrisoners') }}">View Prisoner Profile</a></li>
                    <li><a href="{{ route('police.allocateRoom') }}">Assign Prisoner to Room</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span> Request Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('police.createRequest') }}">Create/Update Request</a></li>
                    <li><a href="{{ route('police.viewRequests') }}">View Requests</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-door-closed"></i>
                    </span> Room Allocation
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('police.allocateRoom') }}">Allocate Room to Prisoner</a></li>
                    <li><a href="{{ route('police.viewRoomAllocations') }}">View Room Allocations</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
