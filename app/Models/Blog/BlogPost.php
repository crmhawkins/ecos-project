<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'published',
        'published_at',
        'author_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'views_count',
        'reading_time'
    ];

    protected $casts = [
        'tags' => 'array',
        'meta_keywords' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'reading_time' => 'integer'
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at'
    ];

    // Relaciones
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    // Accessors
    public function getExcerptAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->content), 150);
    }

    public function getReadingTimeAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        // Calcular tiempo de lectura basado en el contenido (250 palabras por minuto)
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 250));
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M, Y') : null;
    }

    public function getUrlAttribute()
    {
        return route('webacademia.blog.show', $this->slug);
    }

    // Métodos auxiliares
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function isPublished()
    {
        return $this->published && $this->published_at && $this->published_at <= now();
    }

    // Categorías disponibles
    public static function getCategories()
    {
        return [
            'formacion' => 'Formación Profesional',
            'tecnologia' => 'Tecnología',
            'educacion' => 'Educación Online',
            'certificaciones' => 'Certificaciones',
            'innovacion' => 'Innovación',
            'empresa' => 'Empresa',
            'noticias' => 'Noticias Generales'
        ];
    }

    // Tags sugeridos
    public static function getSuggestedTags()
    {
        return [
            'formación online',
            'certificación profesional',
            'e-learning',
            'desarrollo profesional',
            'tecnología educativa',
            'moodle',
            'cursos online',
            'educación digital',
            'competencias digitales',
            'transformación digital'
        ];
    }
}