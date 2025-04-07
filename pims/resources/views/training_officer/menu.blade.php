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

            <!-- <li class="has-submenu">
    <a href="#">
        <span class="icon">
            <i class="fa fa-user-check"></i>
        </span>
        Active Trainers
    </a>
    <ul class="submenu">
        <li><a href="#">View Job Trainer's Profile</a></li>
        <li><a href="#">View Program Trainers</a></li>
    </ul>
</li> -->


            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </span> Training Programs
                </a>
                <ul class="submenu">
                    
                    <li><a href="{{ route('training.viewTrainingPrograms') }}"> Training Programs</a></li>
                    <li><a href="{{ route('training.assignTrainingPrograms') }}">Assign Training Programs</a></li>
                    <li><a href="{{ route('training.viewassignedTrainingPrograms') }}">View Assigned Programs</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-briefcase"></i>
                    </span> Jobs
                </a>
                <ul class="submenu">
                <li><a href="{{ route('training.assignjobs') }}">Assign Jobs</a></li>
                    <li><a href="{{ route('training.viewJobs') }}">View Jobs</a></li>
                    
                </ul>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-certificate"></i>
                    </span> Certification Management
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('training.assignCertifications') }}">Assign Certification to Prisoner</a></li>
                    <li><a href="{{ route('training.viewCertifications') }}">View Certifications</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
