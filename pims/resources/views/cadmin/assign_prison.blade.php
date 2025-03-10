<!DOCTYPE html>
@include('includes.head')

<body>

    <!-- NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('cadmin.menu')
      
        <div class="column is-10" id="page-content">
            <div class="content-header"></div>
             {{-- Flash Messages --}}
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

            <section class="section">
                
                <div class="container">
                    
                    <h1 class="title has-text-centered">Prison Assignment</h1>
                    <form action="{{ route('prison.assign') }}" method="POST">
                        @csrf
                        <div class="columns is-centered">
                            <!-- Prison Assignment Details -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Assign Prison to Admin</p>

                                        <div class="field">
                                            <label class="label">Prison</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="prison_id" required>
                                                        <option value="">Select Prison</option>
                                                        <!-- Loop through prisons to populate the options -->
                                                        @foreach($prisons as $prison)
                                                            <option value="{{ $prison->id }}">{{ $prison->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">System Administrator</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="system_admin_id" required>
                                                        <option value="">Select System Admin</option>
                                                        <!-- Loop through system admins to populate the options -->
                                                        @foreach($admins as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Assigned By</label>
                                            <div class="control">
                                                <input class="input" type="text" name="assigned_by" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="field is-grouped is-grouped-centered">
                            <div class="control">
                                <button class="button is-link" type="submit">Assign Prison</button>
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
