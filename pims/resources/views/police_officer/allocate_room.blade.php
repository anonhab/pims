<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Allocation</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims7-primary: #1a2a3a;
            --pims7-secondary: #2c3e50;
            --pims7-accent: #2980b9;
            --pims7-danger: #c0392b;
            --pims7-success: #27ae60;
            --pims7-warning: #d35400;
            --pims7-text-light: #ecf0f1;
            --pims7-text-dark: #2c3e50;
            --pims7-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --pims7-border-radius: 6px;
            --pims7-nav-height: 60px;
            --pims7-sidebar-width: 250px;
            --pims7-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims7-text-dark);
            line-height: 1.6;
            padding-top: 60px;
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims7-nav-height);
        }

        .pims7-sidebar {
            width: var(--pims7-sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--pims7-nav-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
            transition: var(--pims7-transition);
        }

        .pims7-content-area {
            flex: 1;
            margin-left: var(--pims7-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims7-transition);
        }

        /* Header Styles */
        .pims7-content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims7-content-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims7-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Card Styles */
        .pims7-card {
            background: white;
            border-radius: var(--pims7-border-radius);
            box-shadow: var(--pims7-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims7-transition);
            border-left: 4px solid var(--pims7-accent);
        }

        .pims7-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims7-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims7-primary);
        }

        .pims7-card-body {
            padding: 1.25rem;
        }

        /* Prisoner Card Styles */
        .pims7-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims7-prisoner-card {
            transition: var(--pims7-transition);
            cursor: pointer;
        }

        .pims7-prisoner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims7-prisoner-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims7-primary);
            margin-bottom: 0.25rem;
        }

        .pims7-prisoner-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims7-prisoner-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims7-prisoner-detail strong {
            color: var(--pims7-primary);
            font-weight: 600;
        }

        /* Status Badges */
        .pims7-status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims7-status-active {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims7-success);
        }

        .pims7-status-inactive {
            background-color: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
        }

        .pims7-status-pending {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }

        /* Button Styles */
        .pims7-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims7-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims7-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.9rem;
        }

        .pims7-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pims7-btn-primary {
            background-color: var(--pims7-accent);
            color: white;
        }

        .pims7-btn-primary:hover {
            background-color: var(--pims7-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims7-btn-danger {
            background-color: var(--pims7-danger);
            color: white;
        }

        .pims7-btn-danger:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims7-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims7-text-dark);
        }

        .pims7-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Modal Styles */
        .pims7-modal {
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

        .pims7-modal.is-active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            opacity: 1;
            backdrop-filter: blur(3px);
        }

        .pims7-modal-card {
            background: white;
            border-radius: var(--pims7-border-radius);
            width: 90%;
            padding-top: 50px;
            max-width: 800px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .pims7-modal.is-active .pims7-modal-card {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .pims7-modal-card-head {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(41, 128, 185, 0.15) 0%, rgba(41, 128, 185, 0.1) 100%);
            color: var(--pims7-primary);
            border-top-left-radius: var(--pims7-border-radius);
            border-top-right-radius: var(--pims7-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(41, 128, 185, 0.2);
        }

        .pims7-modal-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .pims7-modal-close {
            background: none;
            border: none;
            color: var(--pims7-primary);
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

        .pims7-modal-close:hover {
            transform: rotate(90deg);
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims7-modal-card-body {
            padding: 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims7-modal-card-foot {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background-color: #f8f9fa;
        }

        /* Form Styles */
        .pims7-form-group {
            margin-bottom: 1.25rem;
        }

        .pims7-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims7-primary);
        }

        .pims7-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims7-border-radius);
            transition: var(--pims7-transition);
        }

        .pims7-form-control:focus {
            border-color: var(--pims7-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Pagination */
        .pims7-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pims7-pagination-link {
            padding: 0.5rem 0.75rem;
            border-radius: var(--pims7-border-radius);
            border: 1px solid #ddd;
            color: var(--pims7-primary);
            font-weight: 600;
            transition: var(--pims7-transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims7-pagination-link:hover {
            background-color: var(--pims7-accent);
            color: white;
            border-color: var(--pims7-accent);
            transform: translateY(-2px);
        }

        .pims7-pagination-link.is-current {
            background-color: var(--pims7-primary);
            color: white;
            border-color: var(--pims7-primary);
        }

        .pims7-pagination-link.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Empty State */
        .pims7-empty-state {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--pims7-border-radius);
            box-shadow: var(--pims7-card-shadow);
            color: var(--pims7-text-dark);
        }

        /* Prisoner Image */
        .pims7-prisoner-image {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--pims7-accent);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims7-sidebar {
                transform: translateX(-100%);
            }

            .pims7-sidebar.is-active {
                transform: translateX(0);
            }

            .pims7-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims7-content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims7-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
 @include('includes.nav')
@include('police_officer.menu')
<body>
    <!-- Navigation -->


    <div class="pims7-app-container">
           
        <div class="pims7-content-area">
            @php
                $unallocatedPrisoners = $prisoners->filter(fn($prisoner) => $prisoner->status !== 'released' && is_null($prisoner->room_id));
            @endphp

            @if ($unallocatedPrisoners->isEmpty())
                <div class="pims7-empty-state">
                    <i class="fas fa-user-slash" style="font-size: 3rem; color: var(--pims7-accent); margin-bottom: 1rem;"></i>
                    <h3 class="pims7-content-title">No prisoners found to allocate</h3>
                    <p>All prisoners have been assigned to rooms or have been released.</p>
                </div>
            @else
                <div class="pims7-card">
                    <div class="pims7-card-header">
                        <h2 class="pims7-card-title">
                            <i class="fas fa-user-lock"></i> Unallocated Prisoners
                        </h2>
                        <div class="pims7-card-actions">
                            <button id="pims7-reload-prisoners" class="pims7-btn pims7-btn-secondary">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                    <div class="pims7-card-body">
                        <!-- Prisoner Cards Grid -->
                        <div class="pims7-grid">
                            @foreach($unallocatedPrisoners as $prisoner)
                            <div class="pims7-prisoner-card">
                                <div class="pims7-card">
                                    <div class="pims7-card-body">
                                        <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <div class="media-left" style="margin-right: 1rem;">
                                                <figure class="image is-48x48">
                                                    @if($prisoner->inmate_image)
                                                        <img src="{{ asset('storage/' . $prisoner->inmate_image) }}" alt="Prisoner Image" class="pims7-prisoner-image">
                                                    @else
                                                        <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="pims7-prisoner-image">
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="media-content">
                                                <p class="pims7-prisoner-title">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</p>
                                                <p class="pims7-prisoner-subtitle">ID: {{ $prisoner->id }}</p>
                                                <span class="pims7-status-badge 
                                                    @if($prisoner->status == 'active') pims7-status-active
                                                    @elseif($prisoner->status == 'inactive') pims7-status-inactive
                                                    @else pims7-status-pending @endif">
                                                    {{ ucfirst($prisoner->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p class="pims7-prisoner-detail"><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                                            <p class="pims7-prisoner-detail"><strong>Gender:</strong> {{ ucfirst($prisoner->gender) }}</p>
                                            <p class="pims7-prisoner-detail"><strong>Room Status:</strong> Not Allocated</p>
                                        </div>
                                    </div>
                                    <div class="pims7-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                        <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                            <button class="pims7-btn pims7-btn-primary pims7-btn-sm pims7-view-prisoner" 
                                                data-id="{{ $prisoner->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <button class="pims7-btn pims7-btn-primary pims7-btn-sm pims7-allocate-room" 
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
                        <div class="pims7-pagination">
                            <!-- Previous Button -->
                            @if($prisoners->currentPage() > 1)
                            <a class="pims7-pagination-link" href="{{ $prisoners->previousPageUrl() }}">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                            @else
                            <a class="pims7-pagination-link is-disabled" href="#">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                            <a class="pims7-pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                            @endforeach

                            <!-- Next Button -->
                            @if($prisoners->hasMorePages())
                            <a class="pims7-pagination-link" href="{{ $prisoners->nextPageUrl() }}">
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                            @else
                            <a class="pims7-pagination-link is-disabled" href="#">
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
    <div class="pims7-modal" id="pims7-view-prisoner-modal">
        <div class="pims7-modal-card">
            <header class="pims7-modal-card-head">
                <p class="pims7-modal-card-title">
                    <i class="fas fa-user-lock"></i> Prisoner Details
                </p>
                <button class="pims7-modal-close" onclick="pims7CloseModal('pims7-view-prisoner-modal')">×</button>
            </header>
            <section class="pims7-modal-card-body">
                <div class="columns is-vcentered">
                    <!-- Prisoner Image -->
                    <div class="column is-4 has-text-centered">
                        <figure class="image is-150x150 is-inline-block">
                            <img id="pims7-view-inmate-image" class="is-rounded" src="" alt="Prisoner Image">
                        </figure>
                        <p class="has-text-grey-light mt-2">Prisoner Profile</p>
                    </div>

                    <!-- Prisoner Details -->
                    <div class="column is-8">
                        <div class="pims7-info-box">
                            <div class="columns">
                                <div class="column is-6">
                                    <p class="pims7-prisoner-detail"><strong>ID:</strong> <span id="pims7-view-prisoner-id">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Prison ID:</strong> <span id="pims7-view-prison-id">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Name:</strong> <span id="pims7-view-first-name">N/A</span> <span id="pims7-view-middle-name"></span> <span id="pims7-view-last-name">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>DOB:</strong> <span id="pims7-view-dob">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Gender:</strong> <span id="pims7-view-sex">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Address:</strong> <span id="pims7-view-address">N/A</span></p>
                                </div>
                                <div class="column is-6">
                                    <p class="pims7-prisoner-detail"><strong>Marital Status:</strong> <span id="pims7-view-marital-status">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Crime:</strong> <span id="pims7-view-crime-committed">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Status:</strong> <span id="pims7-view-status">N/A</span></p>
                                    <p class="pims7-prisoner-detail"><strong>Sentence:</strong> <span id="pims7-view-time-serve-start">N/A</span> to <span id="pims7-view-time-serve-end">N/A</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="pims7-info-box">
                            <p class="pims7-prisoner-detail"><strong>Emergency Contact:</strong></p>
                            <p class="pims7-prisoner-detail"><strong>Name:</strong> <span id="pims7-view-emergency-contact-name">N/A</span></p>
                            <p class="pims7-prisoner-detail"><strong>Relation:</strong> <span id="pims7-view-emergency-contact-relation">N/A</span></p>
                            <p class="pims7-prisoner-detail"><strong>Number:</strong> <span id="pims7-view-emergency-contact-number">N/A</span></p>
                        </div>
                    </div>
                </div>

                <div class="pims7-info-box">
                    <p class="pims7-prisoner-detail"><strong>Created At:</strong> <span id="pims7-view-created-at">N/A</span></p>
                    <p class="pims7-prisoner-detail"><strong>Last Updated:</strong> <span id="pims7-view-updated-at">N/A</span></p>
                </div>
            </section>
            <footer class="pims7-modal-card-foot">
                <button class="pims7-btn pims7-btn-secondary" onclick="pims7CloseModal('pims7-view-prisoner-modal')">
                    <i class="fas fa-times"></i> Close
                </button>
            </footer>
        </div>
    </div>

    <!-- Allocation Modal -->
    <div class="pims7-modal" id="pims7-allocate-room-modal">
        <div class="pims7-modal-card">
            <header class="pims7-modal-card-head">
                <p class="pims7-modal-card-title">
                    <i class="fas fa-bed"></i> Allocate Room
                </p>
                <button class="pims7-modal-close" onclick="pims7CloseModal('pims7-allocate-room-modal')">×</button>
            </header>
            <form action="{{ route('prisoner.allocate_room') }}" method="POST">
                @csrf
                <section class="pims7-modal-card-body">
                    <input type="hidden" name="id" id="pims7-prisoner-id">

                    <div class="pims7-form-group">
                        <label class="pims7-form-label">Prisoner</label>
                        <input class="pims7-form-control" type="text" id="pims7-prisoner-name" readonly>
                    </div>

                    <div class="pims7-form-group">
                        <label class="pims7-form-label">Select Room</label>
                        <select class="pims7-form-control" name="room_id" required>
                            <option value="">Select Room</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">Room {{ $room->room_number }} ({{ ucfirst($room->type) }})</option>
                            @endforeach
                        </select>
                    </div>
                </section>
                <footer class="pims7-modal-card-foot">
                    <button type="submit" class="pims7-btn pims7-btn-primary">
                        <i class="fas fa-save"></i> Allocate
                    </button>
                    <button type="button" class="pims7-btn pims7-btn-secondary" onclick="pims7CloseModal('pims7-allocate-room-modal')">
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
            document.querySelectorAll('.pims7-view-prisoner').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    
                    fetch(`/prisoners/${prisonerId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the modal with prisoner data
                            document.getElementById('pims7-view-prisoner-id').textContent = data.id || 'N/A';
                            document.getElementById('pims7-view-prison-id').textContent = data.prison_name || 'N/A';
                            document.getElementById('pims7-view-first-name').textContent = data.first_name || 'N/A';
                            document.getElementById('pims7-view-middle-name').textContent = data.middle_name || '';
                            document.getElementById('pims7-view-last-name').textContent = data.last_name || 'N/A';
                            document.getElementById('pims7-view-dob').textContent = data.dob || 'N/A';
                            document.getElementById('pims7-view-sex').textContent = data.gender || 'N/A';
                            document.getElementById('pims7-view-address').textContent = data.address || 'N/A';
                            document.getElementById('pims7-view-marital-status').textContent = data.marital_status || 'N/A';
                            document.getElementById('pims7-view-crime-committed').textContent = data.crime_committed || 'N/A';
                            document.getElementById('pims7-view-status').textContent = data.status || 'N/A';
                            document.getElementById('pims7-view-time-serve-start').textContent = data.time_serve_start || 'N/A';
                            document.getElementById('pims7-view-time-serve-end').textContent = data.time_serve_end || 'N/A';
                            document.getElementById('pims7-view-emergency-contact-name').textContent = data.emergency_contact_name || 'N/A';
                            document.getElementById('pims7-view-emergency-contact-relation').textContent = data.emergency_contact_relation || 'N/A';
                            document.getElementById('pims7-view-emergency-contact-number').textContent = data.emergency_contact_number || 'N/A';
                            document.getElementById('pims7-view-created-at').textContent = data.created_at || 'N/A';
                            document.getElementById('pims7-view-updated-at').textContent = data.updated_at || 'N/A';

                            // Set image source if available
                            const inmateImage = document.getElementById('pims7-view-inmate-image');
                            if (data.inmate_image) {
                                inmateImage.src = '/storage/' + data.inmate_image;
                            } else {
                                inmateImage.src = '{{ asset("default-profile.png") }}';
                            }

                            document.getElementById('pims7-view-prisoner-modal').classList.add('is-active');
                        })
                        .catch(error => console.error('Error fetching prisoner data:', error));
                });
            });

            // Initialize allocate buttons
            document.querySelectorAll('.pims7-allocate-room').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    const prisonerName = this.getAttribute('data-name');
                    
                    document.getElementById('pims7-prisoner-id').value = prisonerId;
                    document.getElementById('pims7-prisoner-name').value = prisonerName;
                    document.getElementById('pims7-allocate-room-modal').classList.add('is-active');
                });
            });

            // Refresh button
            document.getElementById('pims7-reload-prisoners').addEventListener('click', function() {
                window.location.reload();
            });
        });

        function pims7CloseModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>