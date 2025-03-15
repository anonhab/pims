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
                        <!-- Search and controls -->
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="search-lawyer" type="text" placeholder="Search for records...">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
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
                        <!-- Card Section -->
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
                                        <a href="#" class="card-footer-item">
                                            <span class="icon"><i class="fa fa-edit"></i></span> Edit
                                        </a>
                                        <form action="#" method="POST" onsubmit="return confirm('Are you sure?');" class="card-footer-item">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-text">
                                                <span class="icon"><i class="fa fa-trash"></i></span> Delete
                                            </button>
                                        </form>
                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer_js')
    </div>
</body>

</html>
