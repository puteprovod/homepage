@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="pt-3">
                    <div>
                        <div class="pt-3"><b>id:</b> {{ $account->id }}</div>
                        <div class="pt-3"><b>Наименование счета:</b> {{ $account->title }}</div>
                        <div class="pt-3"><b>Тип счета:</b> {{ $account->category->title }}</div>
                        <div class="pt-3"><b>Валюта счета:</b> {{ $account->currency->long_title }}</div>
                        <div class="pt-3"><b>Комментарий:</b> {{ $account->comment }}</div>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route ('admin.accounts.edit',$account->id) }}" class="btn btn-primary">Редактировать</a>
                    </div>
                    <div class="pt-3">
                        <form action="{{ route ('admin.accounts.destroy',$account->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Удалить</button>
                        </form>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route ('admin.accounts.index') }}">Назад</a>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
