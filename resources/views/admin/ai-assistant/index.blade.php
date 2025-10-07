@extends('crm.layouts.clean_app')

@section('titulo', 'Configuración del Asistente de IA')

@section('css')
<style>
    .ai-assistant-header {
        background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 32px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }
    
    .ai-assistant-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    .ai-assistant-header h1 {
        font-size: 2.8rem;
        font-weight: 900;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }
    
    .ai-assistant-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .section-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .section-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .section-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-header h3 {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-content {
        padding: 24px;
    }
    
    .section-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }
    
    .section-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    .section-icon {
        font-size: 1.2rem;
        color: #D93690;
    }
    
    .section-description {
        color: #6b7280;
        margin-bottom: 20px;
    }
    
    .section-stats {
        display: flex;
        gap: 20px;
        margin-top: 16px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    .stat-number {
        font-weight: 600;
        color: #D93690;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.1; }
        50% { opacity: 0.2; }
    }
</style>
@endsection

@section('content')
<div style="background: #f8fafc; min-height: 100vh; padding: 0;">
    <!-- Header -->
    <div class="ai-assistant-header">
        <h1><i class="fas fa-robot" style="margin-right: 12px;"></i> Configuración del Asistente de IA</h1>
        <p>Gestiona la configuración, prompts y enlaces del asistente virtual</p>
    </div>

    <!-- Main Content -->
    <div style="padding: 24px;">
        <div class="row">
            <!-- Configuración General -->
            <div class="col-lg-6 col-md-12 mb-4">
                <a href="{{ route('admin.ai-assistant.config') }}" class="section-link">
                    <div class="section-card">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-cog section-icon"></i>
                                Configuración General
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="section-description">Configura los parámetros básicos del asistente, colores, modelo de IA y mensajes.</p>
                            <div class="section-stats">
                                <div class="stat-item">
                                    <i class="fas fa-toggle-on"></i>
                                    <span>Estado: <span class="stat-number">{{ $config->is_active ? 'Activo' : 'Inactivo' }}</span></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-robot"></i>
                                    <span>Modelo: <span class="stat-number">{{ $config->ai_model }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Prompts -->
            <div class="col-lg-6 col-md-12 mb-4">
                <a href="{{ route('admin.ai-assistant.prompts') }}" class="section-link">
                    <div class="section-card">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-lightbulb section-icon"></i>
                                Prompts
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="section-description">Gestiona los prompts personalizados para diferentes categorías de consultas.</p>
                            <div class="section-stats">
                                <div class="stat-item">
                                    <i class="fas fa-list"></i>
                                    <span>Total: <span class="stat-number">{{ \App\Models\AiPrompt::count() }}</span></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Activos: <span class="stat-number">{{ \App\Models\AiPrompt::where('is_active', true)->count() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Enlaces -->
            <div class="col-lg-6 col-md-12 mb-4">
                <a href="{{ route('admin.ai-assistant.links') }}" class="section-link">
                    <div class="section-card">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-link section-icon"></i>
                                Enlaces
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="section-description">Administra los enlaces que el asistente puede recomendar a los usuarios.</p>
                            <div class="section-stats">
                                <div class="stat-item">
                                    <i class="fas fa-list"></i>
                                    <span>Total: <span class="stat-number">{{ \App\Models\AiLink::count() }}</span></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Activos: <span class="stat-number">{{ \App\Models\AiLink::where('is_active', true)->count() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Conversaciones -->
            <div class="col-lg-6 col-md-12 mb-4">
                <a href="{{ route('admin.ai-assistant.conversations') }}" class="section-link">
                    <div class="section-card">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-comments section-icon"></i>
                                Conversaciones
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="section-description">Revisa el historial de conversaciones entre usuarios y el asistente.</p>
                            <div class="section-stats">
                                <div class="stat-item">
                                    <i class="fas fa-comments"></i>
                                    <span>Total: <span class="stat-number">{{ \App\Models\AiConversation::count() }}</span></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Hoy: <span class="stat-number">{{ \App\Models\AiConversation::whereDate('created_at', today())->count() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection