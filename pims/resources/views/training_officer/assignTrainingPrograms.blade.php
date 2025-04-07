<!DOCTYPE html>
@include('includes.head')
    <body>
        
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('training_officer.menu')
            <div class="column is-10" id="page-content">
                    <div class="content-header">
               
    </div>

    <section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Assign Training Program</h1>
        <form action="{{ route('assign_training.store') }}" method="POST">
    @csrf

    <div class="columns">
        <!-- Assignment Information -->
        <div class="column is-half">
            <div class="card">
                <div class="card-content">
                    <p class="title is-4">Assignment Information</p>

                    <!-- Prisoner -->
                    <div class="field">
                        <label class="label">Prisoner</label>
                        <div class="control">
                            <div class="select is-fullwidth @error('prisoner_id') is-danger @enderror">
                                <select name="prisoner_id" required>
                                    <option value="">Select a Prisoner</option>
                                    @foreach($prisoners as $prisoner)
                                        <option value="{{ $prisoner->id }}" {{ old('prisoner_id') == $prisoner->id ? 'selected' : '' }}>
                                            {{ $prisoner->first_name }} id {{ $prisoner->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('prisoner_id')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Training Program -->
                    <div class="field">
                        <label class="label">Training Program</label>
                        <div class="control">
                            <div class="select is-fullwidth @error('training_id') is-danger @enderror">
                                <select name="training_id" required>
                                    <option value="">Select a Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}" {{ old('training_id') == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('training_id')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assigned By -->
                    <input type="hidden" name="assigned_by" value="{{ session('user_id') }}">

                    <!-- Assigned Date -->
                    <div class="field">
                        <label class="label">Assigned Date</label>
                        <div class="control">
                            <input class="input @error('assigned_date') is-danger @enderror" type="date" name="assigned_date" value="{{ old('assigned_date') }}" required>
                        </div>
                        @error('assigned_date')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="field">
                        <label class="label">Status</label>
                        <div class="control">
                            <div class="select @error('status') is-danger @enderror">
                                <select name="status" required>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        @error('status')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Submit and Reset Buttons -->
    <div class="field is-grouped is-grouped-right mt-3">
        <div class="control">
            <button class="button is-link" type="submit">Assign</button>
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
