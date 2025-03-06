<!DOCTYPE html>
<html>
@include('includes.head')
<body>
    <!--  NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('inspector.menu')
        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Add Lawyer</h4>
            </div>
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Lawyer Management</h1>

                    <form>
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
                                                <input class="input" type="text" placeholder="Enter first name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Last Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter last name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Date of Birth</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Contact Information</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter lawyer's contact information" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email Address</label>
                                            <div class="control">
                                                <input class="input" type="email" placeholder="Enter email address" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Law Firm</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter law firm name">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">License Number</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter lawyer's license number" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Cases Handled</label>
                                            <div class="control">
                                                <input class="input" type="number" placeholder="Enter number of cases handled" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Lawyer Assignment Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Assign Lawyer to Prisoner</p>

                                        <div class="field">
                                            <label class="label">Select Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Prisoner</option>
                                                        <option>John Doe</option>
                                                        <option>Jane Smith</option>
                                                        <option>Michael Johnson</option>
                                                        <!-- Dynamically populate this list with prisoners -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Lawyer Assignment Date</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Assigned By</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Admin</option>
                                                        <option>Admin 1</option>
                                                        <option>Admin 2</option>
                                                        <option>Admin 3</option>
                                                        <!-- Dynamically populate this list with admins -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Assign Lawyer</button>
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