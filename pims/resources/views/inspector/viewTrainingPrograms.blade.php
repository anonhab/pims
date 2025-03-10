<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
       @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header"></div>

            <div class="content-body">
                <div class="card">
                    <div class="card-filter">
                        <!-- Search and other controls -->
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="table-search" type="text" placeholder="Search for jobs...">
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
                                    <span>Create Program</span>
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
                        <!-- Card Layout for Jobs -->
                        <div class="columns is-multiline">
                            @foreach($trainingprograms as $index => $trainingprograms)
                                <div class="column is-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-header-title">{{ $trainingprograms->name }}</p>
                                        </div>
                                        <div class="card-content">
                                            <p><strong>Description:</strong> {{ $trainingprograms->description }}</p>
                                            <p><strong>Created By:</strong> {{ $trainingprograms->created_by }}</p>
                                            <p><strong>Created At:</strong> {{ $trainingprograms->created_at }}</p>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <div class="card-footer-item">
                                                <a href="#" class="button is-small is-link">Edit</a>
                                            </div>
                                            <div class="card-footer-item">
                                                <form action="#" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button is-small is-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                    <p class="modal-card-title">Create New trainingprograms</p>
                    <button class="delete" aria-label="close" id="close-modal-button"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Form for creating a new trainingprograms -->
                    <form id="create-record-form">
                        <div class="field">
                            <label class="label">Program Title</label>
                            <div class="control">
                                <input class="input" type="text" id="trainingprograms-title" name="trainingprograms-title" placeholder="Enter Program title" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" id="trainingprograms-description" name="trainingprograms-description" placeholder="Enter Program description" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Created By</label>
                            <div class="control">
                                <input class="input" type="text" id="created-by" name="created-by" placeholder="Enter created by" required>
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

                    // Handle the form data, e.g., send it to the server via AJAX
                    fetch('/api/jobs', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        createRecordModal.classList.remove('is-active');
                        // Optionally, reload the page or dynamically add the new trainingprograms
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            });
        </script>
</body>

</html>
