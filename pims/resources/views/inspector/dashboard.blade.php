<!DOCTYPE html>
<html lang="en">
    <style>
    /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #1e293b;
    color: #e2e8f0;
    margin: 0;
    padding: 0;
}

/* Headings */
h1 {
    font-size: 30px;
    font-weight: 700;
    color: #f8fafc;
    margin-bottom: 20px;
}

/* Dashboard Overview Cards */
.dashboard-card {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    overflow: hidden;
    padding: 20px;
}

.dashboard-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.dashboard-card .card-header {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    opacity: 0.9;
}

.dashboard-card .card-body {
    font-size: 40px;
    text-align: center;
    font-weight: bold;
}

/* Quick Actions Section */
.card {
    background: #334155;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    overflow: hidden;
}

.card-header {
    background: #475569;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #f8fafc;
    text-transform: uppercase;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.card-body {
    padding: 20px;
}

.card-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.card-body ul li {
    padding: 12px 0;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.card-body ul li a {
    display: inline-block;
    color: #3b82f6;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.card-body ul li a:hover {
    color: #93c5fd;
    text-decoration: underline;
}

/* Assign Lawyer Section */
.assign-lawyer {
    background: #475569;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.assign-lawyer h2 {
    font-size: 22px;
    font-weight: bold;
    color: #f8fafc;
    margin-bottom: 15px;
}

.assign-lawyer form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.assign-lawyer label {
    font-weight: 600;
}

.assign-lawyer select, 
.assign-lawyer button {
    padding: 12px;
    font-size: 16px;
    border-radius: 6px;
    border: none;
    transition: 0.3s ease-in-out;
}

.assign-lawyer select {
    background: #1e293b;
    color: #e2e8f0;
    border: 1px solid #64748b;
}

.assign-lawyer button {
    background: #3b82f6;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.assign-lawyer button:hover {
    background: #1e40af;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-card, .card {
        margin-bottom: 15px;
    }

    .dashboard-card .card-body {
        font-size: 28px;
    }
}

    </style>

    @include('includes.head')

    <body>
        <!-- NAV -->
        @include('includes.nav')

        <div class="columns" id="app-content">
            <!-- Sidebar Menu -->
            @include('inspector.menu')

            <!-- Main Content -->
            <div class="column is-10" id="page-content">
                <section class="section">
                   
                    <div class="columns is-multiline">
                        <!-- Prisoners Card -->
                        <div class="column is-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Total Prisoners</p>
                                </div>
                                <div class="card-body">
                                    <p>125</p>
                                </div>
                            </div>
                        </div>

                        <!-- Lawyers Card -->
                        <div class="column is-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Total Lawyers</p>
                                </div>
                                <div class="card-body">
                                    <p>20</p>
                                </div>
                            </div>
                        </div>
                         <!-- Lawyers Card -->
                         <div class="column is-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Total Assigned Lawyers</p>
                                </div>
                                <div class="card-body">
                                    <p>20</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Section -->
                    <div class="columns">
                        <div class="column is-6">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Quick Actions</p>
                                </div>
                                <div class="card-body">
                                    <ul>
                                    <li><a href="{{ route('prisoner.add') }}">Add/Update Prisoner</a></li>
                                        <li><a href="{{ route('prisoner.show_allforin') }}">View Prisoner Profile</a></li>
                                      
                                        <li><a href="{{ route('lawyer.add') }}">Add/Update Lawyer Profile</a></li>
                                        <li><a href="{{ route('lawyer.lawyershowall') }}">View Lawyer Profiles</a></li>
                                        <li><a href="{{ route('assignments.view') }}">Assign Lawyer to Prisoner</a></li>
                                     </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer_js')
    </body>
</html>
