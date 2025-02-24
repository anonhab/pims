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

            <form action="{{ route('prisons.store') }}" method="POST">
    @csrf  <!-- Cross-Site Request Forgery token for security -->
    
    <div class="columns">
        <!-- Prison Information -->
        <div class="column is-half">
            <div class="card">
                <div class="card-content">
                    <p class="title is-4">Prison Information</p>

                    <div class="field">
                        <label class="label">Prison Name</label>
                        <div class="control">
                            <input class="input" type="text" name="name" placeholder="Enter prison name" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Location</label>
                        <div class="control">
                            <input class="input" type="text" name="location" placeholder="Enter location" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Capacity</label>
                        <div class="control">
                            <input class="input" type="number" name="capacity" placeholder="Enter capacity" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Phone Number</label>
                        <div class="control">
                            <input class="input" type="tel" name="phone_number" placeholder="Enter phone number" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email Address</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="Enter email address" required>
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
                        <label class="label">Additional Notes</label>
                        <div class="control">
                            <textarea class="textarea" name="notes" placeholder="Enter additional notes (optional)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit and Reset Buttons -->
    <div class="field is-grouped is-grouped-right">
        <div class="control">
            <button class="button is-link" type="submit">Save Prison</button>
        </div>
        <div class="control">
            <button class="button is-light" type="reset">Reset</button>
        </div>
    </div>
</form>





        </div>
    </div>

    @include('includes.footer_js')
</body>


</html>