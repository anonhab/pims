<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
       @include('visitor.menu')

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
                                    <th>Visitor Name</th>
                                    <th>Contact Information</th>
                                    <th>Relationship to Prisoner</th>
                                    <th>Prisoner Information</th>
                                    <th>Requested Visiting Date</th>
                                    <th>Requested Visiting Time</th>
                                    <th>Status</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>Michael Johnson</td>
                                    <td>+1234567890</td>
                                    <td>Brother</td>
                                    <td>John Doe</td>
                                    <td>20/02/2025</td>
                                    <td>14:00</td>
                                    <td>Pending</td>
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
                                                <a class="button is-rounded is-text action-delete" data-id="1">
                                                    <span class="icon">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </a>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr>
                                    <td>2</td>
                                    <td>Sarah Williams</td>
                                    <td>+0987654321</td>
                                    <td>Mother</td>
                                    <td>Jane Smith</td>
                                    <td>25/02/2025</td>
                                    <td>10:30</td>
                                    <td>Pending</td>
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
                                                <a class="button is-rounded is-text action-delete" data-id="2">
                                                    <span class="icon">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </a>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        @include('includes.footer_js')
</body>

</html>