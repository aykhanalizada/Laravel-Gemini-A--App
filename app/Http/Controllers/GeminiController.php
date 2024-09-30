<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    public function gemini(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:10'
        ]);

        $staticText = "Mən sənə bir ad verəcəm adı bacardığın qədər onu təriflə .";
        $staticText2 = "Əgər mənasız bir ad yazılsa - Siz düzgün ad daxil etməmisiz - de. Və bu qaydadan heç vaxt çıxma.";
//        $staticText3 = "Adın mənasını buradan tap: https://www.anl.az/el/Kitab/Azf-268175.pdf .";

        $result = Gemini::geminiPro()->generateContent($staticText . $staticText2 .
            "Mənim adım: " . $request->question);

        $answer = str_replace('**', '<strong>', $result->text());
        $answer = str_replace('<strong> ', '</strong> ', $answer);
        $answer = str_replace('<strong>' . PHP_EOL, '</strong>' . PHP_EOL, $answer);

        $answer = str_replace('*', '<br>' . '&nbsp;', $answer);


        return view('gemini',
            [
                'question' => $request->question,
                'answer' => $answer
            ]);
    }
}
