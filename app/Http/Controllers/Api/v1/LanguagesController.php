<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\LanguageService;
use Illuminate\Http\Response;

class LanguagesController extends Controller
{
    /** @var LanguageService LanguageService */
    private $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function get(Request $request): JsonResponse
    {
        $languages = $this->languageService->get();
        return response()->json($languages);
    }
}
