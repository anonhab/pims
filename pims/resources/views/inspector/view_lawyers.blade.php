<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header"></div>
            <div class="content-body">
                <div class="card">
                    <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="search-lawyer" type="text" placeholder="Search for records...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" id="reload-lawyers">
                                    <span class="icon is-small">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="columns is-multiline">
                            @foreach($lawyers as $lawyer)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-5">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</p>
                                                <p class="subtitle is-6"><i class="fa fa-envelope"></i> {{ $lawyer->email }}</p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p><strong>Law Firm:</strong> {{ $lawyer->law_firm ?? 'N/A' }}</p>
                                            <p><strong>License Number:</strong> {{ $lawyer->license_number }}</p>
                                            <p><strong>Cases Handled:</strong> {{ $lawyer->cases_handled }}</p>
                                            <p><strong>Contact:</strong> {{ $lawyer->contact_info }}</p>
                                            <p><strong>Date of Birth:</strong> {{ $lawyer->date_of_birth }}</p>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <a href="#" class="card-footer-item edit-btn"
                                            data-id="{{ $lawyer->lawyer_id }}"
                                            data-firstname="{{ $lawyer->first_name }}"
                                            data-lastname="{{ $lawyer->last_name }}"
                                            data-email="{{ $lawyer->email }}"
                                            data-lawfirm="{{ $lawyer->law_firm }}"
                                            data-license="{{ $lawyer->license_number }}"
                                            data-cases="{{ $lawyer->cases_handled }}"
                                            data-contact="{{ $lawyer->contact_info }}"
                                            data-dob="{{ $lawyer->date_of_birth }}">
                                            <span class="icon"><i class="fa fa-edit"></i></span> Edit
                                        </a>

                                        @if(isset($lawyer->lawyer_id))
                                        <form action="{{ route('lawyers.destroy', $lawyer->lawyer_id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this lawyer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-danger">
                                                <span class="icon"><i class="fa fa-trash"></i></span> Delete
                                            </button>
                                        </form>
                                        @endif

                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="editModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Lawyer</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form id="editForm" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="lawyer_id" id="lawyerId">

                        <div class="field"><label class="label">First Name</label>
                            <div class="control"><input class="input" type="text" name="first_name" id="editFirstName"></div>
                        </div>
                        <div class="field"><label class="label">Last Name</label>
                            <div class="control"><input class="input" type="text" name="last_name" id="editLastName"></div>
                        </div>
                        <div class="field"><label class="label">Email</label>
                            <div class="control"><input class="input" type="email" name="email" id="editEmail"></div>
                        </div>
                        <div class="field"><label class="label">Law Firm</label>
                            <div class="control"><input class="input" type="text" name="law_firm" id="editLawFirm"></div>
                        </div>
                        <div class="field"><label class="label">License Number</label>
                            <div class="control"><input class="input" type="text" name="license_number" id="editLicenseNumber"></div>
                        </div>
                        <div class="field"><label class="label">Cases Handled</label>
                            <div class="control"><input class="input" type="text" name="cases_handled" id="editCasesHandled"></div>
                        </div>
                        <div class="field"><label class="label">Contact Info</label>
                            <div class="control"><input class="input" type="text" name="contact_info" id="editContact"></div>
                        </div>
                        <div class="field"><label class="label">Date of Birth</label>
                            <div class="control"><input class="input" type="date" name="date_of_birth" id="editDOB"></div>
                        </div>
                        <button type="submit" class="button is-primary">Save Changes</button>
                    </form>
                </section>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('editModal');
            const closeModal = modal.querySelector('.delete');
            const editForm = document.getElementById('editForm');

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let lawyerId = this.dataset.id;

                    editForm.action = `/lawyers/${lawyerId}`;
                    document.getElementById('lawyerId').value = lawyerId;
                    document.getElementById('editFirstName').value = this.dataset.firstname;
                    document.getElementById('editLastName').value = this.dataset.lastname;
                    document.getElementById('editEmail').value = this.dataset.email;
                    document.getElementById('editLawFirm').value = this.dataset.lawfirm;
                    document.getElementById('editLicenseNumber').value = this.dataset.license;
                    document.getElementById('editCasesHandled').value = this.dataset.cases;
                    document.getElementById('editContact').value = this.dataset.contact;
                    document.getElementById('editDOB').value = this.dataset.dob;
                    modal.classList.add('is-active');
                });
            });

            closeModal.addEventListener('click', () => modal.classList.remove('is-active'));
        });
    </script>

        @include('includes.footer_js')
</body>

</html>