<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Allocated Prisoners</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #a93226;
            transform: translateY(-2px);
        }

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
                        <i class="fas fa-user-lock"></i> Allocated Prisoners
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
                        @foreach($prisoners as $prisoner)
                        <div class="pims-prisoner-card" data-prisoner-id="{{ $prisoner->id }}">
                            <div class="pims-card">
                                <div class="pims-card-body">
                                    <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
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
                                        <p class="pims-prisoner-detail room-number"><strong>Room Number:</strong> {{ $prisoner->room->room_number ?? 'N/A' }}</p>
                                    </div>
                                    <button class="pims-btn pims-btn-danger unallocate-btn" data-prisoner-id="{{ $prisoner->id }}">
                                        <i class="fas fa-door-open"></i> Unallocate
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pims-pagination">
                        @if($prisoners->currentPage() > 1)
                        <a class="pims-pagination-link" href="{{ $prisoners->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                        <a class="pims-pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

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
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Refresh button functionality
            document.getElementById('pims-reload-prisoners').addEventListener('click', function() {
                window.location.reload();
            });

            // Unallocate button functionality
            document.querySelectorAll('.unallocate-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-prisoner-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to unallocate prisoner ID: ${prisonerId} from their room.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#27ae60',
                        cancelButtonColor: '#c0392b',
                        confirmButtonText: 'Yes, unallocate',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request
                            fetch(`/police-officer/prisoners/${prisonerId}/unallocate`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: JSON.stringify({ prisoner_id: prisonerId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#27ae60'
                                    });

                                    // Update UI: Hide the card or update room number
                                    const prisonerCard = document.querySelector(`.pims-prisoner-card[data-prisoner-id="${prisonerId}"]`);
                                    if (prisonerCard) {
                                        prisonerCard.style.display = 'none'; // Hide card
                                        // Alternatively, update room number:
                                        // const roomDetail = prisonerCard.querySelector('.room-number');
                                        // roomDetail.innerHTML = '<strong>Room Number:</strong> N/A';
                                    }
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonColor: '#c0392b'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while processing your request.',
                                    icon: 'error',
                                    confirmButtonColor: '#c0392b'
                                });
                                console.error('Error:', error);
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>