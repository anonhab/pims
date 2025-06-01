<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>PIMS - Certificate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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

        .pims-app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 70px;
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
            margin: 0 auto;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            height: 1122px; /* A4 height in pixels at 96dpi */
            box-sizing: border-box;
        }

        .pims-certificate-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
        }

        .pims-certificate-flags {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .pims-certificate-flags img {
            height: 50px;
            object-fit: contain;
        }

        .pims-certificate-header {
            text-align: center;
            margin-bottom: 1.5rem;
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
            width: 80px;
            height: 3px;
            background: var(--pims-accent);
        }

        .pims-certificate-header img {
            height: 70px;
            margin-bottom: 0.5rem;
        }

        .pims-certificate-header h1 {
            font-size: 1.5rem;
            color: var(--pims-primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pims-certificate-header h2 {
            font-size: 1.3rem;
            color: var(--pims-accent);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pims-certificate-congratulatory {
            text-align: center;
            margin: 1.5rem 0;
            padding: 1rem 0;
            border-top: 1px dashed var(--pims-light);
            border-bottom: 1px dashed var(--pims-light);
            position: relative;
        }

        .pims-certificate-congratulatory::before,
        .pims-certificate-congratulatory::after {
            content: "✧";
            color: var(--pims-accent);
            position: absolute;
            font-size: 1.2rem;
        }

        .pims-certificate-congratulatory::before {
            left: 15px;
            top: 8px;
        }

        .pims-certificate-congratulatory::after {
            right: 15px;
            bottom: 8px;
        }

        .pims-certificate-congratulatory p {
            margin: 0.4rem 0;
            font-size: 1rem;
        }

        .pims-certificate-recipient {
            font-size: 1.5rem !important;
            font-weight: 600;
            color: var(--pims-primary);
            margin: 0.8rem 0 !important;
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
            width: 25px;
            height: 2px;
            background: var(--pims-accent);
        }

        .pims-certificate-recipient::before {
            left: -25px;
        }

        .pims-certificate-recipient::after {
            right: -25px;
        }

        .pims-certificate-details {
            margin: 1.5rem 0;
        }

        .pims-certificate-details h3 {
            color: var(--pims-primary);
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            border-bottom: 1px solid var(--pims-light);
            padding-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-certificate-details dl {
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.6rem 0.8rem;
            font-size: 0.95rem;
        }

        .pims-certificate-details dt {
            font-weight: 600;
            color: var(--pims-secondary);
        }

        .pims-certificate-details dd {
            color: var(--pims-primary);
            padding-left: 0.8rem;
            border-left: 2px solid var(--pims-light);
        }

        .pims-certificate-activities {
            margin: 1.5rem 0;
        }

        .pims-certificate-activities h3 {
            color: var(--pims-primary);
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            border-bottom: 1px solid var(--pims-light);
            padding-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-certificate-activities h4 {
            color: var(--pims-secondary);
            margin: 0.8rem 0 0.4rem;
            font-size: 1rem;
            font-weight: 500;
        }

        .pims-certificate-activities ul {
            list-style-type: none;
            margin-left: 0.8rem;
            font-size: 0.95rem;
        }

        .pims-certificate-activities li {
            margin-bottom: 0.4rem;
            padding-left: 1.2rem;
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
            padding-left: 1.2rem;
            font-size: 0.95rem;
        }

        .pims-certificate-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 2px solid var(--pims-light);
            position: relative;
        }

        .pims-certificate-footer p {
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .pims-certificate-signature {
            display: inline-block;
            padding-top: 2.5rem;
            font-weight: 600;
            color: var(--pims-primary);
            position: relative;
            min-width: 200px;
            font-size: 1rem;
        }

        .pims-certificate-signature::before {
            content: "";
            position: absolute;
            top: 0.8rem;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--pims-primary);
        }

        .pims-certificate-seal {
            position: absolute;
            right: 1.5rem;
            bottom: 1.5rem;
            opacity: 0.1;
            width: 80px;
            height: 80px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .pims-certificate-actions {
                display: none;
            }
            .pims-certificate-container {
                box-shadow: none;
                margin: 0;
                padding: 1rem;
                border: none;
                height: auto;
                min-height: 100vh;
            }
            .pims-app-container {
                padding: 0;
            }
            .pims-certificate-container::before {
                height: 5px;
            }
        }

        @media (max-width: 768px) {
            .pims-certificate-container {
                padding: 1rem;
                margin: 0 auto;
                height: auto;
            }
            .pims-certificate-header h1 {
                font-size: 1.3rem;
            }
            .pims-certificate-header h2 {
                font-size: 1.1rem;
            }
            .pims-certificate-recipient {
                font-size: 1.3rem !important;
            }
            .pims-certificate-flags img {
                height: 40px;
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
       <!-- Navigation -->
    @include('includes.nav')
        @include('training_officer.menu')
</head>
<body>
      <div class="pims-app-container">
        <div class="pims-certificate-actions">
            <button class="pims-btn pims-btn-primary" id="download-pdf">
                <i class="fas fa-download"></i> Download PDF
            </button>
            <button class="pims-btn pims-btn-secondary" id="print-certificate">
                <i class="fas fa-print"></i> Print Certificate
            </button>
        </div>

        <div class="pims-certificate-container" id="certificate-content">
            <div class="pims-certificate-flags">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/71/Flag_of_Ethiopia.svg" alt="Ethiopian Flag">
                <img src="data:image/png;base64,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" alt="Central Ethiopia Region Flag">
            </div>
            
            <div class="pims-certificate-header">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Prison Logo">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add watermark effect for better security
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

            // Generate PDF function (used for both download and print)
            function generatePDF(action = 'download') {
                const element = document.getElementById('certificate-content');
                const opt = {
                    margin: [10, 10, 10, 10], // T, R, B, L
                    filename: 'PIMS_Certificate.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { 
                        scale: 2,
                        logging: false,
                        useCORS: true,
                        allowTaint: true,
                        letterRendering: true,
                        width: 794, // A4 width in pixels at 96dpi
                        height: 1122 // A4 height in pixels at 96dpi
                    },
                    jsPDF: { 
                        unit: 'mm', 
                        format: 'a4', 
                        orientation: 'portrait',
                        compress: true
                    },
                    pagebreak: { mode: 'avoid-all' }
                };

                // Create PDF
                html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                    if (action === 'print') {
                        // For printing, open in new window and trigger print
                        const blob = pdf.output('blob');
                        const url = URL.createObjectURL(blob);
                        const win = window.open(url, '_blank');
                        win.onload = function() {
                            setTimeout(function() {
                                win.print();
                                URL.revokeObjectURL(url);
                            }, 500);
                        };
                    } else {
                        // For download, just save it
                        html2pdf().set(opt).from(element).save();
                    }
                });
            }

            // Download PDF button
            document.getElementById('download-pdf').addEventListener('click', function() {
                generatePDF('download');
            });

            // Print button - uses the same PDF generation but opens print dialog
            document.getElementById('print-certificate').addEventListener('click', function() {
                generatePDF('print');
            });
        });
    </script>
</body>
</html>