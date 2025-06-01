<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Management</title>

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
        .pims-app-container9 {
            display: flex;
            min-height: 100vh;
            padding-top: 100px;
        }


        .pims-content-area9 {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Card Styles */
        .pims-card9 {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
        }

        .pims-card-header9 {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-card-title9 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-card-body9 {
            padding: 1.25rem;
        }

        /* Filter Section */
        .pims-card-filter9 {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Prisoner Card Styles */
        .pims-grid9 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-prisoner-card9 {
            transition: var(--pims-transition);
        }

        .pims-prisoner-card9:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-prisoner-image9 {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--pims-accent);
        }

        .pims-prisoner-title9 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-prisoner-subtitle9 {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-prisoner-detail9 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-prisoner-detail9 strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        /* Status Badges */
        .pims-status-badge9 {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-status-active9 {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-inactive9 {
            background-color: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
        }

        .pims-status-pending9 {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }

        /* Button Styles */
        .pims-btn9 {
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

        .pims-btn-sm9 {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pims-btn-primary9 {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary9:hover {
            background-color: var(--pims-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-danger9 {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger9:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary9 {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary9:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-text9 {
            background: transparent;
            color: var(--pims-accent);
        }

        .pims-btn-text9:hover {
            background-color: rgba(41, 128, 185, 0.1);
        }

        /* Form Styles */
        .pims-form-group9 {
            margin-bottom: 1.25rem;
        }

        .pims-form-label9 {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-form-control9 {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
        }

        .pims-form-control9:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Modal Styles */
        .pims-modal9 {
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

        .pims-modal9.is-active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            opacity: 1;
            backdrop-filter: blur(3px);
        }

        .pims-modal-card9 {
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

        .pims-modal9.is-active .pims-modal-card9 {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .pims-modal-card-head9 {
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

        .pims-modal-card-title9 {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .pims-modal-close9 {
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

        .pims-modal-close9:hover {
            transform: rotate(90deg);
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims-modal-card-body9 {
            padding: 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims-modal-card-foot9 {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background-color: #f8f9fa;
        }

        /* Info Boxes */
        .pims-info-box9 {
            background-color: #f8f9fa;
            border-radius: var(--pims-border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--pims-primary);
        }

        /* Pagination */
        .pims-pagination9 {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pims-pagination-link9 {
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

        .pims-pagination-link9:hover {
            background-color: var(--pims-accent);
            color: white;
            border-color: var(--pims-accent);
            transform: translateY(-2px);
        }

        .pims-pagination-link9.is-current {
            background-color: var(--pims-primary);
            color: white;
            border-color: var(--pims-primary);
        }

        .pims-pagination-link9.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Empty State */
        .pims-empty-state9 {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            color: var(--pims-text-dark);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-app-container9 {
                padding-left: 70px;
            }


            .pims-sidebar9 {
                transform: translateX(-100%);
            }

            .pims-sidebar9.is-active {
                transform: translateX(0);
            }

            .pims-content-area9 {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-card-filter9 {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-grid9 {
                grid-template-columns: 1fr;
            }
        }
        /* Modal overlay */
.pims-reactivate-modal9 {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
    transition: opacity 0.3s ease-in-out;
}

/* Modal content box */
.pims-reactivate-modal9 .modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 2rem;
    border: 1px solid #ccc;
    width: 90%;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: fadeInModal 0.3s ease-in-out;
}

/* Modal header */
.pims-reactivate-modal9 .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

/* Close button */
.pims-reactivate-modal9 .modal-close {
    background: transparent;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #666;
}

/* Input field */
.pims-reactivate-modal9 .pims-form-input {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.25rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
}

/* Modal footer buttons */
.pims-reactivate-modal9 .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

.pims-reactivate-modal9 .modal-footer button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.2s ease;
}

.pims-reactivate-modal9 .modal-footer button:first-child {
    background-color: #007bff;
    color: white;
}

.pims-reactivate-modal9 .modal-footer button:first-child:hover {
    background-color: #0056b3;
}

.pims-reactivate-modal9 .modal-footer button:last-child {
    background-color: #dc3545;
    color: white;
}

.pims-reactivate-modal9 .modal-footer button:last-child:hover {
    background-color: #a71d2a;
}

/* Animation */
@keyframes fadeInModal {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')
    @include('inspector.menu')
    <div class="pims-app-container9">


        <div class="pims-content-area9">
            <div class="pims-card9">
                <div class="pims-card-header9">
                    <h2 class="pims-card-title9">
                        <i class="fas fa-user-lock"></i> Prisoner Management
                    </h2>
                    <div class="pims-card-actions9">
                        <button id="pims-reload-prisoners9" class="pims-btn9 pims-btn-secondary9">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>

                <div class="pims-card-filter9">
                    <div class="pims-form-group9" style="flex-grow: 1; max-width: 300px;">
                        <div class="control has-icons-left">
                            <input class="pims-form-control9" id="pims-search-prisoner9" type="text" placeholder="Search prisoners...">
                            <span class="icon is-left" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>

                    <div class="buttons">
                        <a href="{{ route('prisoner.add') }}" class="pims-btn9 pims-btn-primary9">
                            <i class="fas fa-plus"></i> Create Prisoner
                        </a>
                    </div>
                </div>

                <div class="pims-card-body9">
                    <!-- Prisoner Cards Grid -->
                    <div class="pims-grid9">
                        @if($prisoners->isEmpty())
                        <div class="pims-empty-state9">
                            <i class="fas fa-user-slash" style="font-size: 3rem; color: var(--pims-accent); margin-bottom: 1rem;"></i>
                            <h3 class="pims-content-title9">No prisoners found</h3>
                        </div>
                        @else
                        @foreach($prisoners as $prisoner)
                        <div class="pims-prisoner-card9">
                            <div class="pims-card9">
                                <div class="pims-card-body9">
                                    <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                        <div class="media-left" style="margin-right: 1rem;">
                                            <figure class="image is-48x48">
                                                @if($prisoner->inmate_image)
                                                <img src="{{ asset('storage/' . $prisoner->inmate_image) }}" alt="Prisoner Image" class="pims-prisoner-image9">
                                                @else
                                                <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="pims-prisoner-image9">
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="pims-prisoner-title9">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</p>
                                            <p class="pims-prisoner-subtitle9">ID: {{ $prisoner->id }}</p>
                                            <span class="pims-status-badge9 
                                                    @if($prisoner->status == 'Active') pims-status-active9
                                                    @elseif($prisoner->status == 'Inactive') pims-status-inactive9
                                                    @else pims-status-pending9 @endif">
                                                {{ ucfirst($prisoner->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="pims-prisoner-detail9"><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                                        <p class="pims-prisoner-detail9"><strong>Gender:</strong> {{ ucfirst($prisoner->gender) }}</p>
                                    </div>
                                </div>
                                <div class="pims-card-footer9" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                    <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <button class="pims-btn9 pims-btn-text9 pims-btn-sm9 pims-view-prisoner9" data-id="{{ $prisoner->id }}">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        @if($prisoner->status === 'Active')
                                        <form action="{{ route('prisoners.toggleStatus', $prisoner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this prisoner?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="pims-btn9 pims-btn-danger9 pims-btn-sm9">
                                                <i class="fas fa-user-slash"></i> Deactivate
                                            </button>
                                        </form>
                                        @else
                                        <button class="pims-btn9 pims-btn-success9 pims-btn-sm9" onclick="openReactivateModal({{ $prisoner->id }}, '{{ $prisoner->first_name }} {{ $prisoner->last_name }}')">
                                            <i class="fas fa-user-check"></i> Reactivate
                                        </button>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if(!$prisoners->isEmpty())
                    <div class="pims-pagination9">
                        <!-- Previous Button -->
                        @if($prisoners->currentPage() > 1)
                        <a class="pims-pagination-link9" href="{{ $prisoners->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link9 is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                        <a class="pims-pagination-link9 {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        <!-- Next Button -->
                        @if($prisoners->hasMorePages())
                        <a class="pims-pagination-link9" href="{{ $prisoners->nextPageUrl() }}">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @else
                        <a class="pims-pagination-link9 is-disabled" href="#">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<!-- Reactivation Modal -->
<div id="reactivateModal" class="pims-reactivate-modal9">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Reactivate Prisoner</h2>
            <button class="modal-close" onclick="closeReactivateModal()">×</button>
        </div>

        <form id="reactivateForm" method="POST">
            @csrf
            @method('PATCH')

            <p><strong id="reactivatePrisonerName"></strong></p>

            <div>
                <label for="durationInput">Enter sentence duration in years, or type "life" or "death":</label>
                <input type="text" id="durationInput" name="duration" class="pims-form-input" placeholder="e.g., 10 or life or death" required>
            </div>

            <input type="hidden" id="calculatedEndDate" name="time_serve_end">

            <div class="modal-footer">
                <button type="button" onclick="setEndDate()">Set End Date</button>
                <button type="button" onclick="closeReactivateModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


    <!-- Prisoner Details Modal -->
    <div class="pims-modal9" id="pims-view-prisoner-modal9">
        <div class="pims-modal-card9">
            <header class="pims-modal-card-head9">
                <p class="pims-modal-card-title9">
                    <i class="fas fa-user-lock"></i> Prisoner Details
                </p>
                <button class="pims-modal-close9" onclick="pimsCloseModal9('pims-view-prisoner-modal9')">×</button>
            </header>
            <section class="pims-modal-card-body9">
                <div class="columns is-vcentered">
                    <!-- Prisoner Image -->
                    <div class="column is-4 has-text-centered">
                        <figure class="image is-150x150 is-inline-block">
                            <img id="pims-view-inmate-image9" class="is-rounded" src="" alt="Prisoner Image">
                        </figure>
                        <p class="has-text-grey-light mt-2">Prisoner Profile</p>
                    </div>

                    <!-- Prisoner Details -->
                    <div class="column is-8">
                        <div class="pims-info-box9">
                            <div class="columns">
                                <div class="column is-6">
                                    <p class="pims-prisoner-detail9"><strong>ID:</strong> <span id="pims-view-prisoner-id9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Prison ID:</strong> <span id="pims-view-prison-id9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Name:</strong> <span id="pims-view-first-name9">N/A</span> <span id="pims-view-middle-name9"></span> <span id="pims-view-last-name9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>DOB:</strong> <span id="pims-view-dob9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Gender:</strong> <span id="pims-view-sex9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Address:</strong> <span id="pims-view-address9">N/A</span></p>
                                </div>
                                <div class="column is-6">
                                    <p class="pims-prisoner-detail9"><strong>Marital Status:</strong> <span id="pims-view-marital-status9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Crime:</strong> <span id="pims-view-crime-committed9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Status:</strong> <span id="pims-view-status9">N/A</span></p>
                                    <p class="pims-prisoner-detail9"><strong>Sentence:</strong> <span id="pims-view-time-serve-start9">N/A</span> to <span id="pims-view-time-serve-end9">N/A</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="pims-info-box9">
                            <p class="pims-prisoner-detail9"><strong>Emergency Contact:</strong></p>
                            <p class="pims-prisoner-detail9"><strong>Name:</strong> <span id="pims-view-emergency-contact-name9">N/A</span></p>
                            <p class="pims-prisoner-detail9"><strong>Relation:</strong> <span id="pims-view-emergency-contact-relation9">N/A</span></p>
                            <p class="pims-prisoner-detail9"><strong>Number:</strong> <span id="pims-view-emergency-contact-number9">N/A</span></p>
                        </div>
                    </div>
                </div>

                <div class="pims-info-box9">
                    <p class="pims-prisoner-detail9"><strong>Created At:</strong> <span id="pims-view-created-at9">N/A</span></p>
                    <p class="pims-prisoner-detail9"><strong>Last Updated:</strong> <span id="pims-view-updated-at9">N/A</span></p>
                </div>
            </section>
            <footer class="pims-modal-card-foot9">
                <button class="pims-btn9 pims-btn-secondary9" onclick="pimsCloseModal9('pims-view-prisoner-modal9')">
                    <i class="fas fa-times"></i> Close
                </button>
            </footer>
        </div>
    </div>



    @include('includes.footer_js')
    <script>
    let currentPrisonerId = null;

    function openReactivateModal(prisonerId, prisonerName) {
        currentPrisonerId = prisonerId;
        console.log(`Opening modal for Prisoner ID: ${prisonerId}, Name: ${prisonerName}`);

        document.querySelector('.pims-reactivate-modal9').style.display = 'block';
        document.getElementById('reactivatePrisonerName').innerText = prisonerName;
        document.getElementById('reactivateForm').action = `/prisoners/${prisonerId}/toggle-status`;

        console.log(`Form action set to: /prisoners/${prisonerId}/toggle-status`);
    }

    function closeReactivateModal() {
        console.log('Closing reactivation modal');

        document.querySelector('.pims-reactivate-modal9').style.display = 'none';
        document.getElementById('durationInput').value = '';
    }

    function setEndDate() {
        const duration = document.getElementById('durationInput').value.trim().toLowerCase();
        console.log(`Duration input received: ${duration}`);

        const form = document.getElementById('reactivateForm');
        let endDate;

        if (duration === 'life') {
            endDate = 'Life Sentence';
            console.log('Setting end date as Life Sentence');
        } else if (duration === 'death') {
            endDate = 'Death';
            console.log('Setting end date as Death');
        } else if (!isNaN(duration)) {
            const years = parseInt(duration);
            const now = new Date();
            now.setFullYear(now.getFullYear() + years);
            endDate = now.toISOString().split('T')[0];
            console.log(`Calculated end date from duration (${years} years): ${endDate}`);
        } else {
            alert('Invalid input. Please enter a number, "life", or "death".');
            console.warn('Invalid duration input');
            return;
        }

        document.getElementById('calculatedEndDate').value = endDate;
        console.log(`Final end date set in hidden input: ${endDate}`);

        form.submit();
        console.log('Form submitted');
    }
</script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize view buttons
            document.querySelectorAll('.pims-view-prisoner9').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');

                    fetch(`/prisoners/${prisonerId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the modal with prisoner data
                            document.getElementById('pims-view-prisoner-id9').textContent = data.id || 'N/A';
                            document.getElementById('pims-view-prison-id9').textContent = data.prison_name || 'N/A';
                            document.getElementById('pims-view-first-name9').textContent = data.first_name || 'N/A';
                            document.getElementById('pims-view-middle-name9').textContent = data.middle_name || '';
                            document.getElementById('pims-view-last-name9').textContent = data.last_name || 'N/A';
                            document.getElementById('pims-view-dob9').textContent = data.dob || 'N/A';
                            document.getElementById('pims-view-sex9').textContent = data.gender || 'N/A';
                            document.getElementById('pims-view-address9').textContent = data.address || 'N/A';
                            document.getElementById('pims-view-marital-status9').textContent = data.marital_status || 'N/A';
                            document.getElementById('pims-view-crime-committed9').textContent = data.crime_committed || 'N/A';
                            document.getElementById('pims-view-status9').textContent = data.status || 'N/A';
                            document.getElementById('pims-view-time-serve-start9').textContent = data.time_serve_start || 'N/A';
                            document.getElementById('pims-view-time-serve-end9').textContent = data.time_serve_end || 'N/A';
                            document.getElementById('pims-view-emergency-contact-name9').textContent = data.emergency_contact_name || 'N/A';
                            document.getElementById('pims-view-emergency-contact-relation9').textContent = data.emergency_contact_relation || 'N/A';
                            document.getElementById('pims-view-emergency-contact-number9').textContent = data.emergency_contact_number || 'N/A';
                            document.getElementById('pims-view-created-at9').textContent = data.created_at || 'N/A';
                            document.getElementById('pims-view-updated-at9').textContent = data.updated_at || 'N/A';

                            // Set image source if available
                            const inmateImage = document.getElementById('pims-view-inmate-image9');
                            if (data.inmate_image) {
                                inmateImage.src = '/storage/' + data.inmate_image;
                            } else {
                                inmateImage.src = '{{ asset("default-profile.png") }}';
                            }

                            document.getElementById('pims-view-prisoner-modal9').classList.add('is-active');
                        })
                        .catch(error => console.error('Error fetching prisoner data:', error));
                });
            });

            // Initialize delete buttons
            document.querySelectorAll('.pims-delete-prisoner9').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    const prisonerName = this.getAttribute('data-name');

                    document.getElementById('pims-delete-prisoner-name9').textContent = prisonerName;
                    document.getElementById('pims-delete-prisoner-form9').action = `/prisoners/${prisonerId}`;
                    document.getElementById('pims-delete-prisoner-modal9').classList.add('is-active');
                });
            });

            // Handle form submissions
            document.getElementById('pims-delete-prisoner-form9').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                submitBtn.disabled = true;
            });

            // Search functionality
            document.getElementById('pims-search-prisoner9').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const prisonerCards = document.querySelectorAll('.pims-prisoner-card9');

                prisonerCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Refresh button
            document.getElementById('pims-reload-prisoners9').addEventListener('click', function() {
                window.location.reload();
            });
        });

        function pimsCloseModal9(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>

</html>