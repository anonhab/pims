<!DOCTYPE html>
@include('includes.head')
    <body>
         
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('training_officer.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
             
    </div>

    <section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Job Management</h1>

        <form method="POST" action="{{ route('job.assign') }}">
            @csrf
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
                                        <select name="prisoner_id" required>
                                            <option value="">Select Prisoner</option>
                                            @foreach($prisoners as $prisoner)
                                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Job Title</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="job_title" required>
                                            <option value="">Select Job Title</option>
                                            <option value="Cleaner">Cleaner</option>
                                            <option value="Cook">Cook</option>
                                            <option value="Gardener">Gardener</option>
                                            <option value="Maintenance Worker">Maintenance Worker</option>
                                            <option value="Other">Other</option>
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
                                    <input class="input" type="date" name="assigned_date" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Job Description</label>
                                <div class="control">
                                    <textarea class="textarea" name="job_description" placeholder="Enter job description or details about the job assignment"></textarea>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Status</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="status" required>
                                            <option value="active">Active</option>
                                            <option value="completed">Completed</option>
                                            <option value="terminated">Terminated</option>
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
