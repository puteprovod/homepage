@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
    <div class="pt-3">
        <div>
            <h1 class="m-0">Редактирование валют</h1>
        </div>
        <div class="pt-2">
            <a href="{{ route ('admin.currencies.create') }}" class="btn btn-primary">Добавить новую валюту</a>
        </div>
        <div class="pt-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">long_title</th>
                    <th scope="col">exchange_rate</th>
                    <th scope="col">source</th>
                    <th scope="col">priority</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <th scope="row">{{ $currency->id }}</th>
                        <td><a href="{{ route ('admin.currencies.show',$currency->id) }}">{{ $currency->title }}</a></td>
                        <td>{{ $currency->long_title }}</td>
                        <td>{{ $currency->exchange_rate }}</td>
                        <td>{{ $currency->source }}</td>
                        <td>{{ $currency->priority }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
