<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Release Prisoner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Local fallback (uncomment if CDN fails) -->
    <!-- <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" /> -->
    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-light: #ecf0f1;
            --pims-lighter: #f8f9fa;
            --pims-danger: #e74c3c;
            --pims-success: #2ecc71;
            --pims-warning: #f39c12;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        /* Select2 Custom Styles */
        .select2-container {
            width: 100% !important;
            z-index: 10000;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            padding: 0.75rem 1rem;
            height: auto;
            background-color: white;
        }

        .select2-container--default .select2-selection--single:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--pims-primary);
            line-height: 1.6;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }

        .select2-dropdown {
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            z-index: 10001;
        }

        .select2-search--dropdown {
            padding: 0.5rem;
            display: block !important; /* Ensure search bar is not hidden */
        }

        .select2-search__field {
            width: 100% !important;
            padding: 0.5rem !important;
            border: 1px solid #ddd !important;
            border-radius: var(--pims-border-radius) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .select2-results__option {
            padding: 0.75rem 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .select2-results__option--highlighted {
            background-color: var(--pims-light) !important;
            color: var(--pims-primary) !important;
        }

        /* Rest of the existing styles (unchanged) */
        .pims-app-container {
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px;
            transition: var(--pims-transition);
        }

        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .pims-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-page-title i {
            color: var(--pims-accent);
        }

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
        }

        .pims-card-header h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
            background-color: white;
            cursor: pointer;
        }

        .pims-form-select:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-form-select:invalid {
            border-color: var(--pims-danger);
        }

        .pims-form-check {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .pims-form-check-input {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
            accent-color: var(--pims-accent);
        }

        .pims-form-check-label {
            cursor: pointer;
        }

        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 1rem;
            gap: 0.5rem;
        }

        .pims-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover:not(:disabled) {
            background-color: #2980b9;
        }

        .pims-btn-secondary {
            background-color: var(--pims-secondary);
            color: white;
        }

        .pims-btn-secondary:hover:not(:disabled) {
            background-color: #2c3e50;
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover:not(:disabled) {
            background-color: #27ae60;
        }

        .pims-alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.3s ease;
        }

        .pims-alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-alert-hidden {
            display: none;
        }

        .pims-action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }

        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            transform: scale(0.7);
            transition: all 0.3s ease;
        }

        .pims-modal.active .pims-modal-container {
            transform: scale(1);
            opacity: 1;
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .pims-action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .pims-btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .pims-card-body {
                padding: 1rem;
            }

            .pims-page-title {
                font-size: 1.5rem;
            }

            .pims-modal-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        @include('includes.nav')
        @include('police_commisioner.menu')
        <main class="pims-main-content">
            <div class="pims-content-container">
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-user-check"></i> Release Prisoner
                    </h2>
                </div>

                <form id="release-prisoner-form" method="POST" action="{{ route('release_prisoner') }}">
                    @csrf
                    <input type="hidden" id="prisoner-id" name="prisoner_id">
                    <input type="hidden" id="sentence-completed" name="sentence_completed">

                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h5>Release Prisoners</h5>
                        </div>
                        <div class="pims-card-body">
                            <div id="pims-system-message" class="pims-alert pims-alert-hidden"></div>

                            <div class="pims-form-group">
                                <label for="pims-prisoner-select" class="pims-form-label">Select Prisoner</label>
                                <select id="pims-prisoner-select" class="pims-form-select" required aria-required="true">
                                    <option value="">-- Select a Prisoner --</option>
                                    @foreach($prisoners as $prisoner)
                                    <option value="{{ $prisoner->id }}" data-sentence-end="{{ $prisoner->time_serve_end }}"
                                        data-name="{{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}">
                                        {{ $prisoner->first_name }}
                                        @if($prisoner->middle_name)
                                        {{ $prisoner->middle_name }}
                                        @endif
                                        {{ $prisoner->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="pims-form-group">
                                <h6 style="margin-bottom: 1rem; font-weight: 500; color: var(--pims-primary);">Verify Legal Requirements</h6>
                                <div class="pims-form-check">
                                    <input class="pims-form-check-input" type="checkbox" id="pims-sentence-completed" disabled aria-disabled="true">
                                    <label class="pims-form-check-label" for="pims-sentence-completed">Sentence Completed</label>
                                </div>
                            </div>

                            <div class="pims-action-buttons">
                                <button type="button" class="pims-btn pims-btn-secondary" onclick="window.history.back()">
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </button>
                                <button type="button" class="pims-btn pims-btn-success" id="release-btn" disabled>
                                    <i class="fas fa-check-circle"></i> Release Prisoner
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <div class="pims-modal" id="pims-confirm-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5><i class="fas fa-exclamation-circle"></i> Confirm Release</h5>
                <button class="pims-modal-close">×</button>
            </div>
            <div class="pims-modal-body">
                <p>Are you sure you want to release <span id="confirm-prisoner-name"></span>? This action cannot be undone.</p>
            </div>
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn">Cancel</button>
                <button class="pims-btn pims-btn-success" id="confirm-release-btn">
                    <i class="fas fa-check-circle"></i> Confirm Release
                </button>
            </div>
        </div>
    </div>

    <!-- Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Local fallbacks (uncomment if CDN fails) -->
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/select2.min.js') }}"></script> -->
    <script>
        // Use jQuery noConflict to avoid conflicts with other scripts
        (function($) {
            function showMessage(message, type = 'success') {
                const messageDiv = document.getElementById('pims-system-message');
                messageDiv.className = `pims-alert pims-alert-${type}`;
                messageDiv.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
                messageDiv.scrollIntoView({ behavior: 'smooth' });
                setTimeout(() => {
                    messageDiv.className = 'pims-alert pims-alert-hidden';
                }, 5000);
            }

            function setPrisonerId() {
                const prisonerSelect = document.getElementById('pims-prisoner-select');
                const selectedOption = prisonerSelect.options[prisonerSelect.selectedIndex];
                const prisonerId = selectedOption ? selectedOption.value : '';
                const sentenceEndDate = selectedOption ? selectedOption.getAttribute('data-sentence-end') : '';
                const prisonerName = selectedOption ? selectedOption.getAttribute('data-name') : '';

                document.getElementById('prisoner-id').value = prisonerId;
                document.getElementById('confirm-prisoner-name').textContent = prisonerName || 'the selected prisoner';

                const currentDate = new Date();
                const endDate = sentenceEndDate ? new Date(sentenceEndDate) : null;
                const checkbox = document.getElementById('pims-sentence-completed');
                const releaseBtn = document.getElementById('release-btn');

                if (prisonerId && endDate && endDate <= currentDate) {
                    checkbox.checked = true;
                    checkbox.disabled = false;
                    document.getElementById('sentence-completed').value = 1;
                    releaseBtn.disabled = false;
                    showMessage('Prisoner is eligible for release.', 'success');
                } else if (prisonerId) {
                    checkbox.checked = false;
                    checkbox.disabled = true;
                    document.getElementById('sentence-completed').value = 0;
                    releaseBtn.disabled = true;
                    showMessage('Prisoner is not yet eligible for release.', 'danger');
                } else {
                    checkbox.checked = false;
                    checkbox.disabled = true;
                    releaseBtn.disabled = true;
                    document.getElementById('sentence-completed').value = 0;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM fully loaded, initializing Select2...');

                // Verify jQuery is available
                if (typeof $ === 'undefined') {
                    console.error('jQuery is not loaded');
                    showMessage('jQuery failed to load. Please check your internet connection or use local files.', 'danger');
                    return;
                }

                // Verify Select2 is available
                if (typeof $.fn.select2 === 'undefined') {
                    console.error('Select2 is not loaded');
                    showMessage('Select2 failed to load. Please check your internet connection or use local files.', 'danger');
                    return;
                }

                // Verify the select element exists
                const $prisonerSelect = $('#pims-prisoner-select');
                if ($prisonerSelect.length === 0) {
                    console.error('Select element #pims-prisoner-select not found');
                    showMessage('Prisoner select element not found. Please check the HTML.', 'danger');
                    return;
                }

                // Initialize Select2
                try {
                    $prisonerSelect.select2({
                        placeholder: "-- Select a Prisoner --",
                        allowClear: true,
                        minimumInputLength: 0,
                        minimumResultsForSearch: 1, // Show search bar even with 1 option
                        width: '100%',
                        dropdownCssClass: 'select2-dropdown',
                        searchInputPlaceholder: 'Search prisoners...'
                    });
                    console.log('Select2 initialized successfully for #pims-prisoner-select');
                } catch (error) {
                    console.error('Error initializing Select2:', error);
                    showMessage('Failed to initialize prisoner selection. Please try again.', 'danger');
                    return;
                }

                const form = document.getElementById('release-prisoner-form');
                const prisonerSelect = document.getElementById('pims-prisoner-select');
                const releaseBtn = document.getElementById('release-btn');
                const confirmModal = document.getElementById('pims-confirm-modal');
                const confirmReleaseBtn = document.getElementById('confirm-release-btn');

                // Handle Select2 change events
                $prisonerSelect.on('select2:select select2:unselect', setPrisonerId);

                releaseBtn.addEventListener('click', () => {
                    if (!prisonerSelect.value) {
                        showMessage('Please select a prisoner.', 'danger');
                        return;
                    }
                    confirmModal.classList.add('active');
                });

                confirmReleaseBtn.addEventListener('click', () => {
                    form.submit();
                });

                document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        confirmModal.classList.remove('active');
                    });
                });

                confirmModal.addEventListener('click', e => {
                    if (e.target === confirmModal) {
                        confirmModal.classList.remove('active');
                    }
                });

                form.addEventListener('submit', (e) => {
                    if (!prisonerSelect.value) {
                        e.preventDefault();
                        showMessage('Please select a prisoner.', 'danger');
                    }
                });
            });
        })(jQuery.noConflict());
    </script>
    @include('includes.footer_js')
</body>
</html>