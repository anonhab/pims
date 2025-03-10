<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <!-- Add any header content here -->
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-filter">
                        <!-- Search and other controls -->
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="table-search" type="text" placeholder="Search for records...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <div class="select">
                                <select id="table-length">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>

                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="#">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Create Record</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button" id="table-reload">
                                    <span class="icon is-small">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="card-content">
                        <!-- Card Layout Section for Lawyer Appointments -->
                        <div class="columns is-multiline">
                            @foreach($lawyerAppointments as $appointment)
                            <div class="column is-12-mobile is-6-tablet is-4-desktop">
                                <div class="card has-shadow">
                                    <div class="card-content">
                                        <p class="title is-5">
                                            Lawyer Appointment for {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->last_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Lawyer:</strong> {{ $appointment->lawyer->first_name }} {{ $appointment->lawyer->last_name }}
                                        </p>

                                        <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</p>

                                        <div class="field">
                                            <span class="tag 
                                                {{ $appointment->status == 'completed' ? 'is-success' : 
                                                   ($appointment->status == 'scheduled' ? 'is-warning' : 'is-danger') }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="buttons is-small is-centered">
                                            <a href="#" class="button is-rounded is-text">
                                                <span class="icon"><i class="fa fa-edit"></i></span>
                                                <span>Edit</span>
                                            </a>

                                            <a href="#" class="button is-danger is-rounded action-delete" data-id="{{ $appointment->id }}">
                                                <span class="icon"><i class="fa fa-trash"></i></span>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')

</body>

</html>
