<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('police_officer.menu')

        <div class="column is-10" id="page-content">
            
            <div class="content-header">
                <h2 class="title">Room Details</h2>
                <button class="button is-primary is-rounded" onclick="openModal()">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span>Add Room</span>
                </button>
            </div>

            <div class="content-body">
                <!-- Room Cards Grid -->
                <div class="columns is-multiline">
                    @foreach($rooms as $room)
                    <div class="column is-12-mobile is-6-tablet is-4-desktop">
                        <div class="card room-card has-shadow-hover">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">Room {{ $room->room_number }}</p>
                                        <p class="subtitle is-6">
                                            <strong>Type:</strong> {{ ucfirst($room->type) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p><strong>Capacity:</strong> {{ $room->capacity ?? 'N/A' }}</p>
                                    <p><strong>Status:</strong> <span class="tag is-info">{{ ucfirst($room->status) }}</span></p>
                                    <p><strong>Created At:</strong> {{ $room->created_at }}</p>
                                    <p><strong>Updated At:</strong> {{ $room->updated_at }}</p>
                                    <div class="buttons are-small is-centered">
                                        <a href="#" class="button is-link is-rounded has-tooltip-right" data-tooltip="Edit Room">
                                            <span class="icon">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>Edit</span>
                                        </a>
                                        <button class="button is-danger is-rounded has-tooltip-right action-delete" data-id="{{ $room->id }}" data-tooltip="Delete Room">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination Controls -->
                <div class="pagination is-centered" role="navigation" aria-label="pagination">
                    @if($rooms->currentPage() > 1)
                    <a class="pagination-previous" href="{{ $rooms->previousPageUrl() }}">Previous</a>
                    @else
                    <a class="pagination-previous is-disabled">Previous</a>
                    @endif

                    @if($rooms->hasMorePages())
                    <a class="pagination-next" href="{{ $rooms->nextPageUrl() }}">Next</a>
                    @else
                    <a class="pagination-next is-disabled">Next</a>
                    @endif

                    <ul class="pagination-list">
                        @foreach($rooms->getUrlRange(1, $rooms->lastPage()) as $page => $url)
                        <li>
                            <a class="pagination-link {{ $page == $rooms->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <!-- Floating Create Room Button -->
            <button class="button is-primary is-rounded fab" onclick="openModal()">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
            </button>

            <!-- Room Creation Modal -->
            <div class="modal" id="createRoomModal">
                <div class="modal-background" onclick="closeModal()"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Create New Room</p>
                        <button class="delete" aria-label="close" onclick="closeModal()"></button>
                    </header>
                    <form action="{{ route('room.store') }}" method="POST">
    @csrf
    <section class="modal-card-body">
        <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">

        <div class="field">
            <label class="label">Room Number</label>
            <div class="control">
                <input class="input" type="text" name="room_number" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Capacity</label>
            <div class="control">
                <input class="input" type="number" name="capacity">
            </div>
        </div>

        <div class="field">
            <label class="label">Type</label>
            <div class="control">
                <div class="select">
                    <select name="type">
                        <option value="cell">Cell</option>
                        <option value="medical">Medical</option>
                        <option value="security">Security</option>
                        <option value="training">Training</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Status</label>
            <div class="control">
                <div class="select">
                    <select name="status">
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="under_maintenance">Under Maintenance</option>
                    </select>
                </div>
            </div>
        </div>
        
    </section>
    <footer class="modal-card-foot">
        <button type="submit" class="button is-success">Save</button>
        <button type="button" class="button" onclick="closeModal()">Cancel</button>
    </footer>
</form>

                </div>
            </div>

        </div>
    </div>

    @include('includes.footer_js')

    <script>
        function openModal() {
            document.getElementById('createRoomModal').classList.add('is-active');
        }

        function closeModal() {
            document.getElementById('createRoomModal').classList.remove('is-active');
        }
    </script>

    <style>
       

        
    </style>

</body>

</html>
