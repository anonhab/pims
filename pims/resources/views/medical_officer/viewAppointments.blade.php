<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('medical_officer.menu')

        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                <span class="icon mr-2"><i class="fas fa-notes-medical"></i></span>
                                Appointment Records
                            </p>
                        </header>

                        <div class="card-content">
                            <!-- Filter/Search Controls -->
                            <div class="columns is-variable is-1 is-multiline mb-4">
                                <div class="column is-6-tablet is-4-desktop">
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <input class="input" id="table-search" type="text" placeholder="Search appointments...">
                                            <span class="icon is-left">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-3-tablet is-2-desktop">
                                    <div class="field">
                                        <div class="select is-fullwidth">
                                            <select id="table-length">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-tablet is-6-desktop has-text-right">
                                    <div class="buttons is-right">
                                        <a class="button is-success" href="#">
                                            <span class="icon is-small"><i class="fa fa-plus"></i></span>
                                            <span>Create Record</span>
                                        </a>
                                        <a class="button is-light" id="table-reload">
                                            <span class="icon is-small"><i class="fa fa-sync-alt"></i></span>
                                            <span>Reload</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointments Card Grid -->
                            <div class="columns is-multiline">
                                @foreach($appointments as $appointment)
                                    <div class="column is-6">
                                        <div class="card has-shadow">
                                            <header class="card-header">
                                                <p class="card-header-title is-size-6">
                                                    <span class="icon mr-2 has-text-primary"><i class="fas fa-calendar-check"></i></span>
                                                    Appointment #{{ $appointment->id }} – 
                                                    <span class="tag ml-2 is-rounded 
                                                        {{ $appointment->status === 'pending' ? 'is-warning' : ($appointment->status === 'completed' ? 'is-success' : 'is-info') }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </p>
                                            </header>

                                            <div class="card-content">
                                                <div class="content">
                                                    <p><strong>Prisoner:</strong> {{ $appointment->prisoner ? $appointment->prisoner->first_name . ' ' . $appointment->prisoner->last_name : 'N/A' }}</p>
                                                    <p><strong>Doctor:</strong> {{ $appointment->doctor ? $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'N/A' }}</p>
                                                    <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                                                    <p><strong>Diagnosis:</strong> {{ $appointment->diagnosis }}</p>
                                                    <p><strong>Treatment:</strong> {{ $appointment->treatment }}</p>
                                                    <p><strong>Created By:</strong> {{ $appointment->createdBy ? $appointment->createdBy->first_name . ' ' . $appointment->createdBy->last_name : 'N/A' }}</p>
                                                    <p><small class="has-text-grey">Created: {{ $appointment->created_at }}</small></p>
                                                    <p><small class="has-text-grey">Updated: {{ $appointment->updated_at }}</small></p>
                                                </div>
                                            </div>

                                            <footer class="card-footer">
                                                <a href="#" class="card-footer-item has-text-info">View</a>
                                                <a href="#" class="card-footer-item has-text-warning">Edit</a>
                                                <a href="#" class="card-footer-item has-text-danger">Delete</a>
                                            </footer>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if($appointments->isEmpty())
                                <div class="notification is-warning is-light has-text-centered mt-4">
                                    No appointments found.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
</body>

</html>
