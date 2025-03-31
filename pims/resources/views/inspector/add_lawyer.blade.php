<!DOCTYPE html>
<html lang="en">
    @include('includes.head')

    <body>
        @include('includes.nav')

        <div class="columns" id="app-content">
            @include('inspector.menu')

            <div class="column is-10" id="page-content">
                

                <section class="section">
                    <div class="container">
                        <div class="box">
                            <h2 class="title is-4">Register Lawyer</h2>
                            <hr>

                            <form method="POST" action="{{ route('lawyers.lstore') }}">
                                @csrf

                                <div class="columns is-multiline">
                                    <!-- Left Column -->
                                    <div class="column is-half">
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
                                                <input class="input" type="text" name="contact_info" placeholder="Enter contact details" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email Address</label>
                                            <div class="control">
                                                <input class="input" type="email" name="email" placeholder="Enter email address" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="column is-half">
                                        <div class="field">
                                            <label class="label">Password</label>
                                            <div class="control">
                                                <input class="input" type="password" name="password" placeholder="Enter password" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Law Firm</label>
                                            <div class="control">
                                                <input class="input" type="text" name="law_firm" placeholder="Enter law firm">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">License Number</label>
                                            <div class="control">
                                                <input class="input" type="text" name="license_number" placeholder="Enter license number" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Cases Handled</label>
                                            <div class="control">
                                                <input class="input" type="number" name="cases_handled" placeholder="Enter cases handled" required>
                                            </div>
                                        </div>

                                        <input type="hidden" name="prison" value="{{ session('prison_id') }}">
                                    </div>
                                </div>

                                <!-- Submit and Reset Buttons -->
                                <div class="field is-grouped is-grouped-right">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">Save Lawyer</button>
                                    </div>
                                    <div class="control">
                                        <button class="button is-light" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer_js')
    </body>
</html>
