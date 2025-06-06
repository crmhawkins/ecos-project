<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Finalización</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #2c3e50;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .certificate-container {
            text-align: center;
            padding: 20px;
            border: 4px solid #34495e;
            height: 100%;
            position: relative;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1a252f;
        }

        .subtitle {
            font-size: 20px;
            margin-top: 10px;
            color: #555;
        }

        .recipient {
            margin-top: 50px;
            font-size: 26px;
            font-weight: bold;
            color: #000;
        }

        .course-name {
            font-size: 22px;
            color: #2c3e50;
            margin-top: 15px;
        }

        .completion-date {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .footer {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature {
            text-align: left;
        }

        .signature img {
            max-height: 60px;
        }

        .signature-name {
            margin-top: 5px;
            font-size: 14px;
        }

        .info {
            text-align: right;
            font-size: 12px;
            color: #777;
        }

        .verification {
            font-size: 12px;
            color: #0066cc;
            margin-top: 5px;
        }

    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="title">Certificado de Finalización</div>
        <div class="subtitle">Este certificado se otorga a</div>

        <div class="recipient">
            {{ $user['fullname'] ?? $user['firstname'] . ' ' . $user['lastname'] }}
        </div>

        <div class="subtitle">por completar satisfactoriamente el curso</div>

        <div class="course-name">
            {{ $course['fullname'] }}
        </div>

        <div class="completion-date">
            Finalizado el {{ $completionDate }}
        </div>

        <div class="footer">
            <div class="signature">
                @if($signatureImagePath)
                    <img src="{{ $signatureImagePath }}" alt="Firma">
                @endif
                <div class="signature-name">Dirección Académica</div>
            </div>
        </div>
    </div>
</body>
</html>
