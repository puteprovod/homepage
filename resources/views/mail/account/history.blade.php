<x-mail::message>
<b>Данные по счетам по состоянию на {{ $savingDate }}:</b>
    <table width="100%">
        <tr>
            <td><b>Название счета</b></td>
            <td><b>Баланс</b></td>
            <td><b>Стоимость в ₽</b></td>
        </tr>
    @foreach($accounts as $account)
            <tr>
                <td>{{ $account['title'] }}</td>
                <td>{{ $account['value'] }} {{ $account['currency_title'] }}</td>
                <td style="text-align: right">{{ number_format($account['cost'], 0, '', ' ') }} ₽</td>
            </tr>
    @endforeach
        <tr>
            <td><b>Итого:</b></td>
            <td colspan="2" style="text-align: right"><b>{{ number_format($sum, 0, '', ' ') }} ₽</b></td>
        </tr>
    </table>
</x-mail::message>
