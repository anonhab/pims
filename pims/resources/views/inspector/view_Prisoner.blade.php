<!DOCTYPE html>
<html>
@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
    <!-- NAV -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('inspector.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <div class="pims-form-container">
            <div class="pims-form-card">
                <!-- Filters & Actions -->
                <div class="pims-card-filter">
                    <div class="pims-form-group">
                        <div class="pims-search-control has-icons-left">
                            <input class="pims-form-input" id="pims-search-prisoner" type="text" placeholder="Search for prisoners...">
                            <span class="pims-icon is-left">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>

                    <div class="pims-form-actions">
                        <a class="pims-btn pims-btn-primary" href="{{ route('prisoner.add') }}">
                            <span class="pims-icon"><i class="fas fa-plus"></i></span>
                            <span>Create Prisoner</span>
                        </a>
                        <a class="pims-btn pims-btn-secondary" id="pims-reload-prisoners">
                            <span class="pims-icon"><i class="fas fa-sync-alt"></i></span>
                            <span>Reload</span>
                        </a>
                    </div>
                </div>

                <div class="pims-card-content">
                    <!-- Prisoner Cards -->
                    <div class="pims-card-grid">
                        @if($prisoners->isEmpty())
                            <p class="pims-empty-state">No Prisoners Found</p>
                        @else
                            @foreach($prisoners as $prisoner)
                            <div class="pims-card">
                                <div class="pims-card-content">
                                    <!-- Prisoner Details -->
                                    <div class="pims-media">
                                        <div class="pims-media-left">
                                            <figure class="pims-image is-48x48">
                                                <img src="{{ asset('storage/' .$prisoner->inmate_image) }}" alt="Profile Image">
                                            </figure>
                                        </div>
                                        <div class="pims-media-content">
                                            <p class="pims-title">
                                                {{ $prisoner->first_name }} {{ $prisoner->last_name }}
                                            </p>
                                            <p class="pims-subtitle">
                                                <strong>Prisoner ID:</strong> {{ $prisoner->id }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="pims-content">
                                        <p><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                                        <p><strong>Sex:</strong> {{ ucfirst($prisoner->gender) }}</p>

                                        <p>
                                            <strong>Status:</strong>
                                            <span class="pims-tag 
                                                {{ $prisoner->status == 'Active' ? 'is-success' : 
                                                   ($prisoner->status == 'Inactive' ? 'is-danger' : 'is-info') }}">
                                                {{ ucfirst($prisoner->status) }}
                                            </span>
                                        </p>

                                        <!-- Action Buttons -->
                                        <div class="pims-action-buttons">
                                            <a href="#" class="pims-btn pims-btn-text pims-view-prisoner" data-id="{{ $prisoner->id }}">
                                                <span class="pims-icon"><i class="fas fa-eye"></i></span>
                                                <span>View</span>
                                            </a>

                                            <a href="#" class="pims-btn pims-btn-danger pims-action-delete"
                                                data-id="{{ $prisoner->prisoner_id }}" data-tooltip="Delete Record">
                                                <span class="pims-icon"><i class="fas fa-trash"></i></span>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    @if(!$prisoners->isEmpty())
                        <!-- Pagination -->
                        <div class="pims-pagination">
                            <!-- Previous Button -->
                            <a class="pims-pagination-previous {{ $prisoners->currentPage() > 1 ? '' : 'is-disabled' }}"
                                href="{{ $prisoners->previousPageUrl() ?? '#' }}">
                                Previous
                            </a>

                            <!-- Next Button -->
                            <a class="pims-pagination-next {{ $prisoners->hasMorePages() ? '' : 'is-disabled' }}"
                                href="{{ $prisoners->nextPageUrl() ?? '#' }}">
                                Next
                            </a>

                            <!-- Page Numbers -->
                            <ul class="pims-pagination-list">
                                @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                                <li>
                                    <a class="pims-pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}"
                                        href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Prisoner Details Modal -->
    <div class="pims-modal" id="pims-view-prisoner-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <p class="pims-modal-title">👤 Prisoner Details</p>
                <button class="pims-delete pims-close-modal" aria-label="close"></button>
            </header>

            <section class="pims-modal-body">
                <div class="pims-columns is-vcentered">
                    <!-- Prisoner Image -->
                    <div class="pims-column is-4 has-text-centered">
                        <figure class="pims-image is-150x150">
                            <img id="pims-view-inmate-image" class="pims-rounded" src="" alt="Prisoner Image">
                        </figure>
                        <p class="pims-image-caption">Prisoner Profile</p>
                    </div>

                    <!-- Prisoner Details -->
                    <div class="pims-column is-8">
                        <div class="pims-detail-box">
                            <div class="pims-columns">
                                <div class="pims-column is-6">
                                    <p><strong>🔢 ID:</strong> <span id="pims-view-prisoner-id">N/A</span></p>
                                    <p><strong>🏛️ Prison:</strong> <span id="pims-view-prison-id">N/A</span></p>
                                    <p><strong>📝 Name:</strong> <span id="pims-view-first-name">N/A</span> <span id="pims-view-middle-name">N/A</span> <span id="pims-view-last-name">N/A</span></p>
                                    <p><strong>📅 DOB:</strong> <span id="pims-view-dob">N/A</span></p>
                                    <p><strong>⚧️ Sex:</strong> <span id="pims-view-sex">N/A</span></p>
                                    <p><strong>📍 Address:</strong> <span id="pims-view-address">N/A</span></p>
                                </div>
                                <div class="pims-column is-6">
                                    <p><strong>💍 Marital Status:</strong> <span id="pims-view-marital-status">N/A</span></p>
                                    <p><strong>⚖️ Crime:</strong> <span id="pims-view-crime-committed">N/A</span></p>
                                    <p><strong>📌 Status:</strong> <span id="pims-view-status">N/A</span></p>
                                    <p><strong>⏳ Sentence:</strong> <span id="pims-view-time-serve-start">N/A</span> ➝ <span id="pims-view-time-serve-end">N/A</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="pims-contact-box">
                            <p class="pims-section-title">📞 Emergency Contact</p>
                            <p><strong>👤 Name:</strong> <span id="pims-view-emergency-contact-name">N/A</span></p>
                            <p><strong>🤝 Relation:</strong> <span id="pims-view-emergency-contact-relation">N/A</span></p>
                            <p><strong>📞 Number:</strong> <span id="pims-view-emergency-contact-number">N/A</span></p>
                        </div>
                    </div>
                </div>

                <div class="pims-meta-box">
                    <p><strong>📅 Created At:</strong> <span id="pims-view-created-at">N/A</span></p>
                    <p><strong>📝 Last Updated:</strong> <span id="pims-view-updated-at">N/A</span></p>
                </div>
            </section>

            <footer class="pims-modal-footer">
                <button class="pims-btn pims-btn-danger pims-close-modal">❌ Close</button>
            </footer>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <p class="pims-modal-title">⚠️ Confirm Deletion</p>
                <button class="pims-delete pims-close-modal" aria-label="close"></button>
            </header>

            <section class="pims-modal-body">
                <p>Are you sure you want to delete this prisoner record? This action cannot be undone.</p>
            </section>

            <footer class="pims-modal-footer">
                <button class="pims-btn pims-close-modal">Cancel</button>
                <button class="pims-btn pims-btn-danger" id="pims-confirm-delete">Delete</button>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // View Prisoner Modal
            const viewButtons = document.querySelectorAll(".pims-view-prisoner");
            const viewModal = document.getElementById("pims-view-prisoner-modal");
            const closeModalButtons = document.querySelectorAll(".pims-close-modal, .pims-modal-background");

            viewButtons.forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();

                    const prisonerId = this.getAttribute("data-id");
                    if (!prisonerId) {
                        console.error("No prisoner ID found!");
                        return;
                    }

                    fetch(`/prisoners/${prisonerId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the modal with prisoner data
                            document.getElementById("pims-view-prisoner-id").textContent = data.id || "N/A";
                            document.getElementById("pims-view-prison-id").textContent = data.prison_name || "N/A";
                            document.getElementById("pims-view-first-name").textContent = data.first_name || "N/A";
                            document.getElementById("pims-view-middle-name").textContent = data.middle_name || "N/A";
                            document.getElementById("pims-view-last-name").textContent = data.last_name || "N/A";
                            document.getElementById("pims-view-dob").textContent = data.dob || "N/A";
                            document.getElementById("pims-view-sex").textContent = data.gender || "N/A";
                            document.getElementById("pims-view-address").textContent = data.address || "N/A";
                            document.getElementById("pims-view-marital-status").textContent = data.marital_status || "N/A";
                            document.getElementById("pims-view-crime-committed").textContent = data.crime_committed || "N/A";
                            document.getElementById("pims-view-status").textContent = data.status || "N/A";
                            document.getElementById("pims-view-time-serve-start").textContent = data.time_serve_start || "N/A";
                            document.getElementById("pims-view-time-serve-end").textContent = data.time_serve_end || "N/A";
                            document.getElementById("pims-view-emergency-contact-name").textContent = data.emergency_contact_name || "N/A";
                            document.getElementById("pims-view-emergency-contact-relation").textContent = data.emergency_contact_relation || "N/A";
                            document.getElementById("pims-view-emergency-contact-number").textContent = data.emergency_contact_number || "N/A";
                            document.getElementById("pims-view-created-at").textContent = data.created_at || "N/A";
                            document.getElementById("pims-view-updated-at").textContent = data.updated_at || "N/A";

                            // Set image source if available
                            document.getElementById("pims-view-inmate-image").src = data.inmate_image ?
                                '/storage/' + data.inmate_image :
                                'https://via.placeholder.com/150';

                            viewModal.classList.add("is-active");
                        })
                        .catch(error => console.error("Error fetching prisoner data:", error));
                });
            });

            // Delete Confirmation Modal
            const deleteButtons = document.querySelectorAll(".pims-action-delete");
            const deleteModal = document.getElementById("pims-delete-modal");
            let prisonerToDelete = null;

            deleteButtons.forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    prisonerToDelete = this.getAttribute("data-id");
                    deleteModal.classList.add("is-active");
                });
            });

            // Confirm Delete Action
            document.getElementById("pims-confirm-delete").addEventListener("click", function() {
                if (prisonerToDelete) {
                    fetch(`/prisoners/${prisonerToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            console.error('Delete failed');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });

            // Close modal event listeners
            closeModalButtons.forEach(button => {
                button.addEventListener("click", function() {
                    viewModal.classList.remove("is-active");
                    deleteModal.classList.remove("is-active");
                });
            });

            // Reload button
            document.getElementById("pims-reload-prisoners").addEventListener("click", function() {
                window.location.reload();
            });

            // Search functionality
            document.getElementById("pims-search-prisoner").addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const cards = document.querySelectorAll(".pims-card");

                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    </script>

    <style>
        /* Additional Styles for Prisoner Management Page */
        .pims-card-filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
        }

        .pims-search-control {
            position: relative;
            width: 300px;
        }

        .pims-search-control .pims-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-secondary);
        }

        .pims-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--pims-accent);
        }

        .pims-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-card-content {
            padding: 1.5rem;
        }

        .pims-media {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .pims-media-left {
            margin-right: 1rem;
        }

        .pims-media-content {
            flex: 1;
        }

        .pims-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-subtitle {
            font-size: 0.875rem;
            color: var(--pims-secondary);
        }

        .pims-content {
            font-size: 0.9375rem;
            line-height: 1.5;
        }

        .pims-content p {
            margin-bottom: 0.5rem;
        }

        .pims-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }

        .pims-tag.is-success {
            background-color: var(--pims-success);
        }

        .pims-tag.is-danger {
            background-color: var(--pims-danger);
        }

        .pims-tag.is-info {
            background-color: var(--pims-accent);
        }

        .pims-action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
        }

        .pims-btn-text {
            background: transparent;
            color: var(--pims-accent);
            border: none;
        }

        .pims-btn-text:hover {
            background: rgba(41, 128, 185, 0.1);
        }

        .pims-empty-state {
            text-align: center;
            color: var(--pims-secondary);
            padding: 2rem;
            grid-column: 1 / -1;
        }

        /* Modal Styles */
        .pims-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .pims-modal.is-active {
            display: flex;
        }

        .pims-modal-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .pims-modal-card {
            position: relative;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            z-index: 1;
        }

        .pims-modal-header {
            padding: 1.5rem;
            background-color: var(--pims-primary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .pims-modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            flex: 1;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            background-color: #f8f9fa;
            border-bottom-left-radius: var(--pims-border-radius);
            border-bottom-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .pims-delete {
            background: none;
            border: none;
            height: 24px;
            width: 24px;
            position: relative;
            cursor: pointer;
        }

        .pims-delete::before, .pims-delete::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 2px;
            background-color: white;
        }

        .pims-delete::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .pims-delete::after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .pims-detail-box {
            background-color: #f8f9fa;
            padding: 1.25rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
        }

        .pims-contact-box {
            background-color: #e9ecef;
            padding: 1.25rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
        }

        .pims-meta-box {
            background-color: #f8f9fa;
            padding: 1.25rem;
            border-radius: var(--pims-border-radius);
        }

        .pims-section-title {
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1rem;
        }

        .pims-rounded {
            border-radius: 50%;
        }

        .pims-image-caption {
            font-size: 0.875rem;
            color: var(--pims-secondary);
            margin-top: 0.5rem;
        }

        /* Pagination Styles */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }

        .pims-pagination-previous,
        .pims-pagination-next {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            background-color: white;
            color: var(--pims-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pims-pagination-previous:hover,
        .pims-pagination-next:hover {
            border-color: var(--pims-accent);
            color: var(--pims-accent);
        }

        .pims-pagination-previous.is-disabled,
        .pims-pagination-next.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pims-pagination-list {
            display: flex;
            list-style: none;
            margin: 0 0.5rem;
            padding: 0;
        }

        .pims-pagination-link {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            background-color: white;
            color: var(--pims-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pims-pagination-link:hover {
            border-color: var(--pims-accent);
            color: var(--pims-accent);
        }

        .pims-pagination-link.is-current {
            background-color: var(--pims-accent);
            border-color: var(--pims-accent);
            color: white;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-card-filter {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .pims-search-control {
                width: 100%;
            }

            .pims-card-grid {
                grid-template-columns: 1fr;
            }

            .pims-modal-body .pims-columns {
                flex-direction: column;
            }

            .pims-modal-body .pims-column {
                width: 100% !important;
            }
        }
    </style>
</body>
</html>