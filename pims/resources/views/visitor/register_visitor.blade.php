<!DOCTYPE html>
@include('includes.head')
    <body>
       
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('visitor.menu')

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Register Visitor <h4>        
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Visitor Registration <h1>
    
            <form>
                <div class="columns">
                    <!-- Personal Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Personal Information</p>
    
                                <div class="field">
                                    <label class="label">Visitor's Full Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter visitor's full name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Date of Birth</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Gender</label>
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
                                    <label class="label">Contact Information</label>
                                    <div class="control">
                                        <input class="input" type="tel" placeholder="Enter visitor's contact number" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Email Address</label>
                                    <div class="control">
                                        <input class="input" type="email" placeholder="Enter email address" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Home Address</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter home address" required></textarea>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Relationship to Prisoner</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter relationship to prisoner" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Submit and Reset Buttons -->
                <div class="field is-grouped is-grouped-left">
                    <div class="control">
                        <button class="button is-link">Register Visitor</button>
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
