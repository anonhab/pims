<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('visitor.menu')

        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered mb-6">Request Visiting Time</h1>

                    <form method="POST" action="{{ route('visitor.submitRequest') }}">
                        @csrf
                        <div class="columns is-centered">
                            <div class="column is-8">
                                <div class="card">
                                    <div class="card-content">
                                        <h2 class="title is-5 mb-4">Prisoner Information</h2>

                                        <div class="columns is-multiline">
                                            <div class="column is-half">
                                                <label class="label">Prisoner First Name</label>
                                                <input class="input" type="text" name="prisoner_firstname" placeholder="First Name" required>
                                            </div>
                                            <div class="column is-half">
                                                <label class="label">Prisoner Middle Name</label>
                                                <input class="input" type="text" name="prisoner_middlename" placeholder="Middle Name" required>
                                            </div>
                                            <div class="column is-half">
                                                <label class="label">Prisoner Last Name</label>
                                                <input class="input" type="text" name="prisoner_lastname" placeholder="Last Name" required>
                                            </div>
                                            <div class="column is-half">
                                                <label class="label">Select Prison</label>
                                                <div class="select is-fullwidth">
                                                    <select name="prison_id" required>
                                                        <option value="">-- Select Prison --</option>
                                                        @foreach($prisons as $prison)
                                                            <option value="{{ $prison->id }}">{{ $prison->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="column is-half">
                                                <label class="label">Requested Visiting Date</label>
                                                <input class="input" type="date" name="requested_date" required>
                                            </div>
                                            <div class="column is-half">
                                                <label class="label">Requested Visiting Time</label>
                                                <input class="input" type="time" name="requested_time" required>
                                            </div>
                                        </div>
                                    </div>

                                    <footer class="card-footer p-4">
                                        <div class="buttons is-right">
                                            <button type="submit" class="button is-link">Submit</button>
                                            <button type="reset" class="button is-light">Reset</button>
                                        </div>
                                    </footer>
                                </div>
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
