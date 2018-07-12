@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center justify-content-center">
        <h4>Ссылка - {{\App\Helpers\UrlHelper::getFullShortUrl($url['short'])}}</h4>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Статистика браузеров</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Браузер</th>
                            <th scope="col">Переходы</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($url['stats']['browsers'] as $browser=>$count)
                            <tr>
                                <td>{{ $browser }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @empty
                            <h3>Не было переходов</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">Статистика устройств</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Устройство</th>
                            <th scope="col">Переходы</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($url['stats']['device'] as $device=>$count)
                            <tr>
                                <td>{{ $device }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @empty
                            <h3>Не было переходов</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">Статистика ОС</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ОС</th>
                            <th scope="col">Переходы</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($url['stats']['platform'] as $platform=>$count)
                            <tr>
                                <td>{{ $platform }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @empty
                            <h3>Не было переходов</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">Статистика стран</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Страна</th>
                            <th scope="col">Переходы</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($url['stats']['location'] as $location=>$count)
                            <tr>
                                <td>{{ $location ?: '-'  }}</td>
                                <td>{{ $count }}</td>
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
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">История ссылки</div>

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
                    @forelse($url['infos'] as $info)
                        <tr>
                            <td>{{ $info['browser'] }}</td>
                            <td>{{ $info['device'] }}</td>
                            <td>{{ $info['platform'] }}</td>
                            <td>{{ $info['ip'] }}</td>
                            <td>{{ $info['location'] ?: '-' }}</td>
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
