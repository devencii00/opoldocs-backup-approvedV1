<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotOption extends Model
{
    use HasFactory;

    protected $table = 'chatbot_options';

    protected $primaryKey = 'option_id';

    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'option_text',
        'response_text',
        'next_question_id',
    ];

    public function question()
    {
        return $this->belongsTo(ChatbotQuestion::class, 'question_id', 'question_id');
    }
}
