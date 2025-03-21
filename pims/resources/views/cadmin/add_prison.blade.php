<!DOCTYPE html>
@include('includes.head')

<body>

    
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

                    
                    <form action="{{ route('prison.store') }}" method="POST">
                    <div class="columns is-centered">

                    </div>
                        @csrf
                        <div class="columns is-centered">
                            
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Add Prison</p>

                                        <div class="field">
                                            <label class="label">Prison Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="name" required placeholder="Enter prison name">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Location</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="location" required>
                                                        <option value="">Select Location</option>
                                                        <option value="Worabe">Worabe</option>
                                                        <option value="silte">silte</option>
                                                        <option value="kembat">kembat</option>
                                                        <option value="gurage">gurage</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Capacity</label>
                                            <div class="control">
                                                <input class="input" type="number" name="capacity" required placeholder="Enter capacity">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="field is-grouped is-grouped-centered">
                            <div class="control">
                                <button class="button is-link" type="submit">Add Prison</button>
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