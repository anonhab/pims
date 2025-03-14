<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            @if ($prisoners->isEmpty())
            <p class="no-prisoners-message">No prisoners found to allocate.</p>
            @else

            <div class="content-header">
                <h2 class="title">Allocated Prisoners </h2>
            </div>

            <div class="content-body">
                <!-- Prisoner Cards Grid -->
                <div class="columns is-multiline">

                    @foreach($prisoners as $prisoner)
                    @if($prisoner->status !== 'released')
                    <div class="column is-12-mobile is-6-tablet is-4-desktop">
                        <div class="card prisoner-card has-shadow-hover">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">{{ $prisoner->name }}</p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner ID:</strong> {{ $prisoner->id }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner first name:</strong> {{ $prisoner->first_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Prisoner last name:</strong> {{ $prisoner->last_name }}
                                        </p>
                                        <p class="subtitle is-6">
                                            <strong>Crime:</strong> {{ $prisoner->crime_committed }}
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p><strong>Status:</strong> <span class="tag is-info">{{ ucfirst($prisoner->status) }}</span></p>
                                    <p><strong>Room Status:</strong> Yet Allocated</p>

                                    <div class="buttons are-small is-centered">
                                        <a href="javascript:void(0);"
                                            class="button is-primary is-rounded has-tooltip-right"data-tooltip="Allocate Room"onclick="openAllocateModal({{ $prisoner->id }})">
                                            <span class="icon"><i class="fa fa-bed"></i></span>
                                            <span>Allocate Room</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>

                <!-- Pagination Controls -->
                <div class="pagination is-centered" role="navigation" aria-label="pagination">
                    @if($prisoners->currentPage() > 1)
                    <a class="pagination-previous" href="{{ $prisoners->previousPageUrl() }}">Previous</a>
                    @else
                    <a class="pagination-previous is-disabled">Previous</a>
                    @endif

                    @if($prisoners->hasMorePages())
                    <a class="pagination-next" href="{{ $prisoners->nextPageUrl() }}">Next</a>
                    @else
                    <a class="pagination-next is-disabled">Next</a>
                    @endif

                    <ul class="pagination-list">
                        @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                        <li>
                            <a class="pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            @endif

        </div>
    </div>
    <!-- Modal for Allocating Room -->
    <div id="allocateRoomModal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <h3 class="title is-4">Allocate Room to Prisoner</h3>

                <!-- Form to allocate room -->
                <form action="{{ route('prisoner.allocate_room') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="modalPrisonerId">

                    <!-- Room selection -->
                    <div class="field">
                        <label class="label">Select Room</label>
                        <div class="control">
                            <div class="select">
                                <select name="room_id" required>
                                    <option value="">Select Room</option>
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="field is-grouped is-grouped-centered">
                        <div class="control">
                            <button class="button is-link" type="submit">Allocate</button>
                        </div>
                        <div class="control">
                            <button class="button is-light" type="button" onclick="closeAllocateModal()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="closeAllocateModal()"></button>
    </div>

    <script>
        // Function to open the allocation modal
        function openAllocateModal(prisonerId) {
            console.log("Prisoner ID received in JavaScript:", prisonerId); // Logging the received ID

            // Check if the prisonerId is a valid number (just for debugging)
            if (typeof prisonerId === "number" && !isNaN(prisonerId)) {
                // Set the prisoner ID in the hidden input field within the modal
                document.getElementById('modalPrisonerId').value = prisonerId;

                // Show the modal by adding the 'is-active' class
                document.getElementById('allocateRoomModal').classList.add('is-active');
            } else {
                console.error("Invalid prisoner ID:", prisonerId); // Log an error if the ID is invalid
            }
        }

        // Function to close the modal
        function closeAllocateModal() {
            // Hide the modal by removing the 'is-active' class
            document.getElementById('allocateRoomModal').classList.remove('is-active');
        }
    </script>


    @include('includes.footer_js')

    <script>
        // JavaScript for modal or actions can be added here
    </script>

    <style>
        .prisoner-card {
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .prisoner-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }

        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 24px;
            border-radius: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>

</body>

</html>