<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <title>PIMS Dashboard</title>
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

        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: var(--pims-text-dark);
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims-nav-height);
        }

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Dashboard Cards */
        .pims-dashboard-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
            height: 100%;
        }

        .pims-card-header {
            padding: 1rem;
            background-color: var(--pims-primary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            font-weight: 600;
        }

        .pims-card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .pims-stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--pims-primary);
            margin: 1rem 0;
        }

        .pims-stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Activity Section */
        .pims-activity-card {
            height: 100%;
        }

        .pims-activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pims-activity-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .pims-activity-item:last-child {
            border-bottom: none;
        }

        .pims-activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(41, 128, 185, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--pims-accent);
        }

        .pims-activity-content {
            flex: 1;
        }

        .pims-activity-time {
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        /* Quick Actions */
        .pims-quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .pims-action-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: var(--pims-border-radius);
            background-color: white;
            box-shadow: var(--pims-card-shadow);
            transition: var(--pims-transition);
            text-decoration: none;
            color: var(--pims-primary);
        }

        .pims-action-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: var(--pims-accent);
        }

        .pims-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(41, 128, 185, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--pims-accent);
        }

        /* Empty State */
        .pims-empty-state {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
        }

        .pims-empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: rgba(0, 0, 0, 0.1);
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .pims-content-area {
                margin-left: 0;
            }

            .pims-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        <!-- Sidebar Menu -->
        @include('visitor.menu')

        <!-- Main Content Area -->
        <div class="pims-content-area">
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>