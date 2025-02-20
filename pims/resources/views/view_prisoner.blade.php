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
                                    <option>1</option>
                                    <option>2</option>
                               
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
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Birthday</th>
                                    <th>Sex</th>
                                    <th>Marital Status</th>
                                    <th>Address</th>
                                    <th>Emergency Contact</th>
                                    <th>Relation</th>
                                    <th>Emergency Contact Number</th>
                                    <th>Time Serve Start</th>
                                    <th>Time Serve Ends</th>
                                    <th>Crime Committed</th>
                                    <th>Inmate Image</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>John</td>
                                    <td>Michael</td>
                                    <td>Doe</td>
                                    <td>1990-05-15</td>
                                    <td>Male</td>
                                    <td>Married</td>
                                    <td>123 Main St, City</td>
                                    <td>Jane Doe</td>
                                    <td>Spouse</td>
                                    <td>+1234567890</td>
                                    <td>2020-01-01</td>
                                    <td>2025-01-01</td>
                                    <td>Theft</td>
                                    <td>
                                        <img src="path/to/image1.jpg" alt="Inmate Image" width="50" height="50">
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
                                    <td>Alice</td>
                                    <td>Marie</td>
                                    <td>Smith</td>
                                    <td>1985-08-20</td>
                                    <td>Female</td>
                                    <td>Single</td>
                                    <td>456 Elm St, Town</td>
                                    <td>John Smith</td>
                                    <td>Brother</td>
                                    <td>+0987654321</td>
                                    <td>2019-06-01</td>
                                    <td>2024-06-01</td>
                                    <td>Assault</td>
                                    <td>
                                        <img src="path/to/image2.jpg" alt="Inmate Image" width="50" height="50">
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
                                                <a class="button is-rounded is-text action-delete" data-id="2">
                                                    <span class="icon">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </a>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr>
                                    <td>3</td>
                                    <td>Bob</td>
                                    <td>James</td>
                                    <td>Johnson</td>
                                    <td>1975-12-10</td>
                                    <td>Male</td>
                                    <td>Divorced</td>
                                    <td>789 Oak St, Village</td>
                                    <td>Alice Johnson</td>
                                    <td>Friend</td>
                                    <td>+1122334455</td>
                                    <td>2018-03-15</td>
                                    <td>2023-03-15</td>
                                    <td>Fraud</td>
                                    <td>
                                        <img src="path/to/image3.jpg" alt="Inmate Image" width="50" height="50">
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
                                                <a class="button is-rounded is-text action-delete" data-id="3">
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