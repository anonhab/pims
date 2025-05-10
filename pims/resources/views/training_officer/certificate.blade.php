<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of {{ $certification_type }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Palatino+Linotype|Book+Antiqua|Georgia|serif&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Palatino Linotype', 'Book Antiqua', Georgia, serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .certificate {
            width: 800px;
            min-height: 600px;
            background: #fff;
            border: 8px double #b8860b; /* Gold double border */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
            padding: 20px;
            box-sizing: border-box;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px solid #003366; /* Dark blue inner border */
            pointer-events: none;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 36px;
            color: #003366; /* Dark blue */
            margin: 0;
            font-weight: bold;
        }
        .header h2 {
            font-size: 24px;
            color: #b8860b; /* Gold */
            margin: 10px 0;
            font-weight: bold;
        }
        .congratulatory {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            color: #003366;
        }
        .congratulatory .recipient {
            font-size: 28px;
            font-weight: bold;
            color: #003366;
            margin: 10px 0;
        }
        .details, .activities {
            margin: 20px 40px;
            color: #003366;
        }
        .details h3, .activities h3 {
            font-size: 22px;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .details dl {
            font-size: 16px;
        }
        .details dt {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .details dd {
            margin-bottom: 15px;
            margin-left: 20px;
        }
        .activities h4 {
            font-size: 18px;
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }
        .activities ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }
        .activities ul li {
            font-size: 16px;
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }
        .activities ul li::before {
            content: '•';
            color: #b8860b; /* Gold bullet */
            position: absolute;
            left: 0;
            font-size: 20px;
        }
        .activities .none {
            font-size: 16px;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #003366;
            font-style: italic;
            font-size: 16px;
        }
        .footer .signature {
            margin-top: 10px;
            border-top: 1px solid #003366;
            width: 150px;
            margin: 10px auto 0;
            padding-top: 5px;
            font-size: 14px;
            font-style: normal;
        }
        @media print {
            body {
                background: none;
            }
            .certificate {
                box-shadow: none;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <img src="{{ asset('images/prison-logo.png') }}" alt="Logo">
            <h1>Prison Information Management System</h1>
            <h2>Certificate of {{ $certification_type }}</h2>
        </div>
        <div class="congratulatory">
            <p>This certificate is proudly presented to</p>
            <p class="recipient">{{ $prisoner_name }}</p>
            <p>for successfully completing the requirements for</p>
            <p><strong>{{ $certification_type }}</strong></p>
        </div>
        <div class="details">
            <h3>Certification Details</h3>
            <dl>
                <dt>Details:</dt>
                <dd>{{ $certification_details }}</dd>
                <dt>Issued By:</dt>
                <dd>{{ $issued_by }}</dd>
                <dt>Issued Date:</dt>
                <dd>{{ $issued_date }}</dd>
            </dl>
        </div>
        <div class="activities">
            <h3>Completed Activities</h3>
            <h4>Completed Jobs</h4>
            @if(count($completed_jobs) > 0)
                <ul>
                    @foreach($completed_jobs as $job)
                        <li><strong>{{ $job['job_title'] }}</strong> (Completed on: {{ $job['completed_date'] }})</li>
                    @endforeach
                </ul>
            @else
                <p class="none">None</p>
            @endif
            <h4>Completed Training Programs</h4>
            @if(count($completed_trainings) > 0)
                <ul>
                    @foreach($completed_trainings as $training)
                        <li><strong>{{ $training['training_title'] }}</strong> (Completed on: {{ $training['completed_date'] }})</li>
                    @endforeach
                </ul>
            @else
                <p class="none">None</p>
            @endif
        </div>
        <div class="footer">
            <p>Awarded on this day, {{ $today }}</p>
            <div class="signature">Authorized Signature</div>
        </div>
    </div>
</body>
</html>