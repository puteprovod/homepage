@extends('layouts.main')
@section ('content')
    <form action="{{ route ('accounts.update') }}" method="post">
        <div class="table-responsive">
            <table class="table">
                @csrf
                @method('patch')
                <thead>
                <tr>
                    <th scope="col">Вид счета</th>
                    <th scope="col"></th>
                    <th scope="col">Название счета</th>
                    <th scope="col" style="text-align: center">Баланс</th>
                    <th scope="col" style="text-align: center">Валюта</th>
                    <th scope="col" style="text-align: center">Комментарий</th>
                    <th scope="col" style="text-align: center">Стоимость в ₽</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr class="align-middle @switch($account->category_id)
                     @case(22){{ 'table-success' }}@break
                     @case(23){{ 'table-success' }}@break
                     @case(24){{ 'table-danger' }}@break
                     @case(25){{ 'table-info' }}@break
                     @case(26){{ 'table-primary' }}@break
                     @case(27){{ 'table-warning' }}@break
                      @endswitch">
                        <td>{{ $account->category_title}}</td>
                        <td>
                            @if ($account->image)
                                    <img alt="image" class="img-fluid" style="height: 30px;" src="{{ asset("storage/".$account->image) }}">
                            @endif
                        </td>
                        <td>{{ $account->title }}</td>
                        <td class="text-end">
                            <input class="form-control form-control-sm" name="value[{{$account->id}}]" placeHolder="value"
                                   style="text-align: right; font-weight: bold;"
                                   type="text" value="{{ $account->value }}">
                        </td>
                        <td><b>{{ $account->currency_title }}</b></td>
                        <td>{{ $account->comment }}</td>
                        <td class="text-end">{{ number_format($account->cost , 0, '.', " ") }} ₽</td>

                    </tr>
                @endforeach
                <tr class="align-middle">
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>&nbsp;&nbsp;
                        @if ($status)
                            <b class="{{ $status=='ok' ? 'text-success' : 'text-danger' }}"> {{ $status=='ok' ? 'Успешно сохранено' : 'Недопустимые символы в полях ввода' }}</b>
                        @endif</td>
                    <td colspan="3" style="text-align: right"><b>Общий баланс счетов:</b></td>
                    <td class="text-end">{{ number_format($sum , 0, '.', " ") }} ₽</td>
                </tr>
                </tbody>

            </table>
        </div>
    </form>
@endsection

