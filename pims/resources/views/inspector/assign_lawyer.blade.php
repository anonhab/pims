<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h2 class="title">Assignments</h2>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="search-assignment" type="text" placeholder="Search assignments...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="#" onclick="openForm()">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>New Assignment</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button" id="reload-assignments">
                                    <span class="icon is-small">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="columns is-multiline">
                            @foreach($assignments as $assignment)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-5">Assignment #{{ $assignment->id }}</p>
                                                <p class="subtitle is-6"><i class="fa fa-calendar"></i> {{ $assignment->assignment_date }}</p>
                                            </div>
                                        </div>

                                        <div class="content">
    <p><strong>Prisoner ID:</strong> 
        {{ optional($assignment->prisoner)->id ?? 'Not assigned' }}
    </p>
    <p><strong>Prisoner name:</strong> 
        {{ optional($assignment->prisoner)->first_name ?? 'Not assigned' }}
    </p>
    
    <p><strong>Lawyer Name:</strong> 
        {{ optional($assignment->lawyer)->first_name ?? 'Not assigned' }}
    </p>
    
    <p><strong>Assigned By:</strong> 
        {{ optional($assignment->assignedBy)->first_name ?? 'Unknown' }}
    </p>
</div>

                                    </div>

                                    <footer class="card-footer">
                                        <a href="#" class="card-footer-item">
                                            <span class="icon"><i class="fa fa-edit"></i></span> Edit
                                        </a>
                                        <form action="#" method="POST" class="card-footer-item">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-text" onclick="return confirm('Are you sure?')">
                                                <span class="icon"><i class="fa fa-trash"></i></span> Delete
                                            </button>
                                        </form>
                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Assignment Form (Modal) -->
                    <div id="assignmentForm" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">New Assignment</p>
                                <button class="delete" onclick="closeForm()"></button>
                            </header>
                            <form action="{{ route('assignments.store') }}" method="POST">
                                @csrf
                                <section class="modal-card-body">
                                    <div class="field">
                                        <label class="label">Prisoner ID</label>
                                        <div class="control">
                                            <input type="text" name="prisoner_id" class="input" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Lawyer ID</label>
                                        <div class="control">
                                            <input type="text" name="lawyer_id" class="input" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Assigned By</label>
                                        <div class="control">
                                            <input type="text" name="assigned_by" class="input" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Assignment Date</label>
                                        <div class="control">
                                            <input type="date" name="assignment_date" class="input" required>
                                        </div>
                                    </div>
                                </section>
                                <footer class="modal-card-foot">
                                    <button class="button is-success" type="submit">Save</button>
                                    <button class="button" onclick="closeForm()">Cancel</button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer_js')
        <script>
    function openForm() {
        document.getElementById("assignmentForm").classList.add("is-active");
    }

    function closeForm() {
        document.getElementById("assignmentForm").classList.remove("is-active");
    }

    // Close modal when clicking on the background
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("assignmentForm");
        const modalBackground = modal.querySelector(".modal-background");
        const closeButton = modal.querySelector(".delete");

        modalBackground.addEventListener("click", closeForm);
        closeButton.addEventListener("click", closeForm);
    });
</script>

    </div>
</body>

</html>
