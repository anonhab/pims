<!DOCTYPE html>
@include('includes.head')
    <body>
         
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('training_officer.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Assign Job</h4>        
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Job Management</h1>
    
            <form>
                <div class="columns">
                    <!-- Job Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Job Information</p>
    
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
                                    <label class="label">Job Title</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Job Title</option>
                                                <option>Cleaner</option>
                                                <option>Cook</option>
                                                <option>Gardener</option>
                                                <option>Maintenance Worker</option>
                                                <option>Other</option>
                                                <!-- Dynamically populate this list with job titles -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Assigned By</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Assigning Officer</option>
                                                <option>Officer 1</option>
                                                <option>Officer 2</option>
                                                <option>Officer 3</option>
                                                <!-- Dynamically populate this list with officers -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
                    <!-- Job Assignment Details -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Assignment Details</p>
    
                                <div class="field">
                                    <label class="label">Assignment Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Additional Notes</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter any additional notes or details about the job assignment"></textarea>
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
