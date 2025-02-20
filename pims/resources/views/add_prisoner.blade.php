<!DOCTYPE html>
@include('includes.head')
    <body>
       
        <!--  NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('includes.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Add Prisoner</h4>        
    </div>

    
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Prisoner Registration</h1>
    
            <form>
                <div class="columns">
                    <!-- Personal Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p  class="title is-4">Personal Information</p>
    
                                <div class="field">
                                    <label class="label">First Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter first name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Middle Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter middle name">
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Last Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter last name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Birthday</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Sex</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
    
                                <div class="field">
                                    <label class="label">Address</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter address" required></textarea>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Marital Status</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
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
                                            <select required>
                                                <option value="">Select Offense</option>
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
                                    <label class="label">Time Serve Start</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Time Serve Ends</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
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
                                        <input class="input" type="text" placeholder="Enter emergency contact name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Relation</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter relation" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Contact #</label>
                                    <div class="control">
                                        <input class="input" type="tel" placeholder="Enter contact number" required>
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
                                            <input class="file-input" type="file" name="inmate-image" required>
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
                                <button class="button is-link">Submit</button>
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
