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
                                    <span>Create Job</span>
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
                            @foreach($jobs as $job)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-header-title">Job Title: {{ $job->job_title }}</p>
                                    </div>
                                    <div class="card-content">
                                        <p><strong>Prisoner ID:</strong> {{ $job->prisoner_id }}</p>
                                        <p><strong>Assigned By:</strong> {{ $job->assigned_by }}</p>
                                        <p><strong>Description:</strong> {{ $job->job_description }}</p>
                                        <p><strong>Assigned Date:</strong> {{ $job->assigned_date }}</p>
                                        <p><strong>Status:</strong>
                                            <span class="tag is-{{ $job->status === 'completed' ? 'success' : ($job->status === 'terminated' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Created At:</strong> {{ $job->created_at->format('Y-m-d H:i') }}</p>
                                        <p><strong>Updated At:</strong> {{ $job->updated_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-footer-item">
                                            <button class="button is-small is-link edit-button"
                                                data-id="{{ $job->id }}"
                                                data-job-title="{{ $job->job_title }}"
                                                data-prisoner-id="{{ $job->prisoner_id }}"
                                                data-assigned-by="{{ $job->assigned_by }}"
                                                data-job-description="{{ $job->job_description }}"
                                                data-assigned-date="{{ $job->assigned_date }}"
                                                data-status="{{ $job->status }}">
                                                Edit
                                            </button>
                                        </div>
                                        <div class="card-footer-item">
                                            <form action="{{ route('jobs.destroyjob', $job->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button is-small is-danger"
                                                    onclick="return confirm('Are you sure you want to delete this job?')">
                                                    Delete
                                                </button>
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

        <!-- Create Job Modal -->
        <div class="modal" id="create-record-modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Create New Job</p>
                    <button class="delete" aria-label="close" id="close-modal-button"></button>
                </header>
                <section class="modal-card-body">
                    <form id="create-record-form" action="{{ route('job.assign') }}" method="POST">
                        @csrf
                        <div class="field">
                            <label class="label">Job Title</label>
                            <div class="control">
                                <input class="input" type="text" name="job_title" placeholder="Enter job title" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Prisoner ID</label>
                            <div class="control">
                                <input class="input" type="text" name="prisoner_id" placeholder="Enter prisoner ID" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Assigned By</label>
                            <div class="control">
                                <input class="input" type="text" name="assigned_by" placeholder="Enter assigned by" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Job Description</label>
                            <div class="control">
                                <textarea class="textarea" name="job_description" placeholder="Enter job description" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Assigned Date</label>
                            <div class="control">
                                <input class="input" type="date" name="assigned_date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Status</label>
                            <div class="control">
                                <div class="select">
                                    <select name="status" required>
                                        <option value="active">Active</option>
                                        <option value="completed">Completed</option>
                                        <option value="terminated">Terminated</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" type="submit" form="create-record-form">Save changes</button>
                    <button class="button" id="cancel-modal-button">Cancel</button>
                </footer>
            </div>
        </div>

        <!-- Edit Job Modal -->
<div class="modal" id="edit-job-modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Edit Job</p>
            <button class="delete" aria-label="close" id="close-edit-modal-button"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-job-form" method="POST" action="{{ route('jobs.update') }}">
            @csrf
            @method('PUT')
                <input type="hidden" name="job_id" id="edit-job-id">

                <div class="field">
                    <label class="label">Job Title</label>
                    <div class="control">
                        <input class="input" type="text" name="job_title" id="edit-job-title" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Prisoner ID</label>
                    <div class="control">
                        <input class="input" type="text" name="prisoner_id" id="edit-prisoner-id" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Assigned By</label>
                    <div class="control">
                        <input class="input" type="text" name="assigned_by" id="edit-assigned-by" value="{{ session('user_id') }}" readonly>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Job Description</label>
                    <div class="control">
                        <textarea class="textarea" name="job_description" id="edit-job-description" required></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Assigned Date</label>
                    <div class="control">
                        <input class="input" type="date" name="assigned_date" id="edit-assigned-date" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Status</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="status" id="edit-status" required>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="terminated">Terminated</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-success" type="submit" form="edit-job-form">Save changes</button>
            <button class="button" id="cancel-edit-modal-button">Cancel</button>
        </footer>
    </div>
</div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Create Job Modal Handling
                const createRecordButton = document.getElementById('create-record-button');
                const closeModalButton = document.getElementById('close-modal-button');
                const cancelModalButton = document.getElementById('cancel-modal-button');
                const createRecordModal = document.getElementById('create-record-modal');

                // Open create modal
                createRecordButton.addEventListener('click', () => {
                    createRecordModal.classList.add('is-active');
                });

                // Close create modal
                closeModalButton.addEventListener('click', () => {
                    createRecordModal.classList.remove('is-active');
                });

                cancelModalButton.addEventListener('click', () => {
                    createRecordModal.classList.remove('is-active');
                });

                // Edit Job Modal Handling
                const editButtons = document.querySelectorAll('.edit-button');
                const editModal = document.getElementById('edit-job-modal');
                const closeEditModalButton = document.getElementById('close-edit-modal-button');
                const cancelEditModalButton = document.getElementById('cancel-edit-modal-button');

                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const jobId = button.dataset.id;
                        const form = document.getElementById('edit-job-form');

                        // Set form action with job ID
                        form.action = `/jobs/${jobId}`;

                        // Populate form fields
                        document.getElementById('edit-job-title').value = button.dataset.jobTitle;
                        document.getElementById('edit-prisoner-id').value = button.dataset.prisonerId;
                        document.getElementById('edit-assigned-by').value = button.dataset.assignedBy;
                        document.getElementById('edit-job-description').value = button.dataset.jobDescription;
                        document.getElementById('edit-assigned-date').value = button.dataset.assignedDate;
                        document.getElementById('edit-status').value = button.dataset.status;

                        editModal.classList.add('is-active');
                    });
                });

                // Close edit modal
                closeEditModalButton.addEventListener('click', () => {
                    editModal.classList.remove('is-active');
                });

                cancelEditModalButton.addEventListener('click', () => {
                    editModal.classList.remove('is-active');
                });

                // Delete Confirmation
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        if (!confirm('Are you sure you want to delete this job?')) {
                            e.preventDefault();
                        }
                    });
                });

                // Reload button
                document.getElementById('table-reload').addEventListener('click', () => {
                    window.location.reload();
                });
            });
        </script>
</body>

</html>