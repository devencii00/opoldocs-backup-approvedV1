<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotQuestion extends Model
{
    use HasFactory;

    protected $table = 'chatbot_questions';

    protected $primaryKey = 'question_id';

    public $timestamps = false;

    protected $fillable = [
        'question_text',
    ];

    public function options()
    {
        return $this->hasMany(ChatbotOption::class, 'question_id', 'question_id');
    }
}
