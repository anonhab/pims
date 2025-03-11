<!DOCTYPE html>
<html>

@include('includes.head')

<body>

    <!--  NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('sysadmin.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Accounts</h4>
            </div>
            <div class="columns">
                <div class="column is-12">
                    {{-- Success Alert --}}
                    @if(session('success'))
                    <div class="notification is-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Error Alert --}}
                    @if(session('error'))
                    <div class="notification is-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Warning Alert --}}
                    @if(session('warning'))
                    <div class="notification is-warning">
                        {{ session('warning') }}
                    </div>
                    @endif

                    {{-- Info Alert --}}
                    @if(session('info'))
                    <div class="notification is-info">
                        {{ session('info') }}
                    </div>
                    @endif
                </div>
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
                                <a class="button" href="{{ route('saccount.add') }}">
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
                        <!-- Card Section -->
                        <div class="columns is-multiline">
                            @foreach($accounts as $account)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-header-title">{{ $account->first_name }} {{ $account->last_name }}</p>
                                    </div>
                                    <div class="image-container">
                                        @if($account->user_image)
                                        <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image" class="rounded-image">
                                        @else
                                        <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="rounded-image">
                                        @endif
                                    </div>

                                    <div class="card-content">
                                        <div class="content">
                                        <p><strong>Prison:</strong> {{ $account->prison ? $account->prison->name:'N/A' }}</p>                                            <p><strong>Username:</strong> {{ $account->username }}</p>
                                            <p><strong>Email:</strong> {{ $account->email }}</p>
                                            <p><strong>Phone Number:</strong> {{ $account->phone_number }}</p>
                                            <p><strong>Date of Birth:</strong> {{ $account->dob }}</p>
                                            <p><strong>Address:</strong> {{ $account->address }}</p>

                                            <p><strong>Role:</strong> {{ $account->role ? $account->role->name : 'N/A' }}</p>

                                            <p><strong>Gender:</strong> {{ $account->gender }}</p>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="card-footer-item">
                                            <a href="#" class="button is-small is-link">Edit</a>
                                        </div>
                                        <div class="card-footer-item">
                                            <button class="button is-small is-danger action-delete" data-id="{{ $account->user_id }}">
                                                <span class="icon is-small">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('table-search');
                const accountCards = document.querySelectorAll('.card');

                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value.toLowerCase();

                    accountCards.forEach(function(card) {
                        const name = card.querySelector('.card-header-title').innerText.toLowerCase();
                        const email = card.querySelector('.content').innerText.toLowerCase();
                        const phoneNumber = card.querySelector('.content').innerText.toLowerCase();

                        // Filter logic: show card if name, email, or phone number matches the search term
                        if (name.includes(searchTerm) || email.includes(searchTerm) || phoneNumber.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        </script>

        @include('includes.footer_js')
</body>

</html>