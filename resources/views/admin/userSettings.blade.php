@extends('adminlte::page')

@section('title', 'Configurações do usuário')

@section('content_header')
<h1>Configurações do usuário</h1>
@stop

@section('content')
<div class="register-box">
    <div class="register-box-body">
        <p class="login-box-msg">Alterar Login/Senha</p>
        <form action="{{ route('UserSettings.edit') }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ isset($errors->username) ? 'has-error' : '' }}">
                <input type="text" name="username" class="form-control" value="{{ old('username', isset($user->username) ? $user->username : '') }}" placeholder="Usuário">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @isset($errors->username)
                <span class="help-block">
                    <strong>{{ $errors->username }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ isset($errors->password) ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @isset($errors->password)
                <span class="help-block">
                    <strong>{{ $errors->password }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ isset($errors->password_confirmation) ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @isset($errors->password_confirmation)
                <span class="help-block">
                    <strong>{{ $errors->password_confirmation }}</strong>
                </span>
                @endif
            </div>
            @if ($success)
            <div class="form-group has-feedback has-error text-center">
                <div class="help-block" style="color:green;"><strong>Usuário/Senha alterado com sucesso</strong></div>
            </div>
            @endif
            <button type="submit" class="btn btn-primary btn-block btn-flat">Alterar</button>
        </form>
    </div>
    <!-- /.form-box -->
</div><!-- /.register-box -->
@stop

@section('adminlte_js')
@yield('js')
@stop