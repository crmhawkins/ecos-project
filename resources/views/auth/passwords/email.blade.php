<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Contraseña - CRM Ecos</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #D93690;
            --secondary-color: #8B5CF6;
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
            --success-color: #10b981;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .reset-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            padding: 60px 40px;
            text-align: center;
        }

        .reset-header {
            margin-bottom: 40px;
        }

        .reset-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .reset-header p {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 24px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1);
        }

        .btn-reset {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(217, 54, 144, 0.3);
        }

        .btn-reset:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .back-to-login {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .back-to-login a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
        }

        .back-to-login a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .reset-container {
                margin: 0;
                padding: 40px 30px;
                border-radius: 16px;
            }

            .reset-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-header">
            <h1><i class="fas fa-key"></i> Recuperar Contraseña</h1>
            <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Error:</strong>
                    <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    placeholder="tu@email.com"
                    required 
                    autofocus
                    autocomplete="email"
                >
            </div>

            <button type="submit" class="btn-reset">
                <i class="fas fa-paper-plane"></i> Enviar Enlace de Recuperación
            </button>
        </form>

        <div class="back-to-login">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i> Volver al Login
            </a>
        </div>
    </div>
</body>
</html>
