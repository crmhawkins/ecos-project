<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiConversation extends Model
{
    protected $table = 'ai_conversations';
    
    protected $fillable = [
        'session_id',
        'user_message',
        'assistant_response',
        'page_url',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    /**
     * Obtener conversaciones por sesión
     */
    public static function getBySession($sessionId, $limit = 10)
    {
        return self::where('session_id', $sessionId)
                   ->orderBy('created_at', 'desc')
                   ->limit($limit)
                   ->get()
                   ->reverse()
                   ->values();
    }

    /**
     * Obtener conversaciones recientes
     */
    public static function getRecent($limit = 10)
    {
        return self::orderBy('created_at', 'desc')
                   ->limit($limit)
                   ->get();
    }
}
