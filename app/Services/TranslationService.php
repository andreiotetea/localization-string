<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 11/3/2022
 * Time: 2:45 PM
 */

namespace App\Services;


use App\Models\Translation;
use App\Repositories\TranslationRepository;


class TranslationService
{
    /** @var $translationRepository TranslationRepository */
    private $translationRepository;

    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function get(): array
    {
        return $this->translationRepository->get()->toArray();
    }

    public function delete($translation_id)
    {
        Translation::query()
            ->where('id', $translation_id)
            ->delete();
    }

    public function save(array $data): array
    {
        try {
            if (isset($data['id'])) {
                Translation::query()
                    ->where('id', $data['id'])
                    ->update([
                        'key_name' => $data['key_name'],
                        'key_value' => $data['key_value'],
                        'language_id' => $data['language_id'],
                    ]);
                $translation = $data;
            } else {
                $translation = new Translation($data);
                $translation->save();
                $translation = $translation->toArray();
            }
            return $translation;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}