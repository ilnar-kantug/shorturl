@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создание короткой ссылки</div>

                <div class="card-body">
                    <form action="{{route('store-url')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="short-url">Введите адрес</label>
                            <input type="text" required class="form-control" name="short-url" id="short-url" value="{{config('app.url')}}">
                        </div>
                        <div class="form-group">
                            <label for="till">
                                Продолжительность, мин
                                <div class="small">Чтобы сделать вечную ссылку, оставьте поле пустым</div>
                            </label>
                            <input type="number" min="1" step="1" name="till" id="till" class="form-control">
                        </div>
                        <button type="submit">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
