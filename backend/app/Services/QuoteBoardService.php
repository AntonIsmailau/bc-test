<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class QuoteBoardService
{
    public function index(): array
    {
        return $this->getDummyData();
    }

    public function save(string $symbol): array
    {
        $orignalData = $this->getDummyData();

        $newEntry = [
            'symbol' => $symbol,
            'last' => round(random_int(1, 1000) / 0.42, 2),
            'change' => round(random_int(-1, 100) / 0.42, 2),
            'open' => round(random_int(1, 1000) / 0.42, 2),
            'volume' => round(random_int(-1000, 1000), 2),
        ];
        $orignalData[] = $newEntry;
        Storage::put('dummy_data.json', json_encode($orignalData));

        return $newEntry;
    }

    public function getRandomizedDummyData(): array
    {
        $originalData = $this->getDummyData();
        $originalDataLen = count($originalData);
        $howManyToChange = random_int(1, $originalDataLen);
        while ($howManyToChange > 0) {
            $howManyToChange--;
            $key = random_int(0, $originalDataLen-1);

            $originalData[$key]->last = round(random_int(1, 1000) / 0.42, 2);
            $originalData[$key]->change = round(random_int(1, 100) / 0.42, 2);
            $originalData[$key]->volume = round(random_int(-1000, 100) / 0.42, 2);
        }


        Storage::put('dummy_data.json', json_encode($originalData));

        return $originalData;
    }

    private function getDummyData(): array
    {
        return json_decode(Storage::get('dummy_data.json'));
    }
}
