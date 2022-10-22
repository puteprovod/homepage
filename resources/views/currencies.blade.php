@extends('layouts.main')
@section ('content')
@if ($errorMessage)
    <div>
        <p class="text-danger">{{ $errorMessage }}</p>
    </div>
@endif
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Наименование</th>
                <th scope="col">Индекс</th>
                <th scope="col">Курс</th>
                <th scope="col">Обновлено</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
                @if ($currency->title!='RUB')
                <tr{{ ($currency->priority>=5) ? ' class=table-primary' : ''}}>
                    <td>{{ $currency->long_title }}</td>
                    <td>{{ $currency->title }}</td>
                    <td>{{ $currency->exchange_rate }}</td>
                    <td>{{ date ('d/m H:i',strtotime($currency->updated_at)) }}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

