<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    <!-- NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header"></div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Lawyer Appointment Management</h1>

                    <form action="{{ route('lawyer_appointments.store') }}" method="POST">
                        @csrf
                        <div class="columns">
                            <!-- Appointment Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Appointment Information</p>

                                        <div class="field">
                                            <label class="label">Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="prisoner_id" required>
                                                        <option value="">Select Prisoner</option>
                                                        @foreach($prisoners as $prisoner)
                                                            <option value="{{ $prisoner->id }}">{{ $prisoner->id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden field for lawyer_id -->
                                        <input type="hidden" name="lawyer_id" value="{{ session('lawyer_id') }}">

                                        <div class="field">
                                            <label class="label">Appointment Date</label>
                                            <div class="control">
                                                <input class="input" type="date" name="appointment_date" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Details -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Appointment Details</p>

                                        <div class="field">
                                            <label class="label">Notes</label>
                                            <div class="control">
                                                <textarea class="textarea" name="notes" placeholder="Enter appointment notes" required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Submit</button>
                            </div>
                            <div class="control">
                                <button class="button is-light" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    @include('includes.footer_js')
</body>
</html>
