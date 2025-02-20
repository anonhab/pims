<!DOCTYPE html>
@include('includes.head')
    <body>
         
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('includes.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Create Medical Report</h4>        
    </div>

    
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Medical Report Management</h1>
    
            <form>
                <div class="columns">
                    <!-- Report Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Report Information</p>
    
                                <div class="field">
                                    <label class="label">Appointment</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Appointment</option>
                                                <option>Appointment 1</option>
                                                <option>Appointment 2</option>
                                                <option>Appointment 3</option>
                                                <!-- Dynamically populate this list with appointments -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Medical Officer</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Medical Officer</option>
                                                <option>Dr. Sarah Williams</option>
                                                <option>Dr. James Brown</option>
                                                <option>Dr. Olivia Davis</option>
                                                <!-- Dynamically populate this list with medical officers -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Report Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
                    <!-- Medical Report Details -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Report Details</p>
    
                                <div class="field">
                                    <label class="label">Findings</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter the findings from the medical examination" required></textarea>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Recommendations</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter any recommendations for treatment or care" required></textarea>
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
