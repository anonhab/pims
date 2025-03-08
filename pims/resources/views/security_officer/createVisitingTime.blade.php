<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    
    <!--   NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('security_officer.menu')
        <div class="column is-10" id="page-content">
            <div class="content-header">
            </div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Visiting Time Requests</h1>

                    <form>
                        <div class="columns">
                            <!-- Visitor Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Visitor Information</p>

                                        <div class="field">
                                            <label class="label">Visitor Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter visitor's name"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Contact Information</label>
                                            <div class="control">
                                                <input class="input" type="tel"
                                                    placeholder="Enter visitor's contact number" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Relationship to Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Relationship</option>
                                                        <option value="Family">Family</option>
                                                        <option value="Friend">Friend</option>
                                                        <option value="Lawyer">Lawyer</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Prisoner Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Prisoner Information</p>

                                        <div class="field">
                                            <label class="label">Select Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Prisoner</option>
                                                        <option value="Prisoner 1">Prisoner 1</option>
                                                        <option value="Prisoner 2">Prisoner 2</option>
                                                        <option value="Prisoner 3">Prisoner 3</option>
                                                        <option value="Prisoner 4">Prisoner 4</option>
                                                        <!-- Dynamically populate this list with prisoners -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Requested Visiting Date</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Requested Visiting Time</label>
                                            <div class="control">
                                                <input class="input" type="time" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Status</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Submit Request</button>
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