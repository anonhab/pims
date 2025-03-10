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
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="{{ route('account.add') }}">
                                    <span class="icon is-small">
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
                        <!-- Enhanced Grid Layout for Account Cards -->
                        <div class="columns is-multiline">
                            @foreach($accounts as $account)
                            <div class="column is-12-mobile is-6-tablet is-4-desktop">
                                <div class="card account-card has-shadow-hover">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-left">
                                                <figure class="image is-48x48">
                                                    @if($account->user_image)
                                                        <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image" class="is-rounded">
                                                    @else
                                                        <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="is-rounded">
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="media-content">
                                                <p class="title is-5">{{ $account->username }}</p>
                                                <p class="subtitle is-6">{{ $account->role ? $account->role->name : 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p><strong>Prison:</strong> {{ $account->prison_id }}</p>
                                            <p><strong>First Name:</strong> {{ $account->first_name }}</p>
                                            <p><strong>Last Name:</strong> {{ $account->last_name }}</p>
                                            <p><strong>Email:</strong> {{ $account->email }}</p>
                                            <p><strong>Phone:</strong> {{ $account->phone_number }}</p>
                                            <p><strong>Date of Birth:</strong> {{ $account->dob }}</p>
                                            <p><strong>Address:</strong> {{ $account->address }}</p>
                                            <p><strong>Gender:</strong> {{ $account->gender }}</p>
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
                                                    <button class="button is-danger is-rounded has-tooltip-right action-delete" data-id="{{ $account->user_id }}" data-tooltip="Delete Record">
                                                        <span class="icon">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        <span>Delete</span>
                                                    </button>
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
                            @if($accounts->currentPage() > 1)
                            <a class="pagination-previous" href="{{ $accounts->previousPageUrl() }}">Previous</a>
                            @else
                            <a class="pagination-previous is-disabled" href="#">Previous</a>
                            @endif

                            <!-- Next Button -->
                            @if($accounts->hasMorePages())
                            <a class="pagination-next" href="{{ $accounts->nextPageUrl() }}">Next</a>
                            @else
                            <a class="pagination-next is-disabled" href="#">Next</a>
                            @endif

                            <!-- Page Numbers -->
                            <ul class="pagination-list">
                                @foreach($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                                <li>
                                    <a class="pagination-link {{ $page == $accounts->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
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

    </div>

    @include('includes.footer_js')
</body>

</html>


