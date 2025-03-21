<!DOCTYPE html>
<html>
    @include('includes.head')

    <body>
        <!-- Navigation -->
        @include('includes.nav')

        <div class="columns" id="app-content">
            @include('inspector.menu')

            <div class="column is-10" id="page-content">
                <div class="column is-12">
                    <!-- Flash Messages -->
                    @foreach (['success', 'error', 'warning', 'info'] as $msg)
                        @if(session($msg))
                            <div class="notification is-{{ $msg }}">
                                {{ session($msg) }}
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="content-header"></div>

                <section class="section">
                    <div class="container">
                       

                        <form method="POST" action="{{ route('lawyers.lstore') }}">
                            @csrf

                            <div class="columns">
                                <!-- Lawyer Profile Information -->
                                <div class="column is-half">
                                    <div class="card">
                                        <div class="card-content">
                                            <p class="title is-4">Lawyer Profile</p>

                                            <!-- Personal Information -->
                                            @foreach ([
                                                'first_name' => 'First Name',
                                                'last_name' => 'Last Name',
                                                'date_of_birth' => 'Date of Birth',
                                                'contact_info' => 'Contact Information',
                                                'email' => 'Email Address',
                                                'password' => 'Password',
                                                'law_firm' => 'Law Firm',
                                                'license_number' => 'License Number',
                                                'cases_handled' => 'Cases Handled'
                                            ] as $name => $label)
                                                <div class="field">
                                                    <label class="label">{{ $label }}</label>
                                                    <div class="control">
                                                        <input 
                                                            class="input" 
                                                            type="{{ $name === 'password' ? 'password' : ($name === 'date_of_birth' ? 'date' : 'text') }}" 
                                                            name="{{ $name }}" 
                                                            placeholder="Enter {{ strtolower($label) }}" 
                                                            {{ in_array($name, ['first_name', 'last_name', 'date_of_birth', 'contact_info', 'email', 'password', 'license_number', 'cases_handled']) ? 'required' : '' }}>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <input type="hidden" name="prison" value="{{ session('prison_id') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="field is-grouped is-grouped-right">
                                <div class="control">
                                    <button class="button is-link" type="submit">Assign Lawyer</button>
                                </div>
                                <div class="control">
                                    <button class="button is-light" type="reset">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer_js')
    </body>
</html>
