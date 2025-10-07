<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden; transition: all 0.3s ease;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-cog" style="font-size: 1.2rem; color: #D93690;"></i>
            Configuración General
        </h3>
    </div>
    <div style="padding: 24px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Vista Previa -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
            <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
                <h5 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #2d3748;">Vista Previa del Asistente</h5>
            </div>
            <div style="padding: 24px;">
                <div style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; padding: 20px; border-radius: 12px; margin-bottom: 16px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <h6 style="margin: 0 0 8px 0; font-weight: 700; font-size: 1.1rem;">{{ $config->assistant_name }}</h6>
                    <small style="opacity: 0.9; font-size: 0.9rem;">En línea</small>
                </div>
                <p style="margin-bottom: 8px;"><strong style="color: #2d3748;">Mensaje de bienvenida:</strong></p>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem; line-height: 1.5;">{{ $config->welcome_message }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <form action="{{ route('admin.ai-assistant.update-config') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 24px;">
                        <label for="assistant_name" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Nombre del Asistente</label>
                        <input type="text" id="assistant_name" name="assistant_name" 
                               value="{{ $config->assistant_name }}" required
                               style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%;">
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label for="welcome_message" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Mensaje de Bienvenida</label>
                        <textarea id="welcome_message" name="welcome_message" 
                                  rows="3" required
                                  style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%; resize: vertical;">{{ $config->welcome_message }}</textarea>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label for="system_prompt" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Prompt del Sistema</label>
                        <textarea id="system_prompt" name="system_prompt" 
                                  rows="5" required
                                  style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%; resize: vertical;">{{ $config->system_prompt }}</textarea>
                        <small style="color: #6b7280; font-size: 0.85rem; margin-top: 4px; display: block;">
                            Este prompt define el comportamiento del asistente. Usa variables como {company_name}, {years_experience}
                        </small>
                    </div>

                    <div class="row" style="margin-bottom: 24px;">
                        <div class="col-md-6" style="margin-bottom: 16px;">
                            <label for="ai_model" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Modelo de IA</label>
                            <select id="ai_model" name="ai_model" required
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%;">
                                <option value="gpt-3.5-turbo" {{ $config->ai_model == 'gpt-3.5-turbo' ? 'selected' : '' }}>GPT-3.5 Turbo</option>
                                <option value="gpt-4" {{ $config->ai_model == 'gpt-4' ? 'selected' : '' }}>GPT-4</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 16px;">
                            <label for="temperature" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Temperatura (0-2)</label>
                            <input type="number" id="temperature" name="temperature" 
                                   value="{{ $config->temperature }}" min="0" max="2" step="0.1" required
                                   style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%;">
                        </div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label for="max_tokens" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Máximo de Tokens</label>
                        <input type="number" id="max_tokens" name="max_tokens" 
                               value="{{ $config->max_tokens }}" min="100" max="4000" required
                               style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%;">
                    </div>

                    <div class="row" style="margin-bottom: 24px;">
                        <div class="col-md-6" style="margin-bottom: 16px;">
                            <label for="primary_color" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Color Primario</label>
                            <input type="color" id="primary_color" name="primary_color" 
                                   value="{{ $config->primary_color }}" required
                                   style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%; height: 45px;">
                        </div>
                        <div class="col-md-6" style="margin-bottom: 16px;">
                            <label for="secondary_color" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block; font-size: 0.95rem;">Color Secundario</label>
                            <input type="color" id="secondary_color" name="secondary_color" 
                                   value="{{ $config->secondary_color }}" required
                                   style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: white; width: 100%; height: 45px;">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <input type="checkbox" id="is_active" name="is_active" 
                               {{ $config->is_active ? 'checked' : '' }}
                               style="margin-right: 8px;">
                        <label for="is_active" style="font-weight: 500; color: #2d3748;">Asistente Activo</label>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <input type="checkbox" id="show_courses" name="show_courses" 
                               {{ $config->show_courses ? 'checked' : '' }}
                               style="margin-right: 8px;">
                        <label for="show_courses" style="font-weight: 500; color: #2d3748;">Mostrar Información de Cursos</label>
                    </div>
                    <div style="margin-bottom: 24px;">
                        <input type="checkbox" id="show_contact_info" name="show_contact_info" 
                               {{ $config->show_contact_info ? 'checked' : '' }}
                               style="margin-right: 8px;">
                        <label for="show_contact_info" style="font-weight: 500; color: #2d3748;">Mostrar Información de Contacto</label>
                    </div>

                    <button type="submit" style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); border: none; border-radius: 8px; padding: 12px 24px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(217, 54, 144, 0.3); color: white; cursor: pointer; margin-top: 16px;">
                        <i class="fas fa-save" style="margin-right: 8px;"></i> Guardar Configuración
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
