<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Room Management</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims-primary: #1a2a3a;
            --pims-secondary: #2c3e50;
            --pims-accent: #2980b9;
            --pims-danger: #c0392b;
            --pims-success: #27ae60;
            --pims-warning: #d35400;
            --pims-text-light: #ecf0f1;
            --pims-text-dark: #2c3e50;
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --pims-border-radius: 6px;
            --pims-nav-height: 60px;
            --pims-sidebar-width: 250px;
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
            line-height: 1.6;
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims-nav-height);
        }

        .pims-sidebar {
            width: var(--pims-sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--pims-nav-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
            transition: var(--pims-transition);
        }

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Header Styles */
        .pims-content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-content-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
        }

        .pims-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        /* Room Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-room-card {
            transition: var(--pims-transition);
            cursor: pointer;
        }

        .pims-room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-room-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-room-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-room-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-room-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-status-available {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-occupied {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .pims-status-under_maintenance {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.9rem;
        }

        .pims-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: var(--pims-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-warning {
            background-color: var(--pims-warning);
            color: white;
        }

        .pims-btn-warning:hover {
            background-color: #b3470a;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Modal Styles */
        .pims-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            
            transition: opacity 0.3s ease, backdrop-filter 0.3s ease;
            backdrop-filter: blur(0px);
            overflow-y: auto;
            padding: 2rem 0;
        }

        .pims-modal.is-active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            opacity: 1;
            backdrop-filter: blur(3px);
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .pims-modal.is-active .pims-modal-card {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .pims-modal-card-head {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(41, 128, 185, 0.15) 0%, rgba(41, 128, 185, 0.1) 100%);
            color: var(--pims-primary);
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(41, 128, 185, 0.2);
        }

        .pims-modal-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: var(--pims-primary);
            font-size: 1.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            line-height: 1;
            padding: 0.5rem;
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pims-modal-close:hover {
            transform: rotate(90deg);
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims-modal-card-body {
            padding: 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims-modal-card-foot {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background-color: #f8f9fa;
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pims-pagination-link {
            padding: 0.5rem 0.75rem;
            border-radius: var(--pims-border-radius);
            border: 1px solid #ddd;
            color: var(--pims-primary);
            font-weight: 600;
            transition: var(--pims-transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-pagination-link:hover {
            background-color: var(--pims-accent);
            color: white;
            border-color: var(--pims-accent);
            transform: translateY(-2px);
        }

        .pims-pagination-link.is-current {
            background-color: var(--pims-primary);
            color: white;
            border-color: var(--pims-primary);
        }

        .pims-pagination-link.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Floating Action Button */
        .pims-fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 100;
            transition: var(--pims-transition);
        }

        .pims-fab:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-sidebar {
                transform: translateX(-100%);
            }

            .pims-sidebar.is-active {
                transform: translateX(0);
            }

            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('police_officer.menu')

        <div class="pims-content-area">
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-door-closed"></i> Room Management
                    </h2>
                    <div class="pims-card-actions">
                        <button id="pims-reload-rooms" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="pims-btn pims-btn-primary" onclick="pimsOpenCreateModal()">
                            <i class="fas fa-plus"></i> Add Room
                        </button>
                    </div>
                </div>
                <div class="pims-card-body">
                    <!-- Room Cards Grid -->
                    <div class="pims-grid">
                        @foreach($rooms as $room)
                        <div class="pims-room-card">
                            <div class="pims-card">
                                <div class="pims-card-body">
                                    <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                        <div class="media-content">
                                            <p class="pims-room-title">Room {{ $room->room_number }}</p>
                                            <p class="pims-room-subtitle">
                                                <strong>Type:</strong> {{ ucfirst($room->type) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="pims-room-detail"><strong>Capacity:</strong> {{ $room->capacity ?? 'N/A' }}</p>
                                        <p class="pims-room-detail">
                                            <strong>Status:</strong> 
                                            <span class="pims-status-badge 
                                                @if($room->status == 'available') pims-status-available
                                                @elseif($room->status == 'occupied') pims-status-occupied
                                                @else pims-status-under_maintenance @endif">
                                                {{ ucfirst($room->status) }}
                                            </span>
                                        </p>
                                        <p class="pims-room-detail"><strong>Created At:</strong> {{ $room->created_at->format('M d, Y H:i') }}</p>
                                        <p class="pims-room-detail"><strong>Updated At:</strong> {{ $room->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="pims-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                    <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <button class="pims-btn pims-btn-warning pims-btn-sm pims-edit-room"
                                            data-id="{{ $room->id }}"
                                            data-room-number="{{ $room->room_number }}"
                                            data-capacity="{{ $room->capacity }}"
                                            data-type="{{ $room->type }}"
                                            data-status="{{ $room->status }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="pims-btn pims-btn-danger pims-btn-sm pims-delete-room"
                                            data-id="{{ $room->id }}"
                                            data-room-number="{{ $room->room_number }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pims-pagination">
                        <!-- Previous Button -->
                        @if($rooms->currentPage() > 1)
                        <a class="pims-pagination-link" href="{{ $rooms->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($rooms->getUrlRange(1, $rooms->lastPage()) as $page => $url)
                        <a class="pims-pagination-link {{ $page == $rooms->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        <!-- Next Button -->
                        @if($rooms->hasMorePages())
                        <a class="pims-pagination-link" href="{{ $rooms->nextPageUrl() }}">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button class="pims-fab pims-btn-primary" onclick="pimsOpenCreateModal()">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Room Creation Modal -->
    <div class="pims-modal" id="pims-create-room-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-door-open"></i> Create New Room
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-create-room-modal')">&times;</button>
            </header>
            <form action="{{ route('room.store') }}" method="POST">
                @csrf
                <section class="pims-modal-card-body">
                    <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">

                    <div class="pims-form-group">
                        <label class="pims-form-label">Room Number</label>
                        <input class="pims-form-control" type="text" name="room_number" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Capacity</label>
                        <input class="pims-form-control" type="number" name="capacity">
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Type</label>
                        <select class="pims-form-control" name="type">
                            <option value="cell">Cell</option>
                            <option value="medical">Medical</option>
                            <option value="security">Security</option>
                            <option value="training">Training</option>
                        </select>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="under_maintenance">Under Maintenance</option>
                        </select>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-create-room-modal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Room Edit Modal -->
    <div class="pims-modal" id="pims-edit-room-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-edit"></i> Edit Room
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-edit-room-modal')">&times;</button>
            </header>
            <form id="pims-edit-room-form" method="POST">
                @csrf
                @method('PUT')
                <section class="pims-modal-card-body">
                    <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">

                    <div class="pims-form-group">
                        <label class="pims-form-label">Room Number</label>
                        <input class="pims-form-control" type="text" name="room_number" id="pims-edit-room-number" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Capacity</label>
                        <input class="pims-form-control" type="number" name="capacity" id="pims-edit-room-capacity">
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Type</label>
                        <select class="pims-form-control" name="type" id="pims-edit-room-type">
                            <option value="cell">Cell</option>
                            <option value="medical">Medical</option>
                            <option value="security">Security</option>
                            <option value="training">Training</option>
                        </select>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status" id="pims-edit-room-status">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="under_maintenance">Under Maintenance</option>
                        </select>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-edit-room-modal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-room-modal">
        <div class="pims-modal-card" style="max-width: 400px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-delete-room-modal')">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <div style="text-align: center;">
                    <div class="pims-confirm-icon">
                        <i class="fas fa-trash-alt" style="font-size: 2.5rem; color: var(--pims-danger);"></i>
                    </div>
                    <p class="pims-confirm-message">
                        Are you sure you want to delete room <strong id="pims-delete-room-number"></strong>?
                        This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="pims-modal-card-foot" style="justify-content: center;">
                <button class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-delete-room-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-delete-room-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pims-btn pims-btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize delete buttons
            document.querySelectorAll('.pims-delete-room').forEach(button => {
                button.addEventListener('click', function() {
                    const roomId = this.getAttribute('data-id');
                    const roomNumber = this.getAttribute('data-room-number');
                    
                    document.getElementById('pims-delete-room-number').textContent = roomNumber;
                    document.getElementById('pims-delete-room-form').action = `/rooms/${roomId}`;
                    document.getElementById('pims-delete-room-modal').classList.add('is-active');
                });
            });

            // Initialize edit buttons
            document.querySelectorAll('.pims-edit-room').forEach(button => {
                button.addEventListener('click', function() {
                    const roomId = this.getAttribute('data-id');
                    const roomNumber = this.getAttribute('data-room-number');
                    const capacity = this.getAttribute('data-capacity');
                    const type = this.getAttribute('data-type');
                    const status = this.getAttribute('data-status');
                    
                    // Set form action
                    document.getElementById('pims-edit-room-form').action = `/rooms/${roomId}`;
                    
                    // Populate form fields
                    document.getElementById('pims-edit-room-number').value = roomNumber;
                    document.getElementById('pims-edit-room-capacity').value = capacity;
                    document.getElementById('pims-edit-room-type').value = type;
                    document.getElementById('pims-edit-room-status').value = status;
                    
                    // Show modal
                    document.getElementById('pims-edit-room-modal').classList.add('is-active');
                });
            });

            // Handle delete form submission
            document.getElementById('pims-delete-room-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                submitBtn.disabled = true;
                
                // Submit the form
                this.submit();
            });

            // Handle edit form submission
            document.getElementById('pims-edit-room-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                submitBtn.disabled = true;
                
                // Submit the form
                this.submit();
            });
        });

        function pimsOpenCreateModal() {
            document.getElementById('pims-create-room-modal').classList.add('is-active');
        }

        function pimsCloseModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>