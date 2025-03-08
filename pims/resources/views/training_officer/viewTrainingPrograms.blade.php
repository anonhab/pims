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
                                    <th>Program Name</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th>Program Start Date</th>
                                    <th>Program End Date</th>
                                    <th>Program Location</th>
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
                    <p class="modal-card-title">Create New Program</p>
                    <button class="delete" aria-label="close" id="close-modal-button"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Form for creating a new program -->
                    <form id="create-record-form">
                        <div class="field">
                            <label class="label">Program Name</label>
                            <div class="control">
                                <input class="input" type="text" id="program-name" name="program-name" placeholder="Enter program name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" id="description" name="description" placeholder="Enter program description" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Created By</label>
                            <div class="control">
                                <input class="input" type="text" id="created-by" name="created-by" placeholder="Enter creator's name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Program Start Date</label>
                            <div class="control">
                                <input class="input" type="date" id="start-date" name="start-date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Program End Date</label>
                            <div class="control">
                                <input class="input" type="date" id="end-date" name="end-date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Program Location</label>
                            <div class="control">
                                <input class="input" type="text" id="location" name="location" placeholder="Enter program location" required>
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

        <script>
            // JavaScript to handle modal and form submission
            document.addEventListener('DOMContentLoaded', function () {
                const createRecordButton = document.getElementById('create-record-button');
                const closeModalButton = document.getElementById('close-modal-button');
                const cancelModalButton = document.getElementById('cancel-modal-button');
                const saveRecordButton = document.getElementById('save-record-button');
                const createRecordModal = document.getElementById('create-record-modal');

                // Open modal
                createRecordButton.addEventListener('click', () => {
                    createRecordModal.classList.add('is-active');
                });

                // Close modal
                closeModalButton.addEventListener('click', () => {
                    createRecordModal.classList.remove('is-active');
                });

                cancelModalButton.addEventListener('click', () => {
                    createRecordModal.classList.remove('is-active');
                });

                // Save record
                saveRecordButton.addEventListener('click', () => {
                    const form = document.getElementById('create-record-form');
                    const formData = new FormData(form);

                    // Here you can handle the form data, e.g., send it to the server via AJAX
                    fetch('/api/programs', {
                        method: 'POST',
                        body: JSON.stringify(Object.fromEntries(formData)),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        createRecordModal.classList.remove('is-active');
                        // Optionally, reload the table or add the new record dynamically
                        location.reload(); // Reload the page to reflect the new record
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            });
        </script>
</body>

</html>