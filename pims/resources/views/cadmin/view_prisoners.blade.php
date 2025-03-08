<!DOCTYPE html>
<html>

@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">


<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('cadmin.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
             </div>
            {{-- Flash Messages --}}
            <div class="columns">
                <div class="column is-12">
                    {{-- Success Alert --}}
                    @if(session('success1'))
                    <div class="notification is-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Error Alert --}}
                    @if(session('error1'))
                    <div class="notification is-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Warning Alert --}}
                    @if(session('warning1'))
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
                                <a class="button" href="{{ route('prisoner.add') }}">
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
                        <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Sex</th>
                                    <th>Crime Committed</th>
                                    <th>Status</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="hidden-data" style="display:none;">#</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prisoners as $index => $prisoner)
                                <tr id="prisoner-row-{{ $prisoner->prisoner_id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $prisoner->first_name }}</td>
                                    <td>{{ $prisoner->middle_name }}</td>
                                    <td>{{ $prisoner->last_name }}</td>
                                    <td>{{ $prisoner->sex }}</td>
                                    <td>{{ $prisoner->crime_committed }}</td>
                                    <td class="status-cell">
                                    
                                        @if ($prisoner->status == 'Active')
                                        <span class="tag is-success">Active</span>
                                        @elseif ($prisoner->status == 'Inactive')
                                        <span class="tag is-danger">Inactive</span>
                                        @elseif ($prisoner->status == 'Released')
                                        <span class="tag is-info">Released</span>
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
                                                <a href="#" class="button is-rounded is-text view-prisoner" data-id="{{ $prisoner->prisoner_id }}">
                                                    <span class="icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
                                            </p>
                                            <p class="control">
                                                <select class="form-select action-status" data-id="{{ $prisoner->prisoner_id }}">
                                                    <option value="Active" {{ $prisoner->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Inactive" {{ $prisoner->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    <option value="Released" {{ $prisoner->status == 'Released' ? 'selected' : '' }}>Released</option>
                                                </select>
                                            </p>

                                        </div>
                                    </td>
                                    <!-- Hidden details -->
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->prison_id }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->dob }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->address }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->marital_status }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->time_serve_start }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->time_serve_end }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->emergency_contact_name }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->emergency_contact_relation }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->emergency_contact_number }}</td>
                                    <td class="hidden-data" style="display:none;">{{ asset('storage/' . $prisoner->inmate_image) }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->created_at }}</td>
                                    <td class="hidden-data" style="display:none;">{{ $prisoner->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal for Viewing Prisoner Data -->
            <div class="modal" id="view-prisoner-modal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title is-size-4 has-text-weight-bold">Prisoner Details</p>
                        <button class="delete" aria-label="close" id="close-modal"></button>
                    </header>
                    <section class="modal-card-body">
                        <div id="prisoner-details">
                            <div class="columns is-mobile">
                                <!-- Left Side: Details -->
                                <div class="column is-half">
                                    <p><strong>Prisoner ID:</strong> <span id="view-prisoner-id"></span></p>
                                    <p><strong>Prison ID:</strong> <span id="view-prison-id"></span></p>
                                    <p><strong>First Name:</strong> <span id="view-first-name"></span></p>
                                    <p><strong>Middle Name:</strong> <span id="view-middle-name"></span></p>
                                    <p><strong>Last Name:</strong> <span id="view-last-name"></span></p>
                                    <p><strong>Date of Birth:</strong> <span id="view-dob"></span></p>
                                    <p><strong>Sex:</strong> <span id="view-sex"></span></p>
                                    <p><strong>Address:</strong> <span id="view-address"></span></p>
                                    <p><strong>Marital Status:</strong> <span id="view-marital-status"></span></p>
                                    <p><strong>Crime Committed:</strong> <span id="view-crime-committed"></span></p>
                                    <p><strong>Status:</strong> <span id="view-status"></span></p>
                                    <p><strong>Time Serve Start:</strong> <span id="view-time-serve-start"></span></p>
                                    <p><strong>Time Serve End:</strong> <span id="view-time-serve-end"></span></p>
                                    <p><strong>Emergency Contact Name:</strong> <span id="view-emergency-contact-name"></span></p>
                                    <p><strong>Emergency Contact Relation:</strong> <span id="view-emergency-contact-relation"></span></p>
                                    <p><strong>Emergency Contact Number:</strong> <span id="view-emergency-contact-number"></span></p>
                                    <p><strong>Created At:</strong> <span id="view-created-at"></span></p>
                                    <p><strong>Updated At:</strong> <span id="view-updated-at"></span></p>
                                </div>

                                <!-- Right Side: Inmate Image -->
                                <div class="column is-half">
                                    <div class="has-text-centered">
                                        <img id="view-inmate-image" src="#" alt="Inmate Image" class="image is-4by3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button" id="close-modal-footer">Close</button>
                    </footer>
                </div>
            </div>


            <script>
                
                document.addEventListener('DOMContentLoaded', function() {
                    // Get all "View" buttons
                    const viewButtons = document.querySelectorAll('.view-prisoner');
                    const modal = document.getElementById('view-prisoner-modal');
                    const closeModalButtons = document.querySelectorAll('#close-modal, #close-modal-footer');

                    // Add event listeners to "View" buttons
                    viewButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const prisonerId = this.getAttribute('data-id');
                            console.log('View button clicked for prisoner ID:', prisonerId);

                            // Fetch prisoner row and hidden data
                            const prisonerRow = document.getElementById(`prisoner-row-${prisonerId}`);
                            if (prisonerRow) {
                                const hiddenData = prisonerRow.querySelectorAll('.hidden-data');
                                const prisonerData = {
                                    prisonerId: prisonerRow.querySelector('td:nth-child(1)').textContent,
                                    prisonId: hiddenData[0].textContent,
                                    firstName: prisonerRow.querySelector('td:nth-child(2)').textContent,
                                    middleName: prisonerRow.querySelector('td:nth-child(3)').textContent,
                                    lastName: prisonerRow.querySelector('td:nth-child(4)').textContent,
                                    dob: hiddenData[1].textContent,
                                    sex: prisonerRow.querySelector('td:nth-child(5)').textContent,
                                    address: hiddenData[2].textContent,
                                    maritalStatus: hiddenData[3].textContent,
                                    crimeCommitted: prisonerRow.querySelector('td:nth-child(6)').textContent,
                                    status: prisonerRow.querySelector('.status-cell').textContent,
                                    timeServeStart: hiddenData[4].textContent,
                                    timeServeEnd: hiddenData[5].textContent,
                                    emergencyContactName: hiddenData[6].textContent,
                                    emergencyContactRelation: hiddenData[7].textContent,
                                    emergencyContactNumber: hiddenData[8].textContent,
                                    inmateImage: hiddenData[9].textContent, // Get inmate image URL
                                    createdAt: hiddenData[10].textContent,
                                    updatedAt: hiddenData[11].textContent
                                };

                                // Populate modal with prisoner data
                                document.getElementById('view-prisoner-id').textContent = prisonerData.prisonerId;
                                document.getElementById('view-prison-id').textContent = prisonerData.prisonId;
                                document.getElementById('view-first-name').textContent = prisonerData.firstName;
                                document.getElementById('view-middle-name').textContent = prisonerData.middleName;
                                document.getElementById('view-last-name').textContent = prisonerData.lastName;
                                document.getElementById('view-dob').textContent = prisonerData.dob;
                                document.getElementById('view-sex').textContent = prisonerData.sex;
                                document.getElementById('view-address').textContent = prisonerData.address;
                                document.getElementById('view-marital-status').textContent = prisonerData.maritalStatus;
                                document.getElementById('view-crime-committed').textContent = prisonerData.crimeCommitted;
                                document.getElementById('view-status').textContent = prisonerData.status;
                                document.getElementById('view-time-serve-start').textContent = prisonerData.timeServeStart;
                                document.getElementById('view-time-serve-end').textContent = prisonerData.timeServeEnd;
                                document.getElementById('view-emergency-contact-name').textContent = prisonerData.emergencyContactName;
                                document.getElementById('view-emergency-contact-relation').textContent = prisonerData.emergencyContactRelation;
                                document.getElementById('view-emergency-contact-number').textContent = prisonerData.emergencyContactNumber;
                                document.getElementById('view-created-at').textContent = prisonerData.createdAt;
                                document.getElementById('view-updated-at').textContent = prisonerData.updatedAt;

                                // Set the prisoner image in the modal
                                document.getElementById('view-inmate-image').src = prisonerData.inmateImage;

                                // Open the modal
                                modal.classList.add('is-active');
                            }
                        });
                    });

                    // Add event listeners to close buttons
                    closeModalButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            modal.classList.remove('is-active');
                        });
                    });

                    // Close modal when clicking outside the modal
                    modal.querySelector('.modal-background').addEventListener('click', function() {
                        modal.classList.remove('is-active');
                    });
                });
            </script>

        </div>

        @include('includes.footer_js')
</body>

</html>