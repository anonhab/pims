<!DOCTYPE html>
@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h1 class="title has-text-centered">Request Management</h1>
            </div>

            <section class="section">
                <div class="container">
                    @if(session('success'))
                    <div class="notification is-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf
                        <div class="columns">
                            <!-- Request Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Request Information</p>

                                        <!-- Prisoner Selection -->
                                        <div class="field">
                                            <label class="label">Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="prisoner_id" required>
                                                        <option value="">Select Prisoner</option>
                                                        @foreach ($prisoners as $prisoner)
                                                        <option value="{{ $prisoner->id }}">
                                                            {{ $prisoner->first_name }} {{ $prisoner->last_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Request Type -->
                                        <div class="field">
                                            <label class="label">Request Type</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="request_type" required>
                                                        <option value="">Select Request Type</option>
                                                        
                                                        <option value="backup">Legal assistance</option>
                                                        <option value="report">Medical assistance </option>
                                                        <option value="prison_transfer">Prison Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Approved By (Optional) -->

                                        <input class="hidden" type="hidden" name="approved_by">


                                        <!-- Hidden Status -->
                                        <input type="hidden" name="status" value="pending">
                                    </div>
                                </div>
                            </div>

                            <!-- Request Details -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Request Details</p>

                                        <div class="field">
                                            <label class="label">Request Description</label>
                                            <div class="control">
                                                <textarea class="textarea" name="request_details" placeholder="Provide details about the request" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Hidden Requester IDs -->
                                        <input type="hidden" name="lawyer_id" value="{{ session('lawyer_id') }}">
                                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link" type="submit">Submit</button>
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