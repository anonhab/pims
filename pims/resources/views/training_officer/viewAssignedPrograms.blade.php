<!DOCTYPE html>
@include('includes.head')
<body>
    <!-- NAV -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('training_officer.menu')
        <div class="column is-10" id="page-content">
            <div class="content-header">
            </div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Assigned Training Programs</h1>

                    @if(session('success'))
                        <div class="notification is-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="columns is-multiline mt-5">
                        @forelse ($assignments as $assignment)
                        <div class="column is-4">
                            <div class="card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        @if($assignment->trainingProgram)
                                            {{ $assignment->trainingProgram->name }}
                                        @else
                                            Not assigned
                                        @endif
                                    </p>
                                </header>
                                <div class="card-content">
                                    <div class="content">
                                        <p><strong>Prisoner ID:</strong> {{ $assignment->prisoner_id }}</p>
                                        <p><strong>Program ID:</strong> {{ $assignment->training_id }}</p>
                                        <p><strong>Description:</strong> 
                                            @if($assignment->trainingProgram)
                                                {{ Str::limit($assignment->trainingProgram->description, 100) }}
                                            @else
                                                Not assigned
                                            @endif
                                        </p>
                                        <p><strong>Assigned By:</strong> {{ $assignment->assigned_by }}</p>
                                        <p><strong>Assigned Date:</strong> {{ $assignment->assigned_date }}</p>
                                        <p><strong>Status:</strong>
                                            <span class="tag is-{{ $assignment->status === 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($assignment->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Dates:</strong> 
                                            @if($assignment->trainingProgram)
                                                {{ $assignment->trainingProgram->start_date }} to {{ $assignment->trainingProgram->end_date }}
                                            @else
                                                Not assigned
                                            @endif
                                        </p>
                                        <p><strong>Prison ID:</strong> 
                                            @if($assignment->trainingProgram)
                                                {{ $assignment->trainingProgram->prison_id }}
                                            @else
                                                Not assigned
                                            @endif
                                        </p>
                                        <p class="has-text-grey">
                                            <small>Created: {{ $assignment->created_at->format('Y-m-d') }}</small><br>
                                            <small>Updated: {{ $assignment->updated_at->format('Y-m-d') }}</small>
                                        </p>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <div class="card-footer-item">
                                        <form action="{{ route('assign_training.unassign', $assignment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="button is-danger is-small is-fullwidth">
                                                <span class="icon">
                                                    <i class="fas fa-user-minus"></i>
                                                </span>
                                                <span>Unassign</span>
                                            </button>
                                        </form>
                                    </div>
                                </footer>
                            </div>
                        </div>
                        @empty
                        <div class="column">
                            <div class="notification is-warning">
                                No training assignments found.
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>