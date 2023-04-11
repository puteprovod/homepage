<?php

namespace App\Http\Resources\Account;

use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AccountResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
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
            ($currency->title=='BTC' || $currency->title=='ETH') ? $value = rand (0, 5)/10 : $value = rand (0, 10000);
            if ($this->category_id==24) $value=-$value;
                if ($currency->source == 'cbr' or $currency->source == 'rub') {
                    $cost = ceil($value * $currency->exchange_rate);
                } else {
                    $usd = Currency::find(11)->exchange_rate;
                    $cost = ceil($value * $currency->exchange_rate * $usd);
                }
            ($this->category_id==26) ? $title = 'Наличные1' : $title = $this->title;
                    return [
                        'id' => $this->id,
                        'title' => mb_substr($title, 0, 17, 'UTF-8'),
                        'value' => $value,
                        'cost' => $cost,
                        'category_title' => Category::find($this->category_id)->title,
                        'currency_title' => Currency::find($this->currency_id)->title,
                        'category_id' => $this->category_id,
                        'image' => $this->image,
                        'comment' => '',
                    ];

        }
    }
}
