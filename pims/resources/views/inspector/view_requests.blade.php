<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <!-- Add content header if necessary -->
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

                    </div>

                    <div class="card-content">
                        <!-- Enhanced Grid Layout for Request Cards -->
                        <div class="columns is-multiline" id="request-list">
                            @foreach($requests as $request)
                            <div class="column is-12-mobile is-6-tablet is-4-desktop request-card-container"
                                data-search="{{ strtolower(optional($request->user)->first_name . ' ' . $request->request_type . ' ' . $request->status . ' ' . optional($request->prisoner)->first_name . ' ' . optional($request->prisoner)->last_name) }}">

                                <div class="card request-card has-shadow-hover">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-5">{{ optional($request->prisoner)->first_name ?? 'Unknown' }}</p>
                                                <p class="subtitle is-6">{{ ucfirst($request->request_type) }}</p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p><strong>Status:</strong> {{ ucfirst($request->status) }}</p>
                                            <p><strong>Details:</strong> {{ Str::limit($request->request_details, 50) }}</p>

                                            <!-- Display the role name associated with the requester -->
                                            <p><strong>Requested by:</strong>
                                                @if($request->user && $request->lawyer)
                                                {{ optional($request->user)->role->name ?? 'N/A' }} and Lawyer ID {{ optional($request->lawyer)->lawyer_id ?? 'N/A' }}
                                                @elseif($request->user)
                                                {{ optional($request->user)->role->name ?? 'N/A' }} ( ID: {{ optional($request->user)->user_id ?? 'N/A' }})
                                                @elseif($request->lawyer)
                                                Lawyer ID: {{ optional($request->lawyer)->lawyer_id ?? 'N/A' }}
                                                @else
                                                N/A
                                                @endif
                                            </p>



                                            <!-- Display prisoner information -->
                                            <p><strong>Prisoner ID:</strong> {{ optional($request->prisoner)->id ?? 'N/A' }}</p>
                                            <p><strong>Prisoner Name:</strong> {{ optional($request->prisoner)->first_name . ' ' . optional($request->prisoner)->last_name ?? 'N/A' }}</p>

                                            <div class="buttons are-small is-centered">
                                                <p class="control">
                                                    <a href="#" class="button is-rounded is-text view-prisoner"
                                                        data-id="{{ optional($request->prisoner)->id }}">
                                                        <span class="icon"><i class="fa fa-eye"></i></span>
                                                        <span>View</span>
                                                    </a>
                                                </p>
                                                <p class="control">
                                                    <a href="javascript:void(0);" class="button is-warning is-rounded action-update-status"
                                                        data-id="{{ $request->id }}" data-status="{{ $request->status }}">
                                                        <span class="icon"><i class="fa fa-sync"></i></span>
                                                        <span>Update Status</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination Controls -->
                        <div class="pagination is-centered" role="navigation" aria-label="pagination">
                            <!-- Previous Button -->
                            <a class="pagination-previous {{ $requests->onFirstPage() ? 'is-disabled' : '' }}"
                                href="{{ $requests->previousPageUrl() }}">Previous</a>

                            <!-- Next Button -->
                            <a class="pagination-next {{ $requests->hasMorePages() ? '' : 'is-disabled' }}"
                                href="{{ $requests->nextPageUrl() }}">Next</a>

                            <!-- Page Numbers -->
                            <ul class="pagination-list">
                                @foreach(range(1, $requests->lastPage()) as $page)
                                <li>
                                    <a class="pagination-link {{ $page == $requests->currentPage() ? 'is-current' : '' }}"
                                        href="{{ $requests->url($page) }}">{{ $page }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Status Update Modal -->
        <div id="update-status-modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <h3 class="title is-5">Update Request Status</h3>

                    <input type="hidden" id="update-request-id">

                    <div class="field">
                        <label class="label">Select Status</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select id="update-status">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="buttons is-centered">
                        <button class="button is-primary" id="confirm-status-update">Update</button>
                        <button class="button is-light" id="close-status-modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <<!-- Prisoner Details Modal -->
            <div class="modal" id="view-prisoner-modal">
                <div class="modal-background"></div>
                <div class="modal-card" style="max-width: 800px; width: 90%;">
                    <header class="modal-card-head has-background-primary-light">
                        <p class="modal-card-title has-text-primary-dark">👤 Prisoner Details</p>
                        <button class="delete close-modal" aria-label="close"></button>
                    </header>

                    <section class="modal-card-body">
                        <div class="columns is-vcentered">
                            <!-- Prisoner Image -->
                            <div class="column is-4 has-text-centered">
                                <figure class="image is-150x150 is-inline-block">
                                    <img id="view-inmate-image" class="is-rounded" src="#" alt="Prisoner Image">
                                </figure>
                                <p class="has-text-grey-light mt-2">Prisoner Profile</p>
                            </div>

                            <!-- Prisoner Details -->
                            <div class="column is-8">
                                <div class="box has-background-light">
                                    <div class="columns">
                                        <div class="column is-6">
                                            <p><strong>🔢 ID:</strong> <span id="view-prisoner-id" class="has-text-weight-semibold">N/A</span></p>
                                            <p><strong>🏛️ Prison ID:</strong> <span id="view-prison-id">N/A</span></p>
                                            <p><strong>📝 Name:</strong> <span id="view-first-name">N/A</span> <span id="view-middle-name">N/A</span> <span id="view-last-name">N/A</span></p>
                                            <p><strong>📅 DOB:</strong> <span id="view-dob">N/A</span></p>
                                            <p><strong>⚧️ Sex:</strong> <span id="view-sex">N/A</span></p>
                                            <p><strong>📍 Address:</strong> <span id="view-address">N/A</span></p>
                                        </div>
                                        <div class="column is-6">
                                            <p><strong>💍 Marital Status:</strong> <span id="view-marital-status">N/A</span></p>
                                            <p><strong>⚖️ Crime:</strong> <span id="view-crime-committed">N/A</span></p>
                                            <p><strong>📌 Status:</strong> <span id="view-status">N/A</span></p>
                                            <p><strong>⏳ Sentence:</strong> <span id="view-time-serve-start">N/A</span> ➝ <span id="view-time-serve-end">N/A</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="box has-background-white-ter">
                                    <p class="has-text-weight-bold has-text-primary">📞 Emergency Contact</p>
                                    <p><strong>👤 Name:</strong> <span id="view-emergency-contact-name">N/A</span></p>
                                    <p><strong>🤝 Relation:</strong> <span id="view-emergency-contact-relation">N/A</span></p>
                                    <p><strong>📞 Number:</strong> <span id="view-emergency-contact-number">N/A</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="box has-background-white-bis">
                            <p><strong>📅 Created At:</strong> <span id="view-created-at">N/A</span></p>
                            <p><strong>📝 Last Updated:</strong> <span id="view-updated-at">N/A</span></p>
                        </div>
                    </section>

                    <footer class="modal-card-foot is-flex is-justify-content-center">
                        <button class="button is-danger is-rounded close-modal">❌ Close</button>
                    </footer>
                </div>
            </div>


            @include('includes.footer_js')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const updateStatusModal = document.getElementById("update-status-modal");
                    const closeModalBtn = document.getElementById("close-status-modal");
                    const confirmUpdateBtn = document.getElementById("confirm-status-update");

                    // Open modal when clicking "Update Status"
                    document.querySelectorAll(".action-update-status").forEach(button => {
                        button.addEventListener("click", function() {
                            const requestId = this.getAttribute("data-id");
                            const currentStatus = this.getAttribute("data-status");

                            document.getElementById("update-request-id").value = requestId;
                            document.getElementById("update-status").value = currentStatus;

                            updateStatusModal.classList.add("is-active");
                        });
                    });

                    // Close modal
                    closeModalBtn.addEventListener("click", function() {
                        updateStatusModal.classList.remove("is-active");
                    });

                    // Confirm status update
                    confirmUpdateBtn.addEventListener("click", function() {
                        const requestId = document.getElementById("update-request-id").value;
                        const newStatus = document.getElementById("update-status").value;

                        fetch(`/requests/update-status/${requestId}`, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    status: newStatus
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(`Request status updated to ${data.new_status}!`);
                                    updateStatusModal.classList.remove("is-active");
                                    location.reload(); // Refresh to show new status
                                } else {
                                    alert("Failed to update request status.");
                                }
                            })
                            .catch(error => console.error("Error:", error));
                    });
                });


                document.addEventListener("DOMContentLoaded", function() {
                    const viewButtons = document.querySelectorAll(".view-prisoner");
                    const modal = document.getElementById("view-prisoner-modal");
                    const closeModalButtons = document.querySelectorAll(".close-modal, .modal-background");

                    viewButtons.forEach(button => {
                        button.addEventListener("click", function(event) {
                            event.preventDefault(); // Prevent unintended navigation

                            const prisonerId = this.getAttribute("data-id");
                            if (!prisonerId) {
                                console.error("No prisoner ID found!");
                                return;
                            }

                            fetch(`/prisoners/${prisonerId}`) // Fetch prisoner details dynamically
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById("view-prisoner-id").textContent = data.id || "N/A";
                                    document.getElementById("view-prison-id").textContent = data.prison_id || "N/A";
                                    document.getElementById("view-first-name").textContent = data.first_name || "N/A";
                                    document.getElementById("view-middle-name").textContent = data.middle_name || "N/A";
                                    document.getElementById("view-last-name").textContent = data.last_name || "N/A";
                                    document.getElementById("view-dob").textContent = data.dob || "N/A";
                                    document.getElementById("view-sex").textContent = data.gender || "N/A";
                                    document.getElementById("view-address").textContent = data.address || "N/A";
                                    document.getElementById("view-marital-status").textContent = data.marital_status || "N/A";
                                    document.getElementById("view-crime-committed").textContent = data.crime_committed || "N/A";
                                    document.getElementById("view-status").textContent = data.status || "N/A";
                                    document.getElementById("view-time-serve-start").textContent = data.time_serve_start || "N/A";
                                    document.getElementById("view-time-serve-end").textContent = data.time_serve_end || "N/A";
                                    document.getElementById("view-emergency-contact-name").textContent = data.emergency_contact_name || "N/A";
                                    document.getElementById("view-emergency-contact-relation").textContent = data.emergency_contact_relation || "N/A";
                                    document.getElementById("view-emergency-contact-number").textContent = data.emergency_contact_number || "N/A";
                                    document.getElementById("view-created-at").textContent = data.created_at || "N/A";
                                    document.getElementById("view-updated-at").textContent = data.updated_at || "N/A";

                                    document.getElementById("view-inmate-image").src = data.inmate_image || "#";

                                    modal.classList.add("is-active"); // Show modal
                                })
                                .catch(error => console.error("Error fetching prisoner data:", error));
                        });
                    });

                    // Close modal event listener
                    closeModalButtons.forEach(button => {
                        button.addEventListener("click", function() {
                            modal.classList.remove("is-active");
                        });
                    });

                    // Close modal when clicking outside modal content
                    document.querySelector(".modal-background").addEventListener("click", function() {
                        modal.classList.remove("is-active");
                    });
                });
            </script>

            <script>
                // Open the modal
                document.getElementById('open-modal').addEventListener('click', function() {
                    document.getElementById('addRequestModal').classList.add('is-active');
                });

                // Close the modal
                document.getElementById('close-modal').addEventListener('click', function() {
                    document.getElementById('addRequestModal').classList.remove('is-active');
                });

                // Close the modal if clicked outside the modal
                document.querySelector('.modal-background').addEventListener('click', function() {
                    document.getElementById('addRequestModal').classList.remove('is-active');
                });
            </script>


</body>

</html>