<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            
            <div class="content-header">
                <h2 class="title">Allocated Prisoners Details</h2>
            </div>

            <div class="content-body">
                <!-- Prisoner Cards Grid -->
                <div class="columns is-multiline">
                    @foreach($prisoners as $prisoner)
                    <div class="column is-12-mobile is-6-tablet is-4-desktop">
                        <div class="card prisoner-card has-shadow-hover">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">{{ $prisoner->name }}</p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner ID:</strong> {{ $prisoner->id }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner first_name:</strong> {{ $prisoner->first_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner last name:</strong> {{ $prisoner->last_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Crime:</strong> {{ $prisoner->crime_committed }}
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p><strong>Status:</strong> <span class="tag is-info">{{ ucfirst($prisoner->status) }}</span></p>
                                    <p><strong>Room ID:</strong> {{ $prisoner->room_id ?? 'N/A' }}</p>
                                    <p><strong>Room Number:</strong> {{ $prisoner->room->room_number ?? 'N/A' }}</p>
                                    <div class="buttons are-small is-centered">
                                        <a href="#" class="button is-link is-rounded has-tooltip-right" data-tooltip="Edit Prisoner">
                                            <span class="icon">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>Edit</span>
                                        </a>
                                        <button class="button is-danger is-rounded has-tooltip-right action-delete" data-id="{{ $prisoner->id }}" data-tooltip="Delete Prisoner">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination Controls -->
                <div class="pagination is-centered" role="navigation" aria-label="pagination">
                    @if($prisoners->currentPage() > 1)
                    <a class="pagination-previous" href="{{ $prisoners->previousPageUrl() }}">Previous</a>
                    @else
                    <a class="pagination-previous is-disabled">Previous</a>
                    @endif

                    @if($prisoners->hasMorePages())
                    <a class="pagination-next" href="{{ $prisoners->nextPageUrl() }}">Next</a>
                    @else
                    <a class="pagination-next is-disabled">Next</a>
                    @endif

                    <ul class="pagination-list">
                        @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                        <li>
                            <a class="pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>
    </div>

    @include('includes.footer_js')

    <script>
        // JavaScript for modal or actions can be added here
    </script>

    <style>
        .prisoner-card {
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .prisoner-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }

        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 24px;
            border-radius: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>

</body>

</html>
