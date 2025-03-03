<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!--   NAV -->
    <div class="columns" id="app-content">
        @include('includes.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Initiate Backup </h4>
            </div>
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Backup and Recovery</h1>

                    <form>
                        <div class="columns">
                            <!-- Backup Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Backup Information</p>

                                        <div class="field">
                                            <label class="label">Initiated By</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Admin</option>
                                                        <option>Admin 1</option>
                                                        <option>Admin 2</option>
                                                        <option>Admin 3</option>
                                                        <!-- Dynamically populate this list with admins -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Backup Date</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Recovery Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Recovery Information</p>

                                        <div class="field">
                                            <label class="label">Recovery Date</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Notes</label>
                                            <div class="control">
                                                <textarea class="textarea" placeholder="Enter any relevant notes or details about the recovery process"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Save Backup and Recovery</button>
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