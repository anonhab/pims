<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
       @include('training_officer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-filter">
                        <!-- Search and other controls -->
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="table-search" type="text" placeholder="Search for records...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="select">
                                <select id="table-length">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" id="create-record-button">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Create Record</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button" id="table-reload">
                                    <span class="icon is-small">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="card-content">
                        <!-- Table Section -->
                        <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prisoner</th>
                                    <th>Certification Name</th>
                                    <th>Issued By</th>
                                    <th>Issued Date</th>
                                    <th>Expiration Date</th>
                                    <th>Certification Type</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer_js')

        <!-- Modal for Create Record -->
        <div class="modal" id="create-record-modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Create New Certification</p>
                    <button class="delete" aria-label="close" id="close-modal-button"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Form for creating a new certification -->
                    <form id="create-record-form">
                        <div class="field">
                            <label class="label">Prisoner</label>
                            <div class="control">
                                <input class="input" type="text" id="prisoner" name="prisoner" placeholder="Enter prisoner name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Certification Name</label>
                            <div class="control">
                                <input class="input" type="text" id="certification-name" name="certification-name" placeholder="Enter certification name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Issued By</label>
                            <div class="control">
                                <input class="input" type="text" id="issued-by" name="issued-by" placeholder="Enter issuer's name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Issued Date</label>
                            <div class="control">
                                <input class="input" type="date" id="issued-date" name="issued-date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Expiration Date</label>
                            <div class="control">
                                <input class="input" type="date" id="expiration-date" name="expiration-date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Certification Type</label>
                            <div class="control">
                                <div class="select">
                                    <select id="certification-type" name="certification-type" required>
                                        <option value="Medical">Medical</option>
                                        <option value="Vocational">Vocational</option>
                                        <option value="Technical">Technical</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" id="save-record-button">Save changes</button>
                    <button class="button" id="cancel-modal-button">Cancel</button>
                </footer>
            </div>
        </div>

      
</body>

</html>