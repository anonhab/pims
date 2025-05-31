<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Allocation</title>
    
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

        /* Prisoner Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-prisoner-card {
            transition: var(--pims-transition);
            cursor: pointer;
        }

        .pims-prisoner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-prisoner-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-prisoner-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-prisoner-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-prisoner-detail strong {
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

        .pims-status-active {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-inactive {
            background-color: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
        }

        .pims-status-pending {
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
            max-width: 800px;
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

        /* Empty State */
        .pims-empty-state {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            color: var(--pims-text-dark);
        }

        /* Prisoner Image */
        .pims-prisoner-image {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--pims-accent);
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
            @php
                $unallocatedPrisoners = $prisoners->filter(fn($prisoner) => $prisoner->status !== 'released' && is_null($prisoner->room_id));
            @endphp

            @if ($unallocatedPrisoners->isEmpty())
                <div class="pims-empty-state">
                    <i class="fas fa-user-slash" style="font-size: 3rem; color: var(--pims-accent); margin-bottom: 1rem;"></i>
                    <h3 class="pims-content-title">No prisoners found to allocate</h3>
                    <p>All prisoners have been assigned to rooms or have been released.</p>
                </div>
            @else
                <div class="pims-card">
                    <div class="pims-card-header">
                        <h2 class="pims-card-title">
                            <i class="fas fa-user-lock"></i> Unallocated Prisoners
                        </h2>
                        <div class="pims-card-actions">
                            <button id="pims-reload-prisoners" class="pims-btn pims-btn-secondary">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                    <div class="pims-card-body">
                        <!-- Prisoner Cards Grid -->
                        <div class="pims-grid">
                            @foreach($unallocatedPrisoners as $prisoner)
                            <div class="pims-prisoner-card">
                                <div class="pims-card">
                                    <div class="pims-card-body">
                                        <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <div class="media-left" style="margin-right: 1rem;">
                                                <figure class="image is-48x48">
                                                    @if($prisoner->inmate_image)
                                                        <img src="{{ asset('storage/' . $prisoner->inmate_image) }}" alt="Prisoner Image" class="pims-prisoner-image">
                                                    @else
                                                        <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="pims-prisoner-image">
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="media-content">
                                                <p class="pims-prisoner-title">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</p>
                                                <p class="pims-prisoner-subtitle">ID: {{ $prisoner->id }}</p>
                                                <span class="pims-status-badge 
                                                    @if($prisoner->status == 'active') pims-status-active
                                                    @elseif($prisoner->status == 'inactive') pims-status-inactive
                                                    @else pims-status-pending @endif">
                                                    {{ ucfirst($prisoner->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p class="pims-prisoner-detail"><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                                            <p class="pims-prisoner-detail"><strong>Gender:</strong> {{ ucfirst($prisoner->gender) }}</p>
                                            <p class="pims-prisoner-detail"><strong>Room Status:</strong> Not Allocated</p>
                                        </div>
                                    </div>
                                    <div class="pims-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                        <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                            <button class="pims-btn pims-btn-primary pims-btn-sm pims-view-prisoner" 
                                                data-id="{{ $prisoner->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <button class="pims-btn pims-btn-primary pims-btn-sm pims-allocate-room" 
                                                data-id="{{ $prisoner->id }}"
                                                data-name="{{ $prisoner->first_name }} {{ $prisoner->last_name }}">
                                                <i class="fas fa-bed"></i> Allocate
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
                            @if($prisoners->currentPage() > 1)
                            <a class="pims-pagination-link" href="{{ $prisoners->previousPageUrl() }}">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                            @else
                            <a class="pims-pagination-link is-disabled" href="#">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                            <a class="pims-pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                            @endforeach

                            <!-- Next Button -->
                            @if($prisoners->hasMorePages())
                            <a class="pims-pagination-link" href="{{ $prisoners->nextPageUrl() }}">
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
            @endif
        </div>
    </div>

    <!-- Prisoner Details Modal -->
    <div class="pims-modal" id="pims-view-prisoner-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-user-lock"></i> Prisoner Details
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-view-prisoner-modal')">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <div class="columns is-vcentered">
                    <!-- Prisoner Image -->
                    <div class="column is-4 has-text-centered">
                        <figure class="image is-150x150 is-inline-block">
                            <img id="pims-view-inmate-image" class="is-rounded" src="" alt="Prisoner Image">
                        </figure>
                        <p class="has-text-grey-light mt-2">Prisoner Profile</p>
                    </div>

                    <!-- Prisoner Details -->
                    <div class="column is-8">
                        <div class="pims-info-box">
                            <div class="columns">
                                <div class="column is-6">
                                    <p class="pims-prisoner-detail"><strong>ID:</strong> <span id="pims-view-prisoner-id">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Prison ID:</strong> <span id="pims-view-prison-id">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Name:</strong> <span id="pims-view-first-name">N/A</span> <span id="pims-view-middle-name"></span> <span id="pims-view-last-name">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>DOB:</strong> <span id="pims-view-dob">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Gender:</strong> <span id="pims-view-sex">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Address:</strong> <span id="pims-view-address">N/A</span></p>
                                </div>
                                <div class="column is-6">
                                    <p class="pims-prisoner-detail"><strong>Marital Status:</strong> <span id="pims-view-marital-status">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Crime:</strong> <span id="pims-view-crime-committed">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Status:</strong> <span id="pims-view-status">N/A</span></p>
                                    <p class="pims-prisoner-detail"><strong>Sentence:</strong> <span id="pims-view-time-serve-start">N/A</span> to <span id="pims-view-time-serve-end">N/A</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="pims-info-box">
                            <p class="pims-prisoner-detail"><strong>Emergency Contact:</strong></p>
                            <p class="pims-prisoner-detail"><strong>Name:</strong> <span id="pims-view-emergency-contact-name">N/A</span></p>
                            <p class="pims-prisoner-detail"><strong>Relation:</strong> <span id="pims-view-emergency-contact-relation">N/A</span></p>
                            <p class="pims-prisoner-detail"><strong>Number:</strong> <span id="pims-view-emergency-contact-number">N/A</span></p>
                        </div>
                    </div>
                </div>

                <div class="pims-info-box">
                    <p class="pims-prisoner-detail"><strong>Created At:</strong> <span id="pims-view-created-at">N/A</span></p>
                    <p class="pims-prisoner-detail"><strong>Last Updated:</strong> <span id="pims-view-updated-at">N/A</span></p>
                </div>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-view-prisoner-modal')">
                    <i class="fas fa-times"></i> Close
                </button>
            </footer>
        </div>
    </div>

    <!-- Allocation Modal -->
    <div class="pims-modal" id="pims-allocate-room-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-bed"></i> Allocate Room
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-allocate-room-modal')">&times;</button>
            </header>
            <form action="{{ route('prisoner.allocate_room') }}" method="POST">
                @csrf
                <section class="pims-modal-card-body">
                    <input type="hidden" name="id" id="pims-prisoner-id">

                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner</label>
                        <input class="pims-form-control" type="text" id="pims-prisoner-name" readonly>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Select Room</label>
                        <select class="pims-form-control" name="room_id" required>
                            <option value="">Select Room</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">Room {{ $room->room_number }} ({{ ucfirst($room->type) }})</option>
                            @endforeach
                        </select>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Allocate
                    </button>
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-allocate-room-modal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </footer>
            </form>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize view buttons
            document.querySelectorAll('.pims-view-prisoner').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    
                    fetch(`/prisoners/${prisonerId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the modal with prisoner data
                            document.getElementById('pims-view-prisoner-id').textContent = data.id || 'N/A';
                            document.getElementById('pims-view-prison-id').textContent = data.prison_name || 'N/A';
                            document.getElementById('pims-view-first-name').textContent = data.first_name || 'N/A';
                            document.getElementById('pims-view-middle-name').textContent = data.middle_name || '';
                            document.getElementById('pims-view-last-name').textContent = data.last_name || 'N/A';
                            document.getElementById('pims-view-dob').textContent = data.dob || 'N/A';
                            document.getElementById('pims-view-sex').textContent = data.gender || 'N/A';
                            document.getElementById('pims-view-address').textContent = data.address || 'N/A';
                            document.getElementById('pims-view-marital-status').textContent = data.marital_status || 'N/A';
                            document.getElementById('pims-view-crime-committed').textContent = data.crime_committed || 'N/A';
                            document.getElementById('pims-view-status').textContent = data.status || 'N/A';
                            document.getElementById('pims-view-time-serve-start').textContent = data.time_serve_start || 'N/A';
                            document.getElementById('pims-view-time-serve-end').textContent = data.time_serve_end || 'N/A';
                            document.getElementById('pims-view-emergency-contact-name').textContent = data.emergency_contact_name || 'N/A';
                            document.getElementById('pims-view-emergency-contact-relation').textContent = data.emergency_contact_relation || 'N/A';
                            document.getElementById('pims-view-emergency-contact-number').textContent = data.emergency_contact_number || 'N/A';
                            document.getElementById('pims-view-created-at').textContent = data.created_at || 'N/A';
                            document.getElementById('pims-view-updated-at').textContent = data.updated_at || 'N/A';

                            // Set image source if available
                            const inmateImage = document.getElementById('pims-view-inmate-image');
                            if (data.inmate_image) {
                                inmateImage.src = '/storage/' + data.inmate_image;
                            } else {
                                inmateImage.src = '{{ asset("default-profile.png") }}';
                            }

                            document.getElementById('pims-view-prisoner-modal').classList.add('is-active');
                        })
                        .catch(error => console.error('Error fetching prisoner data:', error));
                });
            });

            // Initialize allocate buttons
            document.querySelectorAll('.pims-allocate-room').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    const prisonerName = this.getAttribute('data-name');
                    
                    document.getElementById('pims-prisoner-id').value = prisonerId;
                    document.getElementById('pims-prisoner-name').value = prisonerName;
                    document.getElementById('pims-allocate-room-modal').classList.add('is-active');
                });
            });

            // Refresh button
            document.getElementById('pims-reload-prisoners').addEventListener('click', function() {
                window.location.reload();
            });
        });

        function pimsCloseModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>