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


                        
                    </div>

                    <div class="card-content">
                        <!-- Card Layout Section -->
                        <div class="columns is-multiline">
                            @foreach($appointments as $appointment)
                            <div class="column is-12-mobile is-6-tablet is-4-desktop">
                                <div class="card has-shadow">
                                    <div class="card-content">
                                        <p class="title is-5">
                                            Appointment for {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->last_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Medical Officer:</strong> {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                                        </p>

                                        <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                                        <p><strong>Diagnosis:</strong> {{ $appointment->diagnosis }}</p>
                                        <p><strong>Treatment:</strong> {{ $appointment->treatment }}</p>

                                        <div class="field">
                                            <span class="tag 
                                                {{ $appointment->status == 'Completed' ? 'is-success' : 
                                                   ($appointment->status == 'Pending' ? 'is-warning' : 'is-danger') }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
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
