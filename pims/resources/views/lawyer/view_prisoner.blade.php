<!DOCTYPE html>
<html>

@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* 📌 Prisoner List Grid */
    #prisoner-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    /* 🏛️ Prisoner Card Styling */
    .prisoner-card {
        width: 100%;
        max-width: 350px;
        background: rgba(255, 255, 255, 0.3);
        /* Glassmorphism effect */
        backdrop-filter: blur(10px);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .prisoner-card:hover {
        transform: translateY(-8px);
        box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
    }

    /* 🖼️ Prisoner Image */
    .prisoner-card .card-image {
        background: linear-gradient(to right, #2b5876, #4e4376);
        padding: 25px;
        text-align: center;
    }

    .prisoner-card .card-image img {
        border-radius: 50%;
        object-fit: cover;
        width: 130px;
        height: 130px;
        border: 5px solid rgba(255, 255, 255, 0.5);
        transition: transform 0.3s ease-in-out;
    }

    .prisoner-card:hover .card-image img {
        transform: scale(1.05);
    }

    /* 📋 Prisoner Details */
    .prisoner-card .card-content {
        padding: 20px;
        text-align: center;
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
    }

    .prisoner-card .card-content .title {
        font-size: 1.3rem;
        color: #2b5876;
        font-weight: bold;
    }

    .prisoner-card .card-content p {
        font-size: 1rem;
        color: #555;
        margin: 6px 0;
    }

    /* 🏷️ Status Tags */
    .prisoner-card .tag {
        font-size: 0.9rem;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 12px;
    }

    /* 🏁 Card Footer */
    .prisoner-card .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #2b5876;
        padding: 12px;
    }

    .prisoner-card .card-footer a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: opacity 0.3s ease-in-out;
    }

    .prisoner-card .card-footer a:hover {
        opacity: 0.8;
    }
</style>

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header"></div>

            <!-- Flash Messages -->
            <div class="columns">
                <div class="column is-12">
                    @foreach (['success', 'error', 'warning', 'info'] as $msg)
                    @if(session($msg))
                    <div class="notification is-{{ $msg === 'success' ? 'success' : ($msg === 'error' ? 'danger' : ($msg === 'warning' ? 'warning' : 'info')) }}">
                        {{ session($msg) }}
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-content">
                        <!-- 🔍 Search & Filter Section -->
                        <div class="columns is-multiline">
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" id="search-input" type="text" placeholder="Search prisoners...">
                                        <span class="icon is-left">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!-- 🗂 Prisoner Cards -->
                        <div class="columns is-multiline" id="prisoner-list">
                            @foreach ($prisoners as $prisoner)
                            <div class="column is-4 prisoner-card" data-status="{{ $prisoner->status }}">
                                <div class="card has-shadow">
                                    <div class="card-image has-text-centered">
                                        <figure class="image is-128x128 is-inline-block is-rounded">
                                            <img src="{{ asset('storage/' . $prisoner->inmate_image) }}" alt="Prisoner Image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <p class="title is-5">{{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}</p>
                                        
                                        <p><strong>Status:</strong>
                                            <span class="tag is-light 
                                                @if ($prisoner->status == 'Active') is-success
                                                @elseif ($prisoner->status == 'Inactive') is-danger
                                                @else is-info @endif">
                                                {{ $prisoner->status }}
                                            </span>
                                        </p>
                                        <p><strong>Prison:</strong> {{ optional($prisoner->prison)->name ?? 'N/A' }}</p>

                                    </div>
                                    <footer class="card-footer">
                                        <a href="#" class="card-footer-item view-prisoner"
                                            data-id="{{ $prisoner->id }}"
                                            data-name="{{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}"
                                            data-crime="{{ $prisoner->crime_committed }}"
                                            data-sex="{{ $prisoner->gender }}"
                                            data-status="{{ $prisoner->status }}"
                                            data-image="{{ asset('storage/' . $prisoner->inmate_image) }}">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="pagination is-centered" role="navigation" aria-label="pagination">
                            <!-- Previous Button -->
                            <a class="pagination-previous {{ $prisoners->currentPage() > 1 ? '' : 'is-disabled' }}"
                                href="{{ $prisoners->previousPageUrl() ?? '#' }}">
                                Previous
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

                            <!-- Next Button -->
                            <a class="pagination-next {{ $prisoners->hasMorePages() ? '' : 'is-disabled' }}"
                                href="{{ $prisoners->nextPageUrl() ?? '#' }}">
                                Next
                            </a>
                        </div>


                    </div>
                </div>
            </div>

            <<div class="modal" id="view-prisoner-modal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Prisoner Details</p>
                        <button class="delete close-modal" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <div class="columns">
                            <div class="column is-half">
                                <p><strong>Name:</strong> <span id="view-name"></span></p>
                                <p><strong>Crime Committed:</strong> <span id="view-crime"></span></p>
                                <p><strong>Sex:</strong> <span id="view-sex"></span></p>
                                <p><strong>Status:</strong> <span id="view-status"></span></p>
                            </div>
                            <div class="column is-half has-text-centered">
                                <figure class="image is-128x128 is-inline-block">
                                    <img id="view-image" src="#" alt="Inmate Image">
                                </figure>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-light close-modal">Close</button>
                    </footer>
                </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.addEventListener('click', function(event) {
                    let target = event.target.closest('.view-prisoner'); // Ensure event delegation works
                    if (!target) return;

                    document.getElementById('view-name').textContent = target.dataset.name;
                    document.getElementById('view-crime').textContent = target.dataset.crime;
                    document.getElementById('view-sex').textContent = target.dataset.sex;
                    document.getElementById('view-status').textContent = target.dataset.status;
                    document.getElementById('view-image').src = target.dataset.image;

                    document.getElementById('view-prisoner-modal').classList.add('is-active');
                });

                // Close modal
                document.querySelectorAll('.close-modal, .modal-background').forEach(element => {
                    element.addEventListener('click', () => {
                        document.getElementById('view-prisoner-modal').classList.remove('is-active');
                    });
                });
            });
        </script>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let searchInput = document.getElementById('search-input');
            let statusFilter = document.getElementById('status-filter');
            let prisonerCards = document.querySelectorAll('.prisoner-card');
            let prisonerList = document.getElementById('prisoner-list');

            function filterPrisoners() {
                let query = searchInput.value.toLowerCase();
                let status = statusFilter.value;
                let visibleCards = 0;

                prisonerCards.forEach(card => {
                    let name = card.querySelector('.title').textContent.toLowerCase();
                    let crime = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
                    let prisonerStatus = card.dataset.status;

                    let matchesSearch = name.includes(query) || crime.includes(query);
                    let matchesStatus = status === '' || prisonerStatus === status;

                    if (matchesSearch && matchesStatus) {
                        card.style.display = 'flex';
                        visibleCards++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show 'No Data Found' if no prisoners match
                let noDataMessage = document.getElementById('no-data-message');
                if (!noDataMessage) {
                    noDataMessage = document.createElement('p');
                    noDataMessage.id = 'no-data-message';
                    noDataMessage.className = 'has-text-centered has-text-danger is-size-5';
                    noDataMessage.textContent = 'No Data Found';
                    prisonerList.appendChild(noDataMessage);
                }

                noDataMessage.style.display = visibleCards === 0 ? 'block' : 'none';
            }

            // Attach event listeners
            searchInput.addEventListener('input', filterPrisoners);
            statusFilter.addEventListener('change', filterPrisoners);
        });
    </script>

    </script>
    @include('includes.footer_js')
</body>

</html>