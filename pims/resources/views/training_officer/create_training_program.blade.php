<!DOCTYPE html>
@include('includes.head')
    <body>
        
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('includes.menu')
            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Create Training Program</h4>        
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Training Program Management</h1>
    
            <form>
                <div class="columns">
                    <!-- Training Program Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Training Program Information</p>
    
                                <div class="field">
                                    <label class="label">Program Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter program name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Description</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Enter description of the training program" required></textarea>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Created By</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Training Officer</option>
                                                <option>Officer 1</option>
                                                <option>Officer 2</option>
                                                <option>Officer 3</option>
                                                <!-- Dynamically populate this list with training officers -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
                    <!-- Program Details -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Program Details</p>
    
                                <div class="field">
                                    <label class="label">Program Start Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Program End Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Program Location</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter location of the program" required>
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
