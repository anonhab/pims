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
                            @foreach($trainingprograms as $trainingprogram)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-header-title">{{ $trainingprogram->name }}</p>
                                    </div>
                                    <div class="card-content">
                                        <p><strong>Description:</strong> {{ $trainingprogram->description }}</p>
                                        <p><strong>Created By:</strong> {{ $trainingprogram->created_by }}</p>
                                        <p><strong>Created At:</strong> {{ $trainingprogram->created_at }}</p>
                                        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($trainingprogram->start_date)->format('Y-m-d') }}</p>
                                        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($trainingprogram->end_date)->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <!-- Edit Button - Trigger the Modal -->
                                        <div class="card-footer-item">
                                            <button class="button is-small is-link" data-toggle="modal" data-target="#editModal{{ $trainingprogram->id }}">Edit</button>
                                        </div>
                                        <!-- Delete Button -->
                                        <div class="card-footer-item">
                                            <form action="{{ route('training_officer.destroy', $trainingprogram->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button is-small is-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Editing Training Program -->
                            <div class="modal" id="editModal{{ $trainingprogram->id }}">
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title">Edit Training Program</p>
                                        <button class="delete" aria-label="close" data-close-modal="{{ $trainingprogram->id }}"></button>
                                    </header>
                                    <section class="modal-card-body">
                                        <form action="{{ route('training_officer.update', $trainingprogram->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="field">
                                                <label class="label">Program Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="name" value="{{ $trainingprogram->name }}" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Description</label>
                                                <div class="control">
                                                    <textarea class="textarea" name="description" required>{{ $trainingprogram->description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Start Date</label>
                                                <div class="control">
                                                    <input class="input" type="date" name="start_date" value="{{ $trainingprogram->start_date->format('Y-m-d') }}" required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">End Date</label>
                                                <div class="control">
                                                    <input class="input" type="date" name="end_date" value="{{ $trainingprogram->end_date->format('Y-m-d') }}" required>
                                                </div>
                                            </div>

                                            <div class="field is-grouped">
                                                <div class="control">
                                                    <button class="button is-link" type="submit">Save Changes</button>
                                                </div>
                                                <div class="control">
                                                    <button class="button is-light" type="button" data-close-modal="{{ $trainingprogram->id }}">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </section>
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
                    <p class="modal-card-title">Create New Training Program</p>
                    <button class="delete" aria-label="close" id="close-modal-button"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Form for creating a new training program -->
                    <form id="create-record-form" action="{{ route('training_officer.store') }}" method="POST">
                        @csrf
                        <div class="field">
                            <label class="label">Program Title</label>
                            <div class="control">
                                <input class="input" type="text" id="name" name="name" placeholder="Enter Program title" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" id="description" name="description" placeholder="Enter Program description" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Start Date</label>
                            <div class="control">
                                <input class="input" type="date" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">End Date</label>
                            <div class="control">
                                <input class="input" type="date" id="end_date" name="end_date" required>
                            </div>
                        </div>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" id="save-record-button" type="submit" form="create-record-form">Save changes</button>
                    <button class="button" id="cancel-modal-button">Cancel</button>
                </footer>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Modal handling for edit modals
                const closeButtons = document.querySelectorAll('[data-close-modal]');
                const editButtons = document.querySelectorAll('[data-toggle="modal"]');
                
                // Close modal handlers
                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-close-modal');
                        const modal = document.getElementById('editModal' + modalId) || document.getElementById('create-record-modal');
                        modal.classList.remove('is-active');
                    });
                });

                // Open modal handlers
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-target').replace('#', '');
                        const modal = document.getElementById(modalId);
                        modal.classList.add('is-active');
                    });
                });

                // Create record modal handling
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

                // Delete confirmation
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        if (!confirm('Are you sure you want to delete this training program?')) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
</body>

</html>
