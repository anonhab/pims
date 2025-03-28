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
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="{{ route('saccount.add') }}">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Create Record</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="columns is-multiline">
                            @if($accounts->isEmpty())
                            <div class="notification is-warning has-text-centered">
                                No accounts found.
                            </div>
                            @else
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
                                            <p><strong>Prison:</strong> {{ $account->prison ? $account->prison->name:'N/A' }}</p>
                                            <p><strong>Username:</strong> {{ $account->username }}</p>
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
                                            <button class="button is-small is-link edit-btn"
                                                data-id="{{ $account->user_id }}"
                                                data-first-name="{{ $account->first_name }}"
                                                data-last-name="{{ $account->last_name }}"
                                                data-email="{{ $account->email }}"
                                                data-phone="{{ $account->phone_number }}"
                                                data-address="{{ $account->address }}"
                                                data-role-id="{{ $account->role_id }}"
                                                data-role-name="{{ $account->role ? $account->role->name : 'N/A' }}">
                                                <span class="icon is-small">
                                                    <i class="fa fa-edit"></i>
                                                </span>
                                                Edit
                                            </button>

                                        </div>
                                        <div class="card-footer-item">
                                            <form action="{{ route('saccount.destroy', $account->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this account?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button is-small is-danger action-delete" data-id="{{ $account->id }}">
                                                    Delete
                                                </button>

                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            @endif
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
        <div class="modal" id="editModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Account</p>
                    <button class="delete close-modal" aria-label="close"></button>
                </header>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <section class="modal-card-body">
                        <input type="hidden" name="user_id" id="edit-user-id">

                        <div class="field">
                            <label class="label">First Name</label>
                            <div class="control">
                                <input class="input" type="text" name="first_name" id="edit-first-name">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Last Name</label>
                            <div class="control">
                                <input class="input" type="text" name="last_name" id="edit-last-name">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="email" id="edit-email">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Phone Number</label>
                            <div class="control">
                                <input class="input" type="text" name="phone_number" id="edit-phone">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Address</label>
                            <div class="control">
                                <input class="input" type="text" name="address" id="edit-address">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Role</label>
                            <div class="control">
                                <div class="select">
                                    <select name="role_id" id="edit-role">
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-success">Save Changes</button>
                        <button type="button" class="button close-modal">Cancel</button>
                    </footer>
                </form>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-btn');
                const modal = document.getElementById('editModal');
                const closeModalButtons = document.querySelectorAll('.close-modal');
                const editForm = document.getElementById('editForm');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.dataset.id;
                        const firstName = this.dataset.firstName;
                        const lastName = this.dataset.lastName;
                        const email = this.dataset.email;
                        const phone = this.dataset.phone;
                        const address = this.dataset.address;
                        const role = this.dataset.role;

                        document.getElementById('edit-user-id').value = userId;
                        document.getElementById('edit-first-name').value = firstName;
                        document.getElementById('edit-last-name').value = lastName;
                        document.getElementById('edit-email').value = email;
                        document.getElementById('edit-phone').value = phone;
                        document.getElementById('edit-address').value = address;
                        document.getElementById('edit-role').value = role;

                        editForm.action = `/saccount/update/${userId}`;

                        modal.classList.add('is-active');
                    });
                });

                closeModalButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        modal.classList.remove('is-active');
                    });
                });
            });
        </script>

        @include('includes.footer_js')
</body>

</html>