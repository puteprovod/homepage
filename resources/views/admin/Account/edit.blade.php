@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="pt-3">
                    <div>
                        <h1 class="m-0">Редактирование счета</h1>
                    </div>
                    <div class="pt-3">
                        <form action="{{ route ('admin.accounts.update',$account->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="mb-3 form-group">
                                <label for="title" class="form-label">Вид счета</label>
                                <select class="form-control" aria-label="Выберите категорию" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"{{ ($category->id==$account->category->id) ? ' selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="title" class="form-label">Название счета</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{ $account->title }}" placeHolder="title">
                                <div id="titleHelp" class="pl-3"><i>Например: Кредитная карта ВТБ 5895</i></div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="title">Валюта счета</label>
                                <select class="form-control" aria-label="Выберите валюту счета" name="currency_id">
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->id}}"{{ ($currency->id==$account->currency->id) ? ' selected' : '' }}>{{ $currency->long_title }}</option>
                                    @endforeach
                                </select>
                                @error('currency_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Комментарий</label>
                                <input type="text" name="comment" class="form-control" id="comment"
                                       value="{{ $account->comment }}" placeHolder="comment">
                                <div id="commentHelp" class="pl-3"><i>Дополнительная информация по счету</i></div>
                                @error('comment')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
