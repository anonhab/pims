<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    
    <!--   NAV -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('includes.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Add Prison</h4>
            </div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Prison Management</h1>

                    <form>
                        <div class="columns">
                            <!-- Prison Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Prison Information</p>

                                        <div class="field">
                                            <label class="label">Prison Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter prison name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Location</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Location</option>
                                                        <option value="New York">New York</option>
                                                        <option value="Los Angeles">Los Angeles</option>
                                                        <option value="Chicago">Chicago</option>
                                                        <option value="Houston">Houston</option>
                                                        <option value="Phoenix">Phoenix</option>
                                                        <option value="Philadelphia">Philadelphia</option>
                                                        <option value="San Antonio">San Antonio</option>
                                                        <option value="San Diego">San Diego</option>
                                                        <!-- Add more locations as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="field">
                                            <label class="label">Capacity</label>
                                            <div class="control">
                                                <input class="input" type="number" placeholder="Enter capacity" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Managed By</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Officer</option>
                                                        <option>Super Admin</option>
                                                        <option>System Admin</option>
                                                        <option>Manager A</option>
                                                        <option>Manager B</option>
                                                        <!-- Dynamically populate this list with prison officers -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information (Optional) -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Additional Information</p>

                                        <div class="field">
                                            <label class="label">Phone Number</label>
                                            <div class="control">
                                                <input class="input" type="tel" placeholder="Enter contact phone number" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email Address</label>
                                            <div class="control">
                                                <input class="input" type="email" placeholder="Enter email address" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Additional Notes</label>
                                            <div class="control">
                                                <textarea class="textarea" placeholder="Enter any additional notes or information"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Save Prison</button>
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