<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
       @include('includes.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Prisoners</h4>  
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
                                <a class="button" href="#">
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
                                    <th>Prison Name</th>
                                    <th>Location</th>
                                    <th>Capacity</th>
                                    <th>Managed By</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Additional Notes</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($prisons as $index => $prison)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $prison->name }}</td>
                            <td>{{ $prison->location }}</td>
                            <td>{{ $prison->capacity }}</td>
                            <td>{{ $prison->managed_by }}</td>
                            <td>{{ $prison->contact_phone }}</td>
                            <td>{{ $prison->contact_email }}</td>
                            <td>{{ $prison->additional_notes }}</td>
                            <td class="has-text-centered">
                                <div class="field is-grouped action">
                                    <p class="control">
                                        <a href=" #" class="button is-rounded is-text">
                                            <span class="icon">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </a>
                                    </p>
                                    <p class="control">
                                        <a href=" #" class="button is-rounded is-text action-delete" data-id="{{ $prison->id }}">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </a>
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