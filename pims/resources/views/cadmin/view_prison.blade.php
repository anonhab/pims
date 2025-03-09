<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('cadmin.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
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
                        <div class="field">
                            <div class="select">
                                <select id="table-length">
                                    <option value="1">10</option>
                                    <option value="2">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button is-primary" href="#" id="open-modal"">
                                    <span class=" icon is-small">
                                    <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Create Record</span>
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
                        <!-- Enhanced Grid Layout for Prison Cards -->
                        <div class="columns is-multiline">
                            @foreach($prisons as $prison)
                            <div class="column is-12-mobile is-6-tablet is-4-desktop">
                                <div class="card prison-card has-shadow-hover">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-left">
                                                
                                            </div>
                                            <div class="media-content">
                                                <p class="title is-5">{{ $prison->name }}</p>
                                                <p class="subtitle is-6">{{ $prison->location }}</p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p><strong>Capacity:</strong> {{ $prison->capacity }}</p>
                                            <div class="buttons are-small is-centered">
                                                <p class="control">
                                                    <a href="#" class="button is-link is-rounded has-tooltip-right" data-tooltip="Edit Record">
                                                        <span class="icon">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                        <span>Edit</span>
                                                    </a>
                                                </p>
                                                <p class="control">
                                                    <a href="#" class="button is-danger is-rounded has-tooltip-right action-delete" data-id="{{ $prison->id }}" data-tooltip="Delete Record">
                                                        <span class="icon">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        <span>Delete</span>
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
                            @if($prisons->currentPage() > 1)
                            <a class="pagination-previous" href="{{ $prisons->previousPageUrl() }}">Previous</a>
                            @else
                            <a class="pagination-previous is-disabled" href="#">Previous</a>
                            @endif

                            <!-- Next Button -->
                            @if($prisons->hasMorePages())
                            <a class="pagination-next" href="{{ $prisons->nextPageUrl() }}">Next</a>
                            @else
                            <a class="pagination-next is-disabled" href="#">Next</a>
                            @endif

                            <!-- Page Numbers -->
                            <ul class="pagination-list">
                                @foreach($prisons->getUrlRange(1, $prisons->lastPage()) as $page => $url)
                                <li>
                                    <a class="pagination-link {{ $page == $prisons->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="addPrisonModal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box has-background-white-bis">
                    <p class="title is-4 has-text-centered">Add Prison</p>

                    <form action="{{ route('prison.store') }}" method="POST">
                        @csrf
                        <!-- Prison Details -->
                        <div class="columns is-centered">
                            <div class="column is-half">
                                <div class="field">
                                    <label class="label">Prison Name</label>
                                    <div class="control">
                                        <input class="input is-primary is-rounded" type="text" name="name" required placeholder="Enter prison name">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Location</label>
                                    <div class="control">
                                        <div class="select is-fullwidth is-primary is-rounded">
                                            <select name="location" required>
                                                <option value="">Select Location</option>
                                                <option value="Addis Ababa">Addis Ababa</option>
                                                <option value="Bahir Dar">Bahir Dar</option>
                                                <option value="Gondar">Gondar</option>
                                                <option value="Adama">Adama</option>
                                                <option value="Hawassa">Hawassa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Capacity</label>
                                    <div class="control">
                                        <input class="input is-primary is-rounded" type="number" name="capacity" required placeholder="Enter capacity">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="field is-grouped is-grouped-centered">
                            <div class="control">
                                <button class="button is-link is-rounded" type="submit">Add Prison</button>
                            </div>
                            <div class="control">
                                <button class="button is-light is-rounded" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close" id="close-modal"></button>
        </div>

    </div>
    @include('includes.footer_js')
</body>

</html>
<script>
    // Open the modal
    document.getElementById('open-modal').addEventListener('click', function() {
        document.getElementById('addPrisonModal').classList.add('is-active');
    });

    // Close the modal
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('addPrisonModal').classList.remove('is-active');
    });

    // Close the modal if clicked outside the modal
    document.querySelector('.modal-background').addEventListener('click', function() {
        document.getElementById('addPrisonModal').classList.remove('is-active');
    });
</script>

<style>
    /* Hover effect on cards */
    .has-shadow-hover:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Tooltip styling */
    .has-tooltip-right::after {
        content: attr(data-tooltip);
        position: absolute;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.3s ease-in-out;
    }

    .has-tooltip-right:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* Pagination Styles */
    .pagination-list {
        display: flex;
        gap: 5px;
    }

    .pagination-link {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        color: #4a4a4a;
        font-weight: bold;
    }

    .pagination-link.is-current {
        background-color: #209cee;
        color: white;
    }

    .pagination-previous,
    .pagination-next {
        padding: 0.5rem 1rem;
        font-weight: bold;
    }

    .pagination-previous.is-disabled,
    .pagination-next.is-disabled {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }
</style>