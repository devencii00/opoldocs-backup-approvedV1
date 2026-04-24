<?php

namespace App\Http\Controllers;

use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;

class ChatbotController extends Controller
{
    public function questions()
    {
        return ChatbotQuestion::with('options')->get();
    }

    public function question(ChatbotQuestion $chatbotQuestion)
    {
        return $chatbotQuestion->load('options');
    }

    public function option(ChatbotOption $chatbotOption)
    {
        return $chatbotOption;
    }
}
