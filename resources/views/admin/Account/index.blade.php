@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
    <div class="pt-3">
        <div>
            <h1 class="m-0">Редактирование счетов</h1>
        </div>
        <div class="pt-2">
            <a href="{{ route ('admin.accounts.create') }}" class="btn btn-primary">Добавить новый счет</a>
        </div>
        <div class="pt-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">cat</th>
                    <th scope="col">image</th>
                    <th scope="col">title</th>
                    <th scope="col">value</th>
                    <th scope="col">currency</th>
                    <th scope="col">comment</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <th scope="row">{{ $account->id }}</th>
                        <td>
                            @if ($account->image)
                                <img alt="image" class="img-fluid" style="height: 25px;" src="{{ asset("storage/".$account->image) }}">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $account->category->title}}</td>
                        <td><a href="{{ route ('admin.accounts.show',$account->id) }}">{{ $account->title }}</a></td>
                        <td>{{ $account->value }}</td>
                        <td>{{ $account->currency->title }}</td>
                        <td>{{ $account->comment }}</td>
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
