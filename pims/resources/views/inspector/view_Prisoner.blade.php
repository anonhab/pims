<!DOCTYPE html>
<html>

@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">


<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-body">
                <div class="card">
                    <!-- Filters & Actions -->
                    <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="search-prisoner" type="text" placeholder="Search for prisoners...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field has-addons">
                            <p class="control">
                                <a class="button is-primary" href="{{ route('prisoner.add') }}">
                                    <span class="icon"><i class="fa fa-plus"></i></span>
                                    <span>Create Prisoner</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button" id="reload-prisoners">
                                    <span class="icon"><i class="fa fa-refresh"></i></span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="card-content">
    <!-- Prisoner Cards -->
    <div class="columns is-multiline">
        @if($prisoners->isEmpty())
            <p class="has-text-centered has-text-grey">No Prisoners</p>
        @else
            @foreach($prisoners as $prisoner)
            <div class="column is-12-mobile is-6-tablet is-4-desktop">
                <div class="card prisoner-card has-shadow-hover">
                    <div class="card-content">
                        <!-- Prisoner Details -->
                        <div class="media">
                            <div class="media-left">
                                <!-- Profile Image -->
                                <figure class="image is-48x48">
                                    <img src="{{ asset('storage/' .$prisoner->inmate_image) }}" alt="Profile Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-5">
                                    {{ $prisoner->first_name }} {{ $prisoner->last_name }}
                                </p>
                                <p class="subtitle is-6">
                                    <strong>Prisoner ID:</strong> {{ $prisoner->id }}
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <p><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                            <p><strong>Sex:</strong> {{ ucfirst($prisoner->gender) }}</p>

                            <p>
                                <strong>Status:</strong>
                                <span class="tag 
                                    {{ $prisoner->status == 'Active' ? 'is-success' : 
                                       ($prisoner->status == 'Inactive' ? 'is-danger' : 'is-info') }}">
                                    {{ ucfirst($prisoner->status) }}
                                </span>
                            </p>

                            <!-- Action Buttons -->
                            <div class="buttons are-small is-centered">
                                <!-- Trigger View Prisoner Modal -->
                                <a href="#" class="button is-rounded is-text view-prisoner" data-id="{{ $prisoner->id }}">
                                    <span class="icon"><i class="fa fa-eye"></i></span>
                                    <span>View</span>
                                </a>

                                <a href="#" class="button is-danger is-rounded has-tooltip-right action-delete"
                                    data-id="{{ $prisoner->prisoner_id }}" data-tooltip="Delete Record">
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                    <span>Delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    @if(!$prisoners->isEmpty())
        <!-- Pagination -->
        <div class="pagination is-centered" role="navigation" aria-label="pagination">
            <!-- Previous Button -->
            <a class="pagination-previous {{ $prisoners->currentPage() > 1 ? '' : 'is-disabled' }}"
                href="{{ $prisoners->previousPageUrl() ?? '#' }}">
                Previous
            </a>

            <!-- Next Button -->
            <a class="pagination-next {{ $prisoners->hasMorePages() ? '' : 'is-disabled' }}"
                href="{{ $prisoners->nextPageUrl() ?? '#' }}">
                Next
            </a>

            <!-- Page Numbers -->
            <ul class="pagination-list">
                @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                <li>
                    <a class="pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}"
                        href="{{ $url }}">
                        {{ $page }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

                    <!-- Modal Structure -->
                   <!-- Prisoner Details Modal -->
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
                        <img id="view-inmate-image" class="is-rounded" src="" alt="Prisoner Image">
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

                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
    const viewButtons = document.querySelectorAll(".view-prisoner");
    const modal = document.getElementById("view-prisoner-modal");
    const closeModalButtons = document.querySelectorAll(".close-modal, .modal-background");

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
                    document.getElementById("view-prisoner-id").textContent = data.id || "N/A";

                    // ✅ Fetch and display the actual prison name
                    document.getElementById("view-prison-id").textContent = data.prison_name || "N/A";

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

                    // Set image source if available
                    document.getElementById("view-inmate-image").src = data.inmate_image ?
                        '/storage/' + data.inmate_image :
                        '#';

                    modal.classList.add("is-active");
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

        @include('includes.footer_js')
</body>

</html>