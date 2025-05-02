<!DOCTYPE html>
<html>

@include('includes.head')
<style>
/* Global enhancements */
body {
    background-color: #f9fafb;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Card styling */
.card {
    border-radius: 1rem;
    overflow: hidden;
    border: none;
}

/* Header */
.card-header {
    padding: 1rem 1.5rem;
    background: linear-gradient(to right, #007bff, #0056b3);
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
}

/* Form label */
.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #333;
}

/* Select dropdown */
.form-select {
    border-radius: 0.5rem;
    padding: 0.6rem;
}

/* Checklist styling */
.form-check-label {
    margin-left: 0.3rem;
    font-weight: 400;
}

/* Buttons */
.btn {
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    border-radius: 0.5rem;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Alert messages */
.alert {
    margin-bottom: 1.5rem;
    border-radius: 0.5rem;
    padding: 0.8rem 1.2rem;
    font-size: 0.95rem;
}

/* Page spacing */
.container {
    padding-bottom: 3rem;
}
</style>

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('police_commisioner.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
            </div>


            <div class="container mt-5">

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Release Prisoners</h5>
    </div>

    <div class="card-body">
        <!-- Feedback Messages -->
        <div id="system-message" class="alert d-none"></div>

        <!-- Prisoner Selection -->
        <div class="mb-4">
            <label for="prisonerSelect" class="form-label">Select Prisoner</label>
            <select id="prisonerSelect" name="prisoner_id" class="form-select">
                <!-- Dynamically populate this list in backend -->
                <option value="">-- Select a Prisoner --</option>
                <option value="1">John Doe - #P102</option>
                <option value="2">Jane Smith - #P103</option>
                <option value="3">Ali Yusuf - #P104</option>
            </select>
        </div>

        <!-- Legal Requirement Checklist -->
        <div class="mb-4">
            <h6>Verify Legal Requirements</h6>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="sentenceCompleted">
                <label class="form-check-label" for="sentenceCompleted">Sentence Completed</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="noPendingCases">
                <label class="form-check-label" for="noPendingCases">No Pending Legal Cases</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="behaviorApproved">
                <label class="form-check-label" for="behaviorApproved">Good Behavior Report Available</label>
            </div>
        </div>

        <!-- Release Action -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
            <button class="btn btn-success" onclick="attemptRelease()">Release Prisoner</button>
        </div>
    </div>
</div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS Section -->
<script>
function attemptRelease() {
    const sentence = document.getElementById('sentenceCompleted').checked;
    const cases = document.getElementById('noPendingCases').checked;
    const behavior = document.getElementById('behaviorApproved').checked;
    const prisoner = document.getElementById('prisonerSelect').value;
    const messageBox = document.getElementById('system-message');

    if (!prisoner) {
        showMessage('Please select a prisoner.', 'danger');
        return;
    }

    if (sentence && cases && behavior) {
        // Simulate release success (you should submit form or AJAX here)
        showMessage('Prisoner released successfully and system updated.', 'success');
    } else {
        // Ineligible for release
        showMessage('Prisoner is not eligible for release. Please check all conditions.', 'warning');
    }
}

function showMessage(message, type) {
    const box = document.getElementById('system-message');
    box.textContent = message;
    box.className = `alert alert-${type}`;
    box.classList.remove('d-none');
}
</script>
        </div>
        @include('includes.footer_js')
</body>

</html>
