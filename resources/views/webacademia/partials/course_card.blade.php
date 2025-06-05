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
<div class="col-lg-4 col-sm-6 col-xs-12 course-item mb-4">
    <a href="{{ route('webacademia.single_course', $curso->id) }}" class="d-block text-decoration-none" style="height: 100%;">
        <div class="course-slide" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
            <div class="course-img" style="height: 200px; overflow: hidden; position: relative;">
                <img src="{{ $curso->image }}" alt="{{ $curso->name }}" style="width: 100%; height: 100%; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <div class="course-date" style="position: absolute; top: 10px; right: 10px; color: white; padding: 5px 10px; border-radius: 5px;">
                    <span class="month">${{ number_format($curso->price, 0) }}</span>
                </div>
            </div>
            <div class="course-content p-3" style="flex-grow: 1;">
                <span class="c_btn d-inline-block mb-2" style="color: white;">{{ $curso->category->name ?? 'Sin categoría' }}</span>
                <h3 class="mt-2">{{ $curso->name }}</h3>
                <div class="d-flex align-items-center gap-3 flex-wrap mt-2">
                    @if (isset($curso->inicio))
                        <span><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($curso->inicio)->format('d/m/Y') }}</span>
                    @endif

                    @if (isset($curso->duracion))
                        <span><i class="fa fa-clock-o"></i> {{ $curso->duracion }}</span>
                    @endif

                    @if (isset($curso->plazas))
                        <span><i class="fa fa-table"></i> <strong>{{ $curso->plazas }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach
