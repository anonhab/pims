<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
       @include('inspector.menu')

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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date of Birth</th>
                                    <th>Contact Information</th>
                                    <th>Email Address</th>
                                    <th>Law Firm</th>
                                    <th>License Number</th>
                                    <th>Cases Handled</th>
                                    <th>Assigned Prisoner</th>
                                    <th>Assignment Date</th>
                                    <th>Assigned By</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>15/05/1985</td>
                                    <td>+1234567890</td>
                                    <td>john.doe@example.com</td>
                                    <td>Doe & Associates</td>
                                    <td>L123456</td>
                                    <td>50</td>
                                    <td>Prisoner A</td>
                                    <td>01/01/2023</td>
                                    <td>Admin Smith</td>
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
                                    <td>Jane</td>
                                    <td>Smith</td>
                                    <td>20/08/1990</td>
                                    <td>+0987654321</td>
                                    <td>jane.smith@example.com</td>
                                    <td>Smith & Partners</td>
                                    <td>L654321</td>
                                    <td>75</td>
                                    <td>Prisoner B</td>
                                    <td>15/03/2023</td>
                                    <td>Admin Johnson</td>
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
                                    <td>Johnson</td>
                                    <td>10/12/1975</td>
                                    <td>+1122334455</td>
                                    <td>bob.johnson@example.com</td>
                                    <td>Johnson Law Firm</td>
                                    <td>L987654</td>
                                    <td>100</td>
                                    <td>Prisoner C</td>
                                    <td>01/06/2023</td>
                                    <td>Admin Brown</td>
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