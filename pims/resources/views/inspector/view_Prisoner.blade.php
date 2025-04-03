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
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
        }

        .pims-prisoner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-prisoner-image {
            border-radius: 50%;
            border: 3px solid var(--pims-accent);
            object-fit: cover;
            width: 48px;
            height: 48px;
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

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
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

        /* Modal Styles - Enhanced */
.pims-modal {
    display: none;
    position: fixed;
    z-index: 1001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    opacity: 0;
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
    border-radius: var(--pims-border-radius, 8px);
    width: 90%;
    max-width: 900px;
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
    color: var(--pims-primary, #2980b9);
    border-top-left-radius: var(--pims-border-radius, 8px);
    border-top-right-radius: var(--pims-border-radius, 8px);
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

.pims-modal-card-title svg {
    width: 1.5rem;
    height: 1.5rem;
    fill: currentColor;
}

.pims-modal-close {
    background: none;
    border: none;
    color: var(--pims-primary, #2980b9);
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

.pims-modal-close:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.3);
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

/* Prisoner Details Styles - Enhanced */
.pims-prisoner-details {
    display: flex;
    flex-wrap: wrap;
    gap: 2.5rem;
}

.pims-prisoner-image-container {
    flex: 1;
    min-width: 550px;
    text-align: center;
    position: relative;
}

.pims-prisoner-main-image {
    width: 580px;
    height: 580px;
   
    border-radius: 5%;
    object-fit: cover;
    border: 4px solid var(--pims-accent);
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.pims-prisoner-main-image:hover {
    transform: scale(3.1); /* Zoom effect */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* More intense shadow */
}

.pims-prisoner-id-badge {
    display: inline-block;
    background-color: var(--pims-primary, #2980b9);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.pims-prisoner-info {
    flex: 2;
    min-width: 300px;
}

.pims-info-box {
    background-color: #f8f9fa;
    border-radius: var(--pims-border-radius, 8px);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border-left: 4px solid var(--pims-primary, #2980b9);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.pims-info-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.pims-info-box-title {
    font-weight: 700;
    color: var(--pims-primary, #2980b9);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.1rem;
}

.pims-info-box-title svg {
    width: 1.2rem;
    height: 1.2rem;
    fill: currentColor;
}

.pims-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.25rem;
}

.pims-info-item {
    padding: 0.5rem 0;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
}

.pims-info-item:last-child {
    border-bottom: none;
}

.pims-info-item strong {
    color: var(--pims-primary, #2980b9);
    font-weight: 600;
    display: inline-block;
    min-width: 100px;
}

/* Status Indicators */
.pims-status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.pims-status-active {
    background-color: rgba(46, 204, 113, 0.2);
    color: #2ecc71;
}

.pims-status-inactive {
    background-color: rgba(231, 76, 60, 0.2);
    color: #e74c3c;
}

.pims-status-pending {
    background-color: rgba(241, 196, 15, 0.2);
    color: #f1c40f;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .pims-prisoner-details {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .pims-prisoner-image-container {
        order: -1;
    }
    
    .pims-info-grid {
        grid-template-columns: 1fr;
    }
    
    .pims-modal-card-body {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .pims-modal-card {
        width: 95%;
    }
    
    .pims-modal-card-head {
        padding: 1rem;
    }
    
    .pims-modal-card-title {
        font-size: 1.25rem;
    }
    
    .pims-prisoner-main-image {
        width: 140px;
        height: 140px;
    }
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

            .pims-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-prisoner-details {
                flex-direction: column;
            }

            .pims-prisoner-image-container {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('inspector.menu')

        <div class="pims-content-area">
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-user-lock"></i> Prisoner Management
                    </h2>
                    <div class="pims-card-actions">
                        <a href="{{ route('prisoner.add') }}" class="pims-btn pims-btn-primary">
                            <i class="fas fa-plus"></i> Create Prisoner
                        </a>
                        <button id="pims-reload-prisoners" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="pims-card-body">
                    <!-- Search and Filter -->
                    <div class="pims-mb-3">
                        <div class="field is-grouped is-grouped-right">
                            <div class="control has-icons-left" style="flex-grow: 1; max-width: 300px;">
                                <input class="pims-form-control" id="pims-search-prisoner" type="text" placeholder="Search prisoners...">
                                <span class="icon is-left" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Prisoner Cards Grid -->
                    <div class="pims-grid">
                        @foreach($prisoners as $prisoner)
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
                                                @if($prisoner->status == 'Active') pims-status-active
                                                @elseif($prisoner->status == 'Inactive') pims-status-inactive
                                                @else pims-status-pending @endif">
                                                {{ ucfirst($prisoner->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="pims-prisoner-detail"><strong>Crime:</strong> {{ $prisoner->crime_committed }}</p>
                                        <p class="pims-prisoner-detail"><strong>Gender:</strong> {{ ucfirst($prisoner->gender) }}</p>
                                    </div>
                                </div>
                                <div class="pims-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                    <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <button class="pims-btn pims-btn-primary pims-btn-sm pims-view-prisoner" 
                                            data-id="{{ $prisoner->id }}">
                                            <i class="fas fa-eye"></i> View
                                        </button>

                                        <button class="pims-btn pims-btn-danger pims-btn-sm pims-delete-prisoner"
                                            data-id="{{ $prisoner->prisoner_id }}"
                                            data-name="{{ $prisoner->first_name }} {{ $prisoner->last_name }}">
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
        </div>
    </div>

   <!-- View Prisoner Modal -->
<div class="pims-modal" id="pims-view-prisoner-modal">
    <div class="pims-modal-background"></div>
    <div class="pims-modal-card">
        <header class="pims-modal-card-head">
            <p class="pims-modal-card-title">
                <i class="fas fa-user-lock"></i> Prisoner Details
            </p>
            <button class="pims-modal-close">&times;</button>
        </header>
        <section class="pims-modal-card-body">
            <div class="pims-prisoner-details">
                <!-- Prisoner Image -->
                <div class="pims-prisoner-image-container">
                    <img id="pims-view-inmate-image" class="pims-prisoner-main-image" src="" alt="Prisoner Image">
                    <p class="has-text-grey-light pims-mt-1">Prisoner Profile</p>
                </div>

                <!-- Prisoner Info -->
                <div class="pims-prisoner-info">
                    <!-- Basic Information Box -->
                    <div class="pims-info-box">
                        <p class="pims-info-box-title"><i class="fas fa-id-card"></i> Basic Information</p>
                        <div class="pims-info-grid">
                            <div class="pims-info-item">
                                <strong>ID:</strong> <span id="pims-view-prisoner-id">1</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Prison ID:</strong> <span id="pims-view-prison-id">N/A</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Name:</strong> <span id="pims-view-first-name">Habtamu</span> <span id="pims-view-middle-name">Bitew</span> <span id="pims-view-last-name">Gashu</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>DOB:</strong> <span id="pims-view-dob">March 13, 2025</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Gender:</strong> <span id="pims-view-sex">male</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Address:</strong> <span id="pims-view-address">Bahir dar, Ethiopia</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Marital Status:</strong> <span id="pims-view-marital-status">single</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Status:</strong> <span id="pims-view-status">released</span>
                            </div>
                        </div>
                    </div>

                    <!-- Incarceration Details Box -->
                    <div class="pims-info-box">
                        <p class="pims-info-box-title"><i class="fas fa-gavel"></i> Incarceration Details</p>
                        <div class="pims-info-grid">
                            <div class="pims-info-item">
                                <strong>Crime:</strong> <span id="pims-view-crime-committed">Assault</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Sentence Start:</strong> <span id="pims-view-time-serve-start">March 12, 2025</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Sentence End:</strong> <span id="pims-view-time-serve-end">Life Sentence</span>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact Box -->
                    <div class="pims-info-box">
                        <p class="pims-info-box-title"><i class="fas fa-phone-emergency"></i> Emergency Contact</p>
                        <div class="pims-info-grid">
                            <div class="pims-info-item">
                                <strong>Name:</strong> <span id="pims-view-emergency-contact-name">Habtamu Gashu</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Relation:</strong> <span id="pims-view-emergency-contact-relation">dsdc</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Phone:</strong> <span id="pims-view-emergency-contact-number">0909029295</span>
                            </div>
                        </div>
                    </div>

                    <!-- System Information Box -->
                    <div class="pims-info-box">
                        <p class="pims-info-box-title"><i class="fas fa-clock"></i> System Information</p>
                        <div class="pims-info-grid">
                            <div class="pims-info-item">
                                <strong>Created At:</strong> <span id="pims-view-created-at">March 9, 2025, 12:50 AM</span>
                            </div>
                            <div class="pims-info-item">
                                <strong>Last Updated:</strong> <span id="pims-view-updated-at">March 9, 2025, 12:50 AM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="pims-modal-card-foot">
            <button class="pims-btn pims-btn-secondary pims-close-modal">
                <i class="fas fa-times"></i> Close
            </button>
        </footer>
    </div>
</div>


    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-prisoner-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card" style="max-width: 400px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <div style="text-align: center;">
                    <div class="pims-confirm-icon">
                        <i class="fas fa-trash-alt" style="font-size: 2.5rem; color: var(--pims-danger);"></i>
                    </div>
                    <p class="pims-confirm-message">
                        Are you sure you want to delete prisoner <strong id="pims-delete-prisoner-name"></strong>?
                        This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="pims-modal-card-foot" style="justify-content: center;">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-delete-prisoner-form" method="POST" style="display: inline;">
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
    // View Prisoner Modal
    const viewButtons = document.querySelectorAll('.pims-view-prisoner');
    const viewModal = document.getElementById('pims-view-prisoner-modal');
    const deleteModal = document.getElementById('pims-delete-prisoner-modal');
    const closeModalButtons = document.querySelectorAll('.pims-modal-close, .pims-close-modal');
    const deleteForm = document.getElementById('pims-delete-prisoner-form');
    const deletePrisonerName = document.getElementById('pims-delete-prisoner-name');
    let currentDeleteUrl = '';

    // Initialize view buttons
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const prisonerId = this.getAttribute('data-id');
            
            // Show loading state
            viewModal.classList.add('is-active');
            document.getElementById('pims-view-inmate-image').src = '';
            
            fetch(`/prisoners/${prisonerId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate the modal with prisoner data
                    document.getElementById('pims-view-prisoner-id').textContent = data.id || 'N/A';
                    document.getElementById('pims-view-prison-id').textContent = data.prison_id || 'N/A';
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
                    
                    // Handle 'time_serve_end' for life sentence or death sentence
                    if (data.time_serve_end === 'life') {
                        document.getElementById('pims-view-time-serve-end').textContent = 'Life Sentence';
                    } else if (data.time_serve_end === 'death') {
                        document.getElementById('pims-view-time-serve-end').textContent = 'Death Sentence';
                    } else {
                        document.getElementById('pims-view-time-serve-end').textContent = data.time_serve_end || 'N/A';
                    }

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
                })
                .catch(error => {
                    console.error('Error fetching prisoner data:', error);
                    // Optionally show an error message in the modal
                });
        });
    });

    // Initialize delete buttons
    document.querySelectorAll('.pims-delete-prisoner').forEach(button => {
        button.addEventListener('click', function() {
            const prisonerId = this.getAttribute('data-id');
            const prisonerName = this.getAttribute('data-name');
            
            deletePrisonerName.textContent = prisonerName;
            currentDeleteUrl = `/prisoners/${prisonerId}`;
            deleteModal.classList.add('is-active');
        });
    });

    // Handle delete form submission
    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
        submitBtn.disabled = true;
        
        // Set the form action dynamically
        this.action = currentDeleteUrl;
        
        // Submit the form
        this.submit();
    });

    // Close modals
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewModal.classList.remove('is-active');
            deleteModal.classList.remove('is-active');
        });
    });

    // Close modal when clicking outside
    [viewModal, deleteModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('is-active');
            }
        });
    });

    // Table Reload
    document.getElementById('pims-reload-prisoners').addEventListener('click', function() {
        window.location.reload();
    });

    // Table Search
    document.getElementById('pims-search-prisoner').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const prisonerCards = document.querySelectorAll('.pims-prisoner-card');

        prisonerCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
        });
    });
});

    </script>
</body>
</html>c