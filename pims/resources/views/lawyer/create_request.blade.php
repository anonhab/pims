<!DOCTYPE html>
@include('includes.head')
    <body>
      
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('lawyer.menu')

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Create Request</h4>        
    </div>

    
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Request Management</h1>
    
            <form>
                <div class="columns">
                    <!-- Request Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Request Information</p>
    
                                <div class="field">
                                    <label class="label">Prisoner</label>
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
                                    <label class="label">Request Type</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Request Type</option>
                                                <option>Visiting Time</option>
                                                <option>Medical Assistance</option>
                                                <option>Legal Aid</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
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
    
                                <div class="field">
                                    <label class="label">Date of Request</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
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
                                        <textarea class="textarea" placeholder="Provide details about the request" required></textarea>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Requested By</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Requestor</option>
                                                <option>Admin</option>
                                                <option>Inspector</option>
                                                <option>Prisoner</option>
                                                <!-- Dynamically populate this list with requestor roles -->
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
