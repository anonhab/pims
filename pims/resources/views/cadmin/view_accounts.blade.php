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
                                <div class="card room-card account-card has-shadow-hover">
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
                                            <p><strong>Prison:</strong> {{ $account->prison ? $account->prison->name:'N/A' }}</p>
                                            <p><strong>First Name:</strong> {{ $account->first_name }}</p>
                                            <p><strong>Last Name:</strong> {{ $account->last_name }}</p>
                                            <p><strong>Email:</strong> {{ $account->email }}</p>
                                            <p><strong>Phone:</strong> {{ $account->phone_number }}</p>
                                            <p><strong>Date of Birth:</strong> {{ $account->dob }}</p>
                                            <p><strong>Address:</strong> {{ $account->address }}</p>
                                            <p><strong>Gender:</strong> {{ $account->gender }}</p>
                                            <div class="buttons are-small is-centered">
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
                                            <form action="{{ route('caccount.destroy', $account->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this account?');">
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

    @include('includes.footer_js')
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

</body>

</html>


