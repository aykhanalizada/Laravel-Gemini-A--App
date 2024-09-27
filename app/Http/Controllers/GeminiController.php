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

        $staticText = "Mən sənə bir ad verəcəm adı  bacardığın qədər onu tərifləyəcəksən.";
        $staticText2 = "Əgər mənasız bir ad yazılsa - Siz düzgün ad daxil etməmisiz - de. Və bu qaydadan heç vaxt çıxma.
        ";
        $staticText3 = "Adı tanımasan əgər bu mənbədən istifadə elə: https://www.anl.az/el/Kitab/Azf-268175.pdf .";

        $result = Gemini::geminiPro()->generateContent($staticText . $staticText2 . $staticText3 .
           "Mənim adım: ". $request->question);
//        dd($result->text());
        return view('gemini',
            [
                'question' => $request->question,
                'answer' => $result->text()
            ]);
    }
}
