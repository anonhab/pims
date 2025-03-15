<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    <!--  NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">

        @include('inspector.menu')
        <div class="column is-10" id="page-content">
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
            <div class="content-header">
            </div>
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Lawyer Management</h1>

                    <form method="POST" action="{{ route('lawyers.lstore') }}">
    @csrf

    <div class="columns">
        
        <!-- Lawyer Profile Information -->
        <div class="column is-half">
            <div class="card">
                <div class="card-content">
                    <p class="title is-4">Lawyer Profile</p>

                    <!-- Personal Information -->
                    <div class="field">
                        <label class="label">First Name</label>
                        <div class="control">
                            <input class="input" type="text" name="first_name" placeholder="Enter first name" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Last Name</label>
                        <div class="control">
                            <input class="input" type="text" name="last_name" placeholder="Enter last name" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Date of Birth</label>
                        <div class="control">
                            <input class="input" type="date" name="date_of_birth" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Contact Information</label>
                        <div class="control">
                            <input class="input" type="text" name="contact_info" placeholder="Enter lawyer's contact information" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email Address</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="Enter email address" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" type="password" name="password" placeholder="Enter password" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Law Firm</label>
                        <div class="control">
                            <input class="input" type="text" name="law_firm" placeholder="Enter law firm name">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">License Number</label>
                        <div class="control">
                            <input class="input" type="text" name="license_number" placeholder="Enter lawyer's license number" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Cases Handled</label>
                        <div class="control">
                            <input class="input" type="number" name="cases_handled" placeholder="Enter number of cases handled" required>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        

    </div>

    <!-- Submit and Reset Button -->
    <div class="field is-grouped is-grouped-right">
        <div class="control">
            <button class="button is-link" type="submit">Assign Lawyer</button>
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