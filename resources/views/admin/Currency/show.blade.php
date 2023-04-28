@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="pt-3">
                    <div>
                        <div class="pt-3"><b>id:</b> {{ $currency->id }}</div>
                        <div class="pt-3"><b>Код:</b> {{ $currency->title }}</div>
                        <div class="pt-3"><b>Наименование:</b> {{ $currency->long_title }}</div>
                        <div class="pt-3"><b>Тип:</b> {{ ($currency->source == 'сmc') ? 'Криптовалюта' : 'Фиатная валюта' }}</div>
                        <div class="pt-3"><b>Приоритет:</b> {{ $currency->priority }}</div>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route ('admin.currencies.edit',$currency->id) }}" class="btn btn-primary">Редактировать</a>
                    </div>
                    <div class="pt-3">
                        <form action="{{ route ('admin.currencies.destroy',$currency->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Удалить</button>
                        </form>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route ('admin.currencies.index') }}">Назад</a>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
