<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    <!-- NAV -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h1 class="title has-text-centered">View Lawyer Appointments</h1>
            </div>

            <section class="section">
                <div class="container">
                    <!-- Appointment Cards -->
                    <div class="columns is-multiline">
                        @foreach($appointments as $appointment)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-header-title">Appointment #{{ $appointment->id }}</p>
                                    </div>
                                    <div class="card-content">
                                        <div class="content">
                                            <p><strong>Prisoner Name:</strong> {{ $appointment->prisoner->name }}</p>
                                            <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                                            <p><strong>Notes:</strong> {{ $appointment->notes }}</p>
                                            <p><strong>Status:</strong> 
                                                @if($appointment->status == 'confirmed')
                                                    <span class="has-text-success">Confirmed</span>
                                                @else
                                                    <span class="has-text-danger">Pending</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    <div class="pagination is-centered" role="navigation" aria-label="pagination">
                        <!-- Previous Button -->
                        <a class="pagination-previous {{ $appointments->currentPage() > 1 ? '' : 'is-disabled' }}" 
                           href="{{ $appointments->previousPageUrl() ?? '#' }}">
                            Previous
                        </a>

                        <!-- Next Button -->
                        <a class="pagination-next {{ $appointments->hasMorePages() ? '' : 'is-disabled' }}" 
                           href="{{ $appointments->nextPageUrl() ?? '#' }}">
                            Next
                        </a>

                        <!-- Page Numbers -->
                        <ul class="pagination-list">
                            @foreach($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                            <li>
                                <a class="pagination-link {{ $page == $appointments->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>
