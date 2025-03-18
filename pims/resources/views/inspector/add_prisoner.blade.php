<!DOCTYPE html>
@include('includes.head')

<body>

    <!-- NAV -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">

            </div>

            {{-- Flash Messages --}}
            <div class="columns">
                <div class="column is-12">
                    {{-- Success Alert --}}
                    @if(session('success'))
                        <div class="notification is-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Alert --}}
                    @if(session('error'))
                        <div class="notification is-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Warning Alert --}}
                    @if(session('warning'))
                        <div class="notification is-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    {{-- Info Alert --}}
                    @if(session('info'))
                        <div class="notification is-info">
                            {{ session('info') }}
                        </div>
                    @endif
                </div>
            </div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Prisoner Registration</h1>
                    <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="{{ route('prisoner.showAll') }}">
                                    <span class="icon is-small">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <span>View Records</span>
                                </a>
                            </p>
                             
                        </div>
                    <form action="{{ route('prisoners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="columns">
                            <!-- Personal Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Personal Information</p>
                                        <div class="field">
                                            <!-- Prison dropdown -->
                                            <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">
                                        </div>

                                        <div class="field">
                                            <label class="label">First Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="first_name" placeholder="Enter first name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Middle Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="middle_name" placeholder="Enter middle name">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Last Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="last_name" placeholder="Enter last name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Birthday</label>
                                            <div class="control">
                                                <input class="input" type="date" name="dob" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Sex</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="sex" required>
                                                        <option value="Male" selected>Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Address</label>
                                            <div class="control">
                                                <textarea class="textarea" name="address" placeholder="Enter address" required></textarea>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Marital Status</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="marital_status" required>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Case Details -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Case Details</p>

                                        <div class="field">
                                            <label class="label">Crime Committed</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="crime_committed" required>
                                                        <option value="" disabled selected>Select Offense</option>
                                                        <option>Theft</option>
                                                        <option>Assault</option>
                                                        <option>Drug Possession</option>
                                                        <option>Fraud</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Status</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="status" required>
                                                        <option value="" disabled selected>Status</option>
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                        <option>Released</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="field">
                                            <label class="label">Time Serve Start</label>
                                            <div class="control">
                                                <input class="input" type="date" name="time_serve_start" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Time Serve Ends</label>
                                            <div class="control">
                                                <input class="input" type="date" name="time_serve_end" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Emergency Contact -->
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Emergency Contact</p>

                                        <div class="field">
                                            <label class="label">Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="emergency_contact_name" placeholder="Enter emergency contact name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Relation</label>
                                            <div class="control">
                                                <input class="input" type="text" name="emergency_contact_relation" placeholder="Enter relation" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Contact #</label>
                                            <div class="control">
                                                <input class="input" type="tel" name="emergency_contact_number" placeholder="Enter contact number" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Inmate Image Upload -->
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Inmate Image</p>
                                        <div class="field">
                                            <div class="file has-name is-fullwidth">
                                                <label class="file-label">
                                                    <input class="file-input" type="file" name="inmate_image" required>
                                                    <span class="file-cta">
                                                        <span class="file-icon">
                                                            <i class="fa fa-upload"></i>
                                                        </span>
                                                        <span class="file-label">
                                                            Upload Image…
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button class="button is-link" type="submit">Submit</button>
                                    </div>
                                    <div class="control">
                                        <button class="button is-light" type="reset">Reset</button>
                                    </div>
                                </div>
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
