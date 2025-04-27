<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Visitor Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* Main Layout */
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

        /* Page Header */
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

        /* Alert Messages */
        .pims-alert-success {
            background-color: var(--pims-success);
            color: white;
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
        }

        /* Cards Grid */
        .pims-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pims-visitor-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 1.5rem;
            border: 1px solid #eee;
            transition: var(--pims-transition);
        }

        .pims-visitor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            margin-bottom: 1rem;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-card-subtitle {
            font-size: 0.875rem;
            color: var(--pims-secondary);
        }

        .pims-card-body {
            font-size: 0.875rem;
            color: var(--pims-secondary);
        }

        .pims-info-item {
            margin-bottom: 0.5rem;
            display: flex;
        }

        .pims-info-label {
            font-weight: 500;
            min-width: 100px;
            color: var(--pims-primary);
        }

        .pims-card-footer {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 0.875rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.8em;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
        }

        .pims-btn-warning {
            background-color: var(--pims-warning);
            color: white;
        }

        .pims-btn-warning:hover {
            background-color: #e67e22;
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        .pims-btn-light {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-light:hover {
            background-color: #dfe6e9;
        }

        /* Modal Styles */
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
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-header i {
            color: var(--pims-accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
        }

        .pims-modal-close:hover {
            color: var(--pims-primary);
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

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .pims-form-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-modal-container {
                width: 95%;
            }
        }

        @media (max-width: 480px) {
            .pims-card-footer {
                flex-direction: column;
            }
            
            .pims-card-footer .pims-btn {
                width: 100%;
            }
            
            .pims-modal-footer {
                flex-direction: column;
            }
            
            .pims-modal-footer .pims-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        <!-- Navigation -->
        @include('includes.nav')
        
        <!-- Sidebar -->
        @include('security_officer.menu')
        
        <main class="pims-main-content">
            <div class="pims-content-container">
                <!-- Page Header -->
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-users"></i> Visitor Management
                    </h2>
                </div>
                
                <!-- Success Message -->
                @if (session('success'))
                <div class="pims-alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                <!-- Visitors Grid -->
                <div class="pims-cards-grid">
                    @foreach ($visitors as $visitor)
                    <div class="pims-visitor-card">
                        <div class="pims-card-header">
                            <h3 class="pims-card-title">{{ $visitor->first_name }} {{ $visitor->last_name }}</h3>
                            <p class="pims-card-subtitle">Username: {{ $visitor->username }}</p>
                        </div>
                        
                        <div class="pims-card-body">
                            <div class="pims-info-item">
                                <span class="pims-info-label">Phone:</span>
                                <span>{{ $visitor->phone_number }}</span>
                            </div>
                            <div class="pims-info-item">
                                <span class="pims-info-label">Relationship:</span>
                                <span>{{ $visitor->relationship }}</span>
                            </div>
                            <div class="pims-info-item">
                                <span class="pims-info-label">Address:</span>
                                <span>{{ $visitor->address }}</span>
                            </div>
                            <div class="pims-info-item">
                                <span class="pims-info-label">ID Number:</span>
                                <span>{{ $visitor->identification_number }}</span>
                            </div>
                        </div>
                        
                        <div class="pims-card-footer">
                            <button onclick="pimsOpenModal('pims-edit-modal-{{ $visitor->id }}')" 
                                class="pims-btn pims-btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <form action="{{ route('security_officer.deleteVisitor', $visitor->id) }}" 
                                method="POST" 
                                onsubmit="return pimsConfirmDelete('Are you sure you want to delete this visitor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pims-btn pims-btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Edit Modal -->
                    <div class="pims-modal" id="pims-edit-modal-{{ $visitor->id }}">
                        <div class="pims-modal-container">
                            <div class="pims-modal-header">
                                <h3><i class="fas fa-user-edit"></i> Edit Visitor</h3>
                                <button class="pims-modal-close" onclick="pimsCloseModal('pims-edit-modal-{{ $visitor->id }}')">&times;</button>
                            </div>
                            
                            <form action="{{ route('security_officer.updateVisitor', $visitor->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="pims-modal-body">
                                    <div class="pims-form-grid">
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">First Name</label>
                                            <input type="text" name="first_name" value="{{ $visitor->first_name }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Last Name</label>
                                            <input type="text" name="last_name" value="{{ $visitor->last_name }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Phone Number</label>
                                            <input type="text" name="phone_number" value="{{ $visitor->phone_number }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Relationship</label>
                                            <input type="text" name="relationship" value="{{ $visitor->relationship }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Address</label>
                                            <input type="text" name="address" value="{{ $visitor->address }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">ID Number</label>
                                            <input type="text" name="identification_number" value="{{ $visitor->identification_number }}" 
                                                required class="pims-form-control">
                                        </div>
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Username</label>
                                            <input type="text" name="username" value="{{ $visitor->username }}" 
                                                required class="pims-form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pims-modal-footer">
                                    <button type="button" class="pims-btn pims-btn-light" 
                                        onclick="pimsCloseModal('pims-edit-modal-{{ $visitor->id }}')">
                                        Cancel
                                    </button>
                                    <button type="submit" class="pims-btn pims-btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Add New Visitor Button -->
                <div class="pims-form-actions">
                    <a href="{{ route('security_officer.registerVisitor') }}" 
                        class="pims-btn pims-btn-primary">
                        <i class="fas fa-user-plus"></i> Register New Visitor
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Modal functions
        function pimsOpenModal(id) {
            document.getElementById(id).classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function pimsCloseModal(id) {
            document.getElementById(id).classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Close when clicking outside modal
        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('pims-modal')) {
                const modals = document.querySelectorAll('.pims-modal.active');
                modals.forEach(modal => {
                    modal.classList.remove('active');
                });
                document.body.style.overflow = '';
            }
        });
        
        // Confirm delete function
        function pimsConfirmDelete(message) {
            return confirm(message);
        }
    </script>
    
    @include('includes.footer_js')
</body>
</html>