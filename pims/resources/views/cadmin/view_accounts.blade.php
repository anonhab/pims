<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    
    <!--  NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
       @include('cadmin.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
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
                        <!-- Table Section -->
                        <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prison</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Date of Birth</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach($accounts as $account)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $account->prison_id }}</td>
            <td>{{ $account->username }}</td>
            <td>{{ $account->first_name }}</td>
            <td>{{ $account->last_name }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->phone_number }}</td>
            <td>{{ $account->dob }}</td>
            <td>{{ $account->address }}</td>
            <td>{{ $account->role ? $account->role->name : 'N/A' }}</td>
            <td>{{ $account->gender }}</td>
            <td>
                @if($account->user_image)
                    <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image" class="rounded-image">
                @else
                    <img src="{{ asset('default-profile.png') }}" alt="Default Image" width="50" height="50">
                @endif
            </td>
            <td class="has-text-centered">
                <div class="field is-grouped action">
                    <p class="control">
                        <a href="#" class="button is-rounded is-text">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </p>
                    <p class="control">
                    <button class="button is-rounded is-text action-delete" data-id="{{ $account->user_id }}">
                        <span class="icon">
                            <i class="fa fa-trash"></i>
                        </span>
                    </button>
                </p>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer_js')
</body>

</html>