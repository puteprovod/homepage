@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="pt-3">
                    <div>
                        <h1 class="m-0">Редактирование истории счетов</h1>
                    </div>
                </div>
                <div class="pt-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Дата и время среза</th>
                            <th scope="col">Баланс</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accountHistories as $accountHistory)
                            <tr>
                                <th scope="row">{{  $accountHistory['id'] }}</th>
                                <td>
                                    {{  $accountHistory['dateTime'] }}
                                </td>
                                <td>{{ $accountHistory['cost'] }} ₽</td>
                                <td>
                                <form action="{{ route ('admin.accounts.history.destroy',$accountHistory['shotDate']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">Удалить</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
