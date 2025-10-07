@extends('crm.layouts.clean_app')

@section('titulo', 'Prompts del Asistente de IA')

@section('content')
<div style="background: #f8fafc; min-height: 100vh; padding: 0;">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; padding: 40px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.15); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); animation: pulse 4s ease-in-out infinite;"></div>
        <h1 style="font-size: 2.8rem; font-weight: 900; margin-bottom: 12px; position: relative; z-index: 1;"><i class="fas fa-lightbulb" style="margin-right: 12px;"></i> Gestión de Prompts</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin: 0; position: relative; z-index: 1;">Gestiona los prompts personalizados del asistente de IA</p>
    </div>

    <!-- Main Content -->
    <div style="padding: 24px; max-width: 1200px; margin: 0 auto;">
        @include('admin.ai-assistant.sections.prompts')
    </div>
</div>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 0.1; }
        50% { opacity: 0.2; }
    }
</style>
@endsection
