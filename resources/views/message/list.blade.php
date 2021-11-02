@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Список обращений') }}</div>
                <div class="card-body">
                    @if($messages)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Тема</th>
                            <th scope="col" width="40%">Сообщение</th>
                            <th scope="col">Имя</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Файл</th>
                            <th scope="col">Отправлено</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{$message->id}}</td>
                            <td>
                                <a href="{{route('manager_message_edit', ['id' => $message->id])}}">
                                    {{$message->viewed ? 'Просмотрено' : 'Новое'}}
                                </a>
                            </td>
                            <td>{{$message->subject}}</td>
                            <td>{{$message->body}}</td>
                            <td>{{$message->user->name}}</td>
                            <td>{{$message->user->email}}</td>
                            <td>
                                @if(isset($message->path_file))
                                    <a href="{{$message->path_file}}">Файл</a>
                                @endif
                            </td>
                            <td>{{$message->created_at->format('H:i d-m-Y')}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
