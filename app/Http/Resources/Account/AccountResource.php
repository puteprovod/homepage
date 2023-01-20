<?php

namespace App\Http\Resources\Account;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role=Auth::user() ? Auth::user()['role'] : '';
        if ($role=='admin') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'value' => $this->value,
                'cost' => $this->cost,
                'category_title' => $this->category_title,
                'currency_title' => $this->currency_title,
                'category_id' => $this->category_id,
                'image' => $this->image,
                'comment' => $this->comment,
            ];
        }
        else
        {

                $currency = Currency::find($this->currency_id);
            ($currency->title=='BTC' || $currency->title=='ETH') ? $value = rand (0, 10) : $value = rand (0, 50000);
            if ($this->category_id==24) $value=-$value;
            $cost = 0;
                if ($currency->source == 'cbr' or $currency->source == 'rub') {
                    $cost = ceil($value * $currency->exchange_rate);
                } else {
                    $usd = Currency::find(11)->exchange_rate;
                    $cost = ceil($value * $currency->exchange_rate * $usd);
                }

            ($this->category_id==26) ? $title = 'Наличные' : $title = $this->title;

            return [
                'id' => $this->id,
                'title' => mb_substr($title,0,17,'UTF-8'),
                'value' => $value,
                'cost' => $cost,
                'category_title' => $this->category_title,
                'currency_title' => $this->currency_title,
                'category_id' => $this->category_id,
                'image' => $this->image,
                'comment' => '',
            ];
        }
    }
}
