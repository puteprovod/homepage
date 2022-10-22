@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="pt-3">
                    <div>
                        <h1 class="m-0">Редактирование валюты</h1>
                    </div>
                    <div class="pt-3">
                        <form action="{{ route ('admin.currencies.update',$currency->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="title" class="form-label">Код валюты</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       placeHolder="title" value="{{ $currency->title }}">
                                <div id="titleHelp" class="pl-3"><i>Три латинских заглавных буквы</i></div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="long_title" class="form-label">Название валюты</label>
                                <input type="text" name="long_title" class="form-control" id="long_title"
                                       value="{{ $currency->long_title }}" placeHolder="long_title">
                                <div id="long_titleHelp" class="form-text">Полное наименование валюты</div>
                                @error('long_title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="image" class="form-label">Приоритет</label>
                                <select class="form-control" aria-label="Выберите приоритет" name="priority">
                                    @for ($i = 0; $i <= 100; $i++)
                                        <option value="{{$i}}"{{ ($i==$currency->priority) ? ' selected' : '' }}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="source" class="form-label">Тип валюты</label>
                                <select class="form-control" aria-label="Source" id="source" name="source">
                                    <option value="cbr"{{ ($currency->source=='cbr') ? ' selected' : '' }}>{{ 'Фиатная валюта' }}</option>
                                    <option value="cmc"{{ ($currency->source=='cmc') ? ' selected' : '' }}>{{ 'Криптовалюта' }}</option>
                                </select>
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
