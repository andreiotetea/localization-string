<?php

namespace App\Services;

use App\Repositories\TranslationRepositoryInterface;
use Exception;


class TranslationService
{
    private TranslationRepositoryInterface $translationRepository;

    public function __construct(TranslationRepositoryInterface $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function get(): array
    {
        return $this->translationRepository->get()->toArray();
    }

    public function delete($translation_id)
    {
        $this->translationRepository->delete($translation_id);
    }

    /**
     * @throws Exception
     */
    public function save(array $data): array
    {
        try {
            return $this->translationRepository->save($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
