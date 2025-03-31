<!DOCTYPE html>

@include('includes.head')
<!-- Bootstrap JS (Include this before closing </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .title {
        color: #333;
    }
    .card {
        background: #ffffff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 5px solid #3273dc;
        transition: transform 0.3s;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .field label {
        font-weight: bold;
    }
    .textarea {
        min-height: 120px;
        border: 2px solid #ccc;
        transition: border-color 0.3s;
    }
    .textarea:focus {
        border-color: #3273dc;
    }
    .buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
    .button {
        transition: background 0.3s, transform 0.2s;
    }
    .button.is-success:hover {
        background: #28a745;
        transform: scale(1.05);
    }
    .button.is-danger:hover {
        background: #dc3545;
        transform: scale(1.05);
    }
    .has-text-centered {
        text-align: center;
        font-size: 1.2rem;
        color: #666;
    }
</style>

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('discipline_officer.menu')

        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Request Evaluation</h1>

                    @if($requests->isNotEmpty())
                        @foreach($requests as $request)
                            <div class="card">
                                <div class="card-content">
                                    <p class="title is-5">Request Information</p>

                                    <div class="field">
                                        <label class="label">Request Type</label>
                                        <p class="control">{{ $request->request_type }}</p>
                                    </div>

                                    <div class="field">
                                        <label class="label">Request Details</label>
                                        <p class="control">{{ $request->request_details }}</p>
                                    </div>

                                    <div class="field">
                                        <label class="label">Prisoner ID</label>
                                        <p class="control">{{ $request->prisoner_id }}</p>
                                        <a href="#" class="btn btn-primary view-prisoner-details" data-id="{{ $request->prisoner_id }}">
    View Details
</a>

                                    </div>
                                    

                                    <div class="field">
                                        <label class="label">Evaluation</label>
                                        <div class="control">
                                            <textarea class="textarea evaluation-text" placeholder="Enter your evaluation" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Hidden Field to store Request ID -->
                                    <input type="hidden" class="request-id" value="{{ $request->id }}">

                                    <div class="buttons">
                                        <button class="button is-success approve-btn" disabled>Approve</button>
                                        <button class="button is-danger reject-btn" disabled>Reject</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="has-text-centered">No pending requests at the moment.</p>
                    @endif
                </div>
            </section>
        </div>
    </div>
<!-- Prisoner Details Modal -->
<div class="modal fade" id="prisonerDetailModal" tabindex="-1" aria-labelledby="prisonerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prisonerModalLabel">Prisoner Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="prisoner-id"></span></p>
                <p><strong>Full Name:</strong> <span id="prisoner-name"></span></p>
                <p><strong>Date of Birth:</strong> <span id="prisoner-dob"></span></p>
                <p><strong>Gender:</strong> <span id="prisoner-gender"></span></p>
                <p><strong>Marital Status:</strong> <span id="prisoner-marital"></span></p>
                <p><strong>Crime Committed:</strong> <span id="prisoner-crime"></span></p>
                <p><strong>Status:</strong> <span id="prisoner-status"></span></p>
                <p><strong>Time Serve Start:</strong> <span id="prisoner-start"></span></p>
                <p><strong>Time Serve End:</strong> <span id="prisoner-end"></span></p>
                <p><strong>Address:</strong> <span id="prisoner-address"></span></p>
                <p><strong>Emergency Contact:</strong> <span id="prisoner-emergency"></span></p>
                <p><strong>Room ID:</strong> <span id="prisoner-room"></span></p>
                <p><strong>Prison ID:</strong> <span id="prisoner-prison"></span></p>
                <img id="prisoner-image" src="" alt="Prisoner Image" class="img-fluid mt-2" style="max-height: 200px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    @include('includes.footer_js')
    <script>
    // Enable/Disable buttons based on textarea input
    document.querySelectorAll('.evaluation-text').forEach((textarea, index) => {
        const approveBtn = document.querySelectorAll('.approve-btn')[index];
        const rejectBtn = document.querySelectorAll('.reject-btn')[index];
        
        textarea.addEventListener('input', () => {
            const evaluation = textarea.value.trim();
            if (evaluation !== '') {
                approveBtn.disabled = false;
                rejectBtn.disabled = false;
            } else {
                approveBtn.disabled = true;
                rejectBtn.disabled = true;
            }
        });

        approveBtn.addEventListener('click', () => {
    const requestId = document.querySelectorAll('.request-id')[index].value;
    const evaluation = textarea.value;

    console.log('Approve button clicked for request ID:', requestId);
    console.log('Evaluation content:', evaluation);

    if (evaluation.trim() === '') {
        alert('Please provide an evaluation!');
        console.log('Evaluation is empty. Aborting approval.');
        return;
    }

    console.log('Making AJAX request to approve the request with ID:', requestId);

    // Make an AJAX request to approve the request
    fetch(`/approve-request/${requestId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ evaluation: evaluation })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`✅ You approved the request with ID: ${requestId}`);
            console.log('Request approved successfully:', data);
            // Optionally, update the UI to reflect the change
        } else {
            alert(data.message || 'Something went wrong!');
            console.log('Error approving request:', data.message);
        }
    })
    .catch(error => {
        console.error('Error occurred while processing the request:', error);
        alert('An error occurred. Please try again.');
    });
});

        rejectBtn.addEventListener('click', () => {
            const requestId = document.querySelectorAll('.request-id')[index].value;
            const evaluation = textarea.value;

            if (evaluation.trim() === '') {
                alert('Please provide an evaluation!');
                return;
            }

            // Make an AJAX request to reject the request
            fetch(`/reject-request/${requestId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ evaluation: evaluation })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`❌ You rejected the request with ID: ${requestId}`);
                    // Optionally, update the UI to reflect the change
                } else {
                    alert(data.message || 'Something went wrong!');
                }
            })
            .catch(error => {
                console.error(error);
                alert('An error occurred. Please try again.');
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.view-prisoner-details').forEach(button => {
        button.addEventListener('click', function () {
            let prisonerId = this.getAttribute('data-id');

            fetch(`/prisoners/${prisonerId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('prisoner-id').textContent = data.id;
                    document.getElementById('prisoner-name').textContent = `${data.first_name} ${data.middle_name} ${data.last_name}`;
                    document.getElementById('prisoner-dob').textContent = data.dob;
                    document.getElementById('prisoner-gender').textContent = data.gender;
                    document.getElementById('prisoner-marital').textContent = data.marital_status;
                    document.getElementById('prisoner-crime').textContent = data.crime_committed;
                    document.getElementById('prisoner-status').textContent = data.status;
                    document.getElementById('prisoner-start').textContent = data.time_serve_start;
                    document.getElementById('prisoner-end').textContent = data.time_serve_end;
                    document.getElementById('prisoner-address').textContent = data.address;
                    document.getElementById('prisoner-emergency').textContent = `${data.emergency_contact_name} (${data.emergency_contact_relation}) - ${data.emergency_contact_number}`;
                    document.getElementById('prisoner-room').textContent = data.room_id;
                    document.getElementById('prisoner-prison').textContent = data.prison_id;
                    document.getElementById('prisoner-image').src = data.inmate_image ? `/storage/${data.inmate_image}` : 'https://via.placeholder.com/150';

                    // Ensure Bootstrap Modal works
                    var modalElement = document.getElementById('prisonerDetailModal');
                    var modalInstance = new bootstrap.Modal(modalElement);
                    modalInstance.show();
                })
                .catch(error => console.error('Error fetching prisoner details:', error));
        });
    });
});

</script>



</body>
</html>
