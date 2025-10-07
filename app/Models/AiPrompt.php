<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiPrompt extends Model
{
    protected $table = 'ai_prompts';
    
    protected $fillable = [
        'category',
        'name',
        'prompt',
        'is_active',
        'priority',
        'variables'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'variables' => 'array'
    ];

    /**
     * Obtener prompts activos por categoría
     */
    public static function getActiveByCategory($category)
    {
        return self::where('category', $category)
                   ->where('is_active', true)
                   ->orderBy('priority', 'desc')
                   ->get();
    }

    /**
     * Obtener todos los prompts activos
     */
    public static function getAllActive()
    {
        return self::where('is_active', true)
                   ->orderBy('category')
                   ->orderBy('priority', 'desc')
                   ->get();
    }

    /**
     * Procesar variables en el prompt
     */
    public function processPrompt($variables = [])
    {
        $processedPrompt = $this->prompt;
        
        foreach ($variables as $key => $value) {
            $processedPrompt = str_replace("{{$key}}", $value, $processedPrompt);
        }
        
        return $processedPrompt;
    }
}
