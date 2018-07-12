@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Мои ссылки</div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Короткая</th>
                        <th scope="col">Длинная</th>
                        <th scope="col">Срок жизни</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($urls as $url)
                        <tr>
                            <td>{{ $url->short }}</td>
                            <td>{{ $url->long }}</td>
                            <td>{{ $url->till }}</td>
                            <td><a href="{{route('url-show', ['id' => $url->id])}}">Статистика</a></td>
                        </tr>
                    @empty
                        <h3>У вас нет короткий ссылок</h3>
                    @endforelse
                    </tbody>
                </table>
                {{ $urls->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
