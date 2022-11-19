<?php

namespace App\Repositories;

use App\Models\Translation;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TranslationRepository implements TranslationRepositoryInterface
{
    public function get(): Collection
    {
        return Translation::query()->get();
    }

    public function delete(int $translation_id): mixed
    {
        return Translation::query()
            ->where('id', $translation_id)
            ->delete();
    }

    /**
     * @throws Exception
     */
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
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
