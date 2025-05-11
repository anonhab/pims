<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Certificate</title>
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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        .pims-app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .pims-certificate-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem auto;
            width: 100%;
            max-width: 800px;
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
            text-decoration: none;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: var(--pims-secondary);
            color: white;
        }

        .pims-btn-secondary:hover {
            background-color: #2c3e50;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-certificate-container {
            width: 100%;
            max-width: 800px;
            margin: 1rem auto 3rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .pims-certificate-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
        }

        .pims-certificate-flags {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .pims-certificate-flags img {
            height: 60px;
            object-fit: contain;
        }

        .pims-certificate-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--pims-light);
            position: relative;
        }

        .pims-certificate-header::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--pims-accent);
        }

        .pims-certificate-header img {
            height: 80px;
            margin-bottom: 1rem;
        }

        .pims-certificate-header h1 {
            font-size: 1.75rem;
            color: var(--pims-primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pims-certificate-header h2 {
            font-size: 1.5rem;
            color: var(--pims-accent);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pims-certificate-congratulatory {
            text-align: center;
            margin: 2rem 0;
            padding: 1.5rem 0;
            border-top: 1px dashed var(--pims-light);
            border-bottom: 1px dashed var(--pims-light);
            position: relative;
        }

        .pims-certificate-congratulatory::before,
        .pims-certificate-congratulatory::after {
            content: "✧";
            color: var(--pims-accent);
            position: absolute;
            font-size: 1.5rem;
        }

        .pims-certificate-congratulatory::before {
            left: 20px;
            top: 10px;
        }

        .pims-certificate-congratulatory::after {
            right: 20px;
            bottom: 10px;
        }

        .pims-certificate-congratulatory p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }

        .pims-certificate-recipient {
            font-size: 1.75rem !important;
            font-weight: 600;
            color: var(--pims-primary);
            margin: 1rem 0 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
            padding: 0 1rem;
        }

        .pims-certificate-recipient::before,
        .pims-certificate-recipient::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30px;
            height: 2px;
            background: var(--pims-accent);
        }

        .pims-certificate-recipient::before {
            left: -30px;
        }

        .pims-certificate-recipient::after {
            right: -30px;
        }

        .pims-certificate-details {
            margin: 2rem 0;
        }

        .pims-certificate-details h3 {
            color: var(--pims-primary);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            border-bottom: 1px solid var(--pims-light);
            padding-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-certificate-details dl {
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.75rem 1rem;
        }

        .pims-certificate-details dt {
            font-weight: 600;
            color: var(--pims-secondary);
        }

        .pims-certificate-details dd {
            color: var(--pims-primary);
            padding-left: 1rem;
            border-left: 2px solid var(--pims-light);
        }

        .pims-certificate-activities {
            margin: 2rem 0;
        }

        .pims-certificate-activities h3 {
            color: var(--pims-primary);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            border-bottom: 1px solid var(--pims-light);
            padding-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-certificate-activities h4 {
            color: var(--pims-secondary);
            margin: 1rem 0 0.5rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .pims-certificate-activities ul {
            list-style-type: none;
            margin-left: 1rem;
        }

        .pims-certificate-activities li {
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .pims-certificate-activities li::before {
            content: "▹";
            color: var(--pims-accent);
            position: absolute;
            left: 0;
        }

        .pims-certificate-none {
            color: var(--pims-secondary);
            font-style: italic;
            padding-left: 1.5rem;
        }

        .pims-certificate-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 2px solid var(--pims-light);
            position: relative;
        }

        .pims-certificate-footer p {
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .pims-certificate-signature {
            display: inline-block;
            padding-top: 3rem;
            font-weight: 600;
            color: var(--pims-primary);
            position: relative;
            min-width: 250px;
        }

        .pims-certificate-signature::before {
            content: "";
            position: absolute;
            top: 1rem;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--pims-primary);
        }

        .pims-certificate-seal {
            position: absolute;
            right: 2rem;
            bottom: 2rem;
            opacity: 0.1;
            width: 100px;
            height: 100px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .pims-certificate-actions {
                display: none;
            }
            .pims-certificate-container {
                box-shadow: none;
                margin: 0;
                padding: 1rem;
                border: none;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
            .pims-app-container {
                padding-top: 0;
            }
            .pims-certificate-container::before {
                height: 5px;
            }
        }

        @media (max-width: 768px) {
            .pims-certificate-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            .pims-certificate-header h1 {
                font-size: 1.5rem;
            }
            .pims-certificate-header h2 {
                font-size: 1.25rem;
            }
            .pims-certificate-recipient {
                font-size: 1.5rem !important;
            }
            .pims-certificate-flags img {
                height: 50px;
            }
            .pims-certificate-actions {
                flex-direction: column;
                align-items: center;
            }
            .pims-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->

    
    <div class="pims-app-container">
        

        <div class="pims-certificate-container" id="certificate-content">
            <div class="pims-certificate-flags">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/71/Flag_of_Ethiopia.svg" alt="Ethiopian Flag">
                <img src="data:image/jpeg;base64,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" alt="Central Ethiopia Region Flag">
            </div>
            
            <div class="pims-certificate-header">
                <img src="{{ asset('images/prison-logo.png') }}" alt="Prison Logo">
                <h1>Prison Information Management System</h1>
                <h2>Certificate of {{ $certification_type }}</h2>
            </div>
            
            <div class="pims-certificate-congratulatory">
                <p>This certificate is proudly presented to</p>
                <p class="pims-certificate-recipient">{{ $prisoner_name }}</p>
                <p>for successfully completing the requirements for</p>
                <p><strong>{{ $certification_type }}</strong></p>
            </div>
            
            <div class="pims-certificate-details">
                <h3>Certification Details</h3>
                <dl>
                    <dt>Details:</dt>
                    <dd>{{ $certification_details }}</dd>
                    <dt>Issued By:</dt>
                    <dd>{{ $issued_by }}</dd>
                    <dt>Issued Date:</dt>
                    <dd>{{ $issued_date }}</dd>
                    <dt>Certificate ID:</dt>
                    <dd>{{ $certificate_id ?? 'PIMS-' . strtoupper(uniqid()) }}</dd>
                </dl>
            </div>
            
            <div class="pims-certificate-activities">
                <h3>Completed Activities</h3>
                <h4>Completed Jobs</h4>
                @if(count($completed_jobs) > 0)
                    <ul>
                        @foreach($completed_jobs as $job)
                            <li><strong>{{ $job['job_title'] }}</strong> (Completed on: {{ $job['completed_date'] }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="pims-certificate-none">No job activities recorded</p>
                @endif
                
                <h4>Completed Training Programs</h4>
                @if(count($completed_trainings) > 0)
                    <ul>
                        @foreach($completed_trainings as $training)
                            <li><strong>{{ $training['training_title'] }}</strong> (Completed on: {{ $training['completed_date'] }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="pims-certificate-none">No training programs completed</p>
                @endif
            </div>
            
            <div class="pims-certificate-footer">
                <p>Awarded on this day, {{ $today }}</p>
                <div class="pims-certificate-signature">Authorized Signature</div>
                <svg class="pims-certificate-seal" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="var(--pims-primary)" stroke-width="2"/>
                    <path d="M50 10 L50 90 M10 50 L90 50" stroke="var(--pims-primary)" stroke-width="2"/>
                    <circle cx="50" cy="50" r="15" fill="none" stroke="var(--pims-primary)" stroke-width="2"/>
                </svg>
            </div>
        </div>
    </div>

    <script>
        

        // Add watermark effect for better security
        document.addEventListener('DOMContentLoaded', function() {
            const certificate = document.getElementById('certificate-content');
            const watermark = document.createElement('div');
            watermark.style.position = 'absolute';
            watermark.style.top = '0';
            watermark.style.left = '0';
            watermark.style.width = '100%';
            watermark.style.height = '100%';
            watermark.style.background = 'url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'400\'><text x=\'50\' y=\'50\' font-size=\'20\' opacity=\'0.1\' transform=\'rotate(-45 100,100)\'>OFFICIAL CERTIFICATE - PIMS</text></svg>") repeat';
            watermark.style.pointerEvents = 'none';
            watermark.style.zIndex = '100';
            certificate.style.position = 'relative';
            certificate.appendChild(watermark);
        });
    </script>
</body>
</html>