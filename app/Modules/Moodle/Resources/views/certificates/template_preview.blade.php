<?php

namespace App\Modules\Moodle\Resources\views\certificates;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla de Certificado</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .certificate-container {
            width: 842px; /* A4 landscape */
            height: 595px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .certificate-header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #f0f0f0;
        }
        .certificate-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .certificate-subtitle {
            font-size: 18px;
            color: #666;
        }
        .certificate-content {
            padding: 30px 50px;
            text-align: center;
        }
        .certificate-statement {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .certificate-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .certificate-course {
            font-size: 20px;
            font-weight: bold;
            color: #444;
            margin: 20px 0;
        }
        .certificate-date {
            font-size: 16px;
            color: #666;
            margin: 20px 0;
        }
        .certificate-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }
        .certificate-signature {
            margin: 0 auto;
            width: 150px;
            border-top: 1px solid #333;
            padding-top: 5px;
            font-size: 14px;
            color: #555;
        }
        .certificate-id {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        .certificate-verification {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
            color: #999;
        }
        .certificate-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            opacity: 0.1;
            width: 150px;
            height: 150px;
        }
        .certificate-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.03);
            z-index: 0;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-watermark">CERTIFICADO</div>
        
        <div class="certificate-header">
            <div class="certificate-title">CERTIFICADO DE FINALIZACIÓN</div>
            <div class="certificate-subtitle">Plataforma de Aprendizaje en Línea</div>
        </div>
        
        <div class="certificate-content">
            <div class="certificate-statement">Este certificado acredita que:</div>
            <div class="certificate-name">[NOMBRE DEL ESTUDIANTE]</div>
            <div class="certificate-statement">Ha completado satisfactoriamente el curso:</div>
            <div class="certificate-course">[NOMBRE DEL CURSO]</div>
            <div class="certificate-date">Fecha de finalización: [FECHA]</div>
        </div>
        
        <div class="certificate-footer">
            <div class="certificate-signature">Firma Autorizada</div>
        </div>
        
        <div class="certificate-verification">
            Verificar en: [URL DE VERIFICACIÓN]
        </div>
        
        <div class="certificate-id">ID: [CERTIFICADO-ID]</div>
    </div>
</body>
</html>
