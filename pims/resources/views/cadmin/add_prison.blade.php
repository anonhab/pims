<!DOCTYPE html>
@include('includes.head')

    <body>
  
        <!-- NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
            @include('cadmin.menu')

            <div class="column is-10" id="page-content">
                <div class="content-header"></div>

                <section class="section">
                    <div class="container">
                        <h1 class="title has-text-centered">Prison Management</h1>

                        <form action="#" method="POST">
                            @csrf
                            <div class="columns">
                                <!-- Prison Details -->
                                <div class="column is-half">
                                    <div class="card">
                                        <div class="card-content">
                                            <p class="title is-4">Add Prison</p>

                                            <div class="field">
                                                <label class="label">Prison Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="name" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Location</label>
                                                <div class="control">
                                                    <div class="select is-fullwidth">
                                                        <select name="location" required>
                                                            <option value="">Select Location</option>
                                                            <option value="Addis Ababa">Addis Ababa</option>
                                                            <option value="Bahir Dar">Bahir Dar</option>
                                                            <option value="Gondar">Gondar</option>
                                                            <option value="Adama">Adama</option>
                                                            <option value="Hawassa">Hawassa</option>
                                                            <!-- Dynamically populate this list from the database -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Capacity</label>
                                                <div class="control">
                                                    <input class="input" type="number" name="capacity" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Managed By</label>
                                                <div class="control">
                                                    <div class="select is-fullwidth">
                                                        <select name="managed_by" required>
                                                            <option value="">Select Manager</option>
                                                            <option value="Officer A">Officer A</option>
                                                            <option value="Officer B">Officer B</option>
                                                            <option value="Officer C">Officer C</option>
                                                            <!-- Dynamically populate this list from officers -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Phone Number</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="contact_phone" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Email Address</label>
                                                <div class="control">
                                                    <input class="input" type="email" name="contact_email" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Additional Notes</label>
                                                <div class="control">
                                                    <textarea class="textarea" name="additional_notes"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="field is-grouped is-grouped-left">
                                <div class="control">
                                    <button class="button is-link" type="submit">Add Prison</button>
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
