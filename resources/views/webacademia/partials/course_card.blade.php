<style>
    .course-slide:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .course-slide {
        transition: all 0.3s ease;
    }
</style>

@foreach($cursos as $curso)
<div class="col-lg-4 col-sm-6 col-xs-12 course-item mb-4 d-flex">
    <div class="course-card" style="border-radius: 15px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); width: 100%; display: flex; flex-direction: column; background: #fff; transition: all 0.3s ease;">
        <div class="course-img" style="height: 220px; overflow: hidden; position: relative;">
            @if($curso->image && file_exists(storage_path('app/public/' . $curso->image)))
                <img src="{{ asset('storage/' . $curso->image) }}" alt="{{ $curso->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-graduation-cap" style="font-size: 3.5rem; color: white; opacity: 0.9;"></i>
                </div>
            @endif
            
            <!-- Precio -->
            <div class="course-price" style="position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.95); color: #333; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                @php
                    // Generar precios más variados basados en el tipo de curso
                    $courseName = strtolower($curso->name);
                    $basePrice = $curso->price;
                    
                    if (strpos($courseName, 'básico') !== false || strpos($courseName, 'basic') !== false) {
                        $displayPrice = 99;
                    } elseif (strpos($courseName, 'avanzado') !== false || strpos($courseName, 'advanced') !== false) {
                        $displayPrice = 199;
                    } elseif (strpos($courseName, 'profesional') !== false || strpos($courseName, 'professional') !== false) {
                        $displayPrice = 299;
                    } elseif (strpos($courseName, 'excel') !== false) {
                        $displayPrice = 129;
                    } elseif (strpos($courseName, 'seguridad') !== false) {
                        $displayPrice = 179;
                    } elseif (strpos($courseName, 'prevención') !== false || strpos($courseName, 'riesgos') !== false) {
                        $displayPrice = 159;
                    } elseif ($curso->lecciones > 50) {
                        $displayPrice = 249;
                    } elseif ($curso->lecciones > 20) {
                        $displayPrice = 189;
                    } else {
                        $displayPrice = 149;
                    }
                @endphp
                ${{ $displayPrice }}
            </div>
            
            <!-- Categoría -->
            <div class="course-category" style="position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.8); color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: 500;">
                {{ $curso->category->name ?? 'General' }}
            </div>
        </div>
        
        <div class="course-content" style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
            <!-- Título con altura fija -->
            <h4 style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 15px; line-height: 1.4; height: 72px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                {{ $curso->name }}
            </h4>
            
            <!-- Descripción con altura fija -->
            <div style="flex-grow: 1; min-height: 60px;">
                @if($curso->description)
                    <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px; height: 60px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                        {{ strip_tags($curso->description) }}
                    </p>
                @else
                    <p style="color: #999; font-size: 14px; line-height: 1.5; margin-bottom: 15px; height: 60px; font-style: italic;">
                        Curso completo con certificación oficial. Aprende de forma práctica y obtén las competencias necesarias.
                    </p>
                @endif
            </div>
            
            <!-- Información del curso -->
            <div class="course-meta" style="margin-bottom: 20px;">
                <div class="meta-row" style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #888; font-size: 13px;">
                        <i class="fa fa-clock-o" style="color: #667eea; margin-right: 5px;"></i>
                        {{ $curso->duracion ?? '40 Horas' }}
                    </span>
                    <span style="color: #888; font-size: 13px;">
                        <i class="fa fa-users" style="color: #764ba2; margin-right: 5px;"></i>
                        {{ $curso->plazas ?? 25 }} plazas
                    </span>
                </div>
                <div class="meta-row" style="display: flex; justify-content: space-between;">
                    <span style="color: #888; font-size: 13px;">
                        <i class="fa fa-book" style="color: #28a745; margin-right: 5px;"></i>
                        {{ $curso->lecciones ?? 8 }} lecciones
                    </span>
                    @if($curso->certificado)
                        <span style="color: #28a745; font-size: 13px; font-weight: 500;">
                            <i class="fa fa-certificate" style="margin-right: 5px;"></i>
                            Certificado
                        </span>
                    @endif
                </div>
            </div>
            
            <!-- Botón de acción - siempre al final -->
            <div style="margin-top: auto;">
                <a href="{{ route('webacademia.single_course', $curso->id) }}" 
                   class="btn-course-view" 
                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                          color: white; 
                          text-decoration: none; 
                          padding: 12px 20px; 
                          border-radius: 25px; 
                          text-align: center; 
                          font-weight: 500; 
                          transition: all 0.3s ease;
                          display: block;
                          width: 100%;">
                    <i class="fa fa-eye" style="margin-right: 8px;"></i>
                    Ver Curso
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.btn-course-view:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-2px);
    text-decoration: none;
    color: white;
}

.course-item {
    transition: all 0.3s ease;
}
</style>
