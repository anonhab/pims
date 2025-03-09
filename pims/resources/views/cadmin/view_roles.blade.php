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
                <!-- Main Card Section -->
                <div class="card">
                    <!-- Card Header for search and filters -->
                    <div class="card-header">
                        <div class="card-header-title">Manage Roles</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="columns">
                            <!-- Filter Column -->
                            <div class="column is-4">
                                <!-- Search Input -->
                                <div class="field">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" id="table-search" type="text" placeholder="Search for roles...">
                                        <span class="icon is-left">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination / Table Length -->
                            <div class="column is-3">
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
                            </div>

                            <!-- Action Buttons -->
                            <div class="column is-3">
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-primary" href="{{ url('roles') }}">
                                            <span class="icon is-small">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            <span>Create Role</span>
                                        </a>
                                    </p>
                                    <p class="control">
                                        <a class="button is-light" id="table-reload">
                                            <span class="icon is-small">
                                                <i class="fa fa-refresh"></i>
                                            </span>
                                            <span>Reload</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card for Table Section -->
                        <div class="card">
                            <div class="card-content">
                                <div class="table-container">
                                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Role Name</th>
                                                <th>Description</th>
                                                <th class="has-text-centered">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $index => $role)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->description }}</td>
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
                                                                <form action="#" method="POST" class="delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="button is-rounded is-text">
                                                                        <span class="icon">
                                                                            <i class="fa fa-trash"></i>
                                                                        </span>
                                                                    </button>
                                                                </form>
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
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
</body>

</html>
