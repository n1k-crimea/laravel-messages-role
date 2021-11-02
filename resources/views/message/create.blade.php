@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Создание обращения') }}</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(isset($timeLastMsg))
                        <div class="alert alert-danger">
                            Ваше последнее сообщение было отравлено {{ $timeLastMsg }} (GMT)
                            <br>
                            Следующее сообщение вы можете отправить после {{ $timeNextMsg }} (GMT)
                        </div>
                    @else
                        <form action="{{route('client_message_store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-row">
                                <div class="col">
                                    <label for="input-name">Тема</label>
                                    <input type="text" class="form-control" id="input-name" name="subject"
                                           placeholder="Введите тему сообщения" required>
                                    <div class="valid-feedback">Поле заполнено правильно.</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="input-address">Текст сообщения</label>
                                    <textarea name="body" class="form-control" id="input-address" rows="3" placeholder="Введите текст сообщения" required></textarea>
                                    <div class="invalid-feedback">Это поле обязательно.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-file">Выберите файл для сообщения</label>
                                <input name="input_file" type="file" class="form-control-file" id="input-file">
                            </div>

                            <button class="btn btn-primary" type="submit">Отправить</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
