<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h1 class="title has-text-centered">View Requests</h1>
            </div>

            <section class="section">
                <div class="container">
                    <!-- Request Cards -->
                    <div class="columns is-multiline">
                        @foreach($requests as $request)
                        <div class="column is-12">
                            <div class="card has-shadow-small mb-4">
                                <div class="card-content">
                                    <div class="content">
                                        <h3 class="title is-4">{{ $request->request_type }} <span class="tag is-info is-small">Request #{{ $request->id }}</span></h3>
                                        <p><strong>Status:</strong>
                                            <span class="tag 
                                                @if($request->status == 'approved') is-success
                                                @elseif($request->status == 'pending') is-warning
                                                @else is-danger
                                                @endif">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Approved By:</strong> {{ $request->approved_by ?? 'N/A' }}</p>
                                        <p><strong>Request Details:</strong> {{ $request->request_details }}</p>
                                        <p><strong>Prisoner ID:</strong> {{ $request->prisoner_id }}</p>
                                        <p><strong>Date Created:</strong> {{ \Carbon\Carbon::parse($request->created_at)->format('d/m/Y H:i') }}</p>
                                        <p><strong>Date Updated:</strong> {{ \Carbon\Carbon::parse($request->updated_at)->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="field is-grouped is-grouped-right">
                                        <p class="control">
                                            <a href="#" class="button is-rounded is-info is-small">
                                                <span class="icon is-small">
                                                    <i class="fa fa-edit"></i>
                                                </span>
                                                <span>Edit</span>
                                            </a>
                                        </p>
                                        <p class="control">
                                            <a class="button is-rounded is-danger is-small action-delete" data-id="{{ $request->id }}">
                                                <span class="icon is-small">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                                <span>Delete</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    <div class="pagination is-centered" role="navigation" aria-label="pagination">
                        @if($requests->currentPage() > 1)
                        <a class="pagination-previous" href="{{ $requests->previousPageUrl() }}">Previous</a>
                        @else
                        <a class="pagination-previous is-disabled">Previous</a>
                        @endif

                        @if($requests->hasMorePages())
                        <a class="pagination-next" href="{{ $requests->nextPageUrl() }}">Next</a>
                        @else
                        <a class="pagination-next is-disabled">Next</a>
                        @endif

                        <ul class="pagination-list">
                            @foreach($requests->getUrlRange(1, $requests->lastPage()) as $page => $url)
                            <li>
                                <a class="pagination-link {{ $page == $requests->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')

</body>

</html>
