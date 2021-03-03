<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birthday' => Carbon::parse($this->birthday)->format('d-m-Y'),
            'numbers' => $this->formattedNumbers($this->numbers)
        ];
    }

    /*
     * Обработка списка номеров.
     */
    private function formattedNumbers($numbers)
    { 
        $formated = [];
        if ($numbers) {
            foreach ($numbers as $key => $number) {
                $formated[] = $this->formatingNumber($number);
            }
        }

        return $formated;
    }

    /*
     * Форматирование определённого номера телефона, для списка номеров.
     */
    private function formatingNumber($number)
    {
        return [
            'id' => $number->id,
            'number' => "+38 (0{$number->operator->code}) {$number->number}",
            'operator' => $number->operator->name,
            'balance' => $number->balance
        ];
    }
}
