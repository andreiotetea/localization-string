<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationsController extends Controller
{
    /** @var $translationService TranslationService */
    private $translationService;

    public function __construct(
        TranslationService $translationService
    )
    {
        $this->translationService = $translationService;
    }

    public function get(): JsonResponse
    {
        $translations = $this->translationService->get();
        return response()->json($translations);
    }

    public function set(Request $request): JsonResponse
    {
        try {
            $translation = $this->translationService->save($request->all());
            return response()->json($translation);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function delete($translation_id): JsonResponse
    {
        try {
            $this->translationService->delete($translation_id);
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }


}
