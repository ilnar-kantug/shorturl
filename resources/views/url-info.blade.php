@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Статистика ссылки {{\App\Helpers\UrlHelper::getFullShortUrl($url->short)}}</div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Браузер</th>
                        <th scope="col">Устройство</th>
                        <th scope="col">ОС</th>
                        <th scope="col">IP</th>
                        <th scope="col">Страна</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($url->infos as $info)
                        <tr>
                            <td>{{ $info->browser }}</td>
                            <td>{{ $info->device }}</td>
                            <td>{{ $info->platform }}</td>
                            <td>{{ $info->ip }}</td>
                            <td>{{ $info->location ?: '-' }}</td>
                        </tr>
                    @empty
                        <h3>Не было переходов</h3>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
