@extends('main')

@section('title', '| Forgot my Password')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">

                    {!! form::open(['url' => 'password/reset', 'method' => "POST"]) !!}

                        {{ form::hidden('token', $token) }}

                        {{ form::label('email', 'Email:') }}
                        {{ form::email('email', $email, ['class' => 'form-control label-spacing-down']) }}

                        {{ form::label('password', 'New Password:') }}
                        {{ form::password('password', ['class' => 'form-control label-spacing-down']) }}

                        {{ form::label('password_confirmation', 'Confirm New Password:') }}
                        {{ form::password('password_confirmation', ['class' => 'form-control']) }}

                        {{ form::submit('Reset Password', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

                    {!! form::close() !!}

                </div>

            </div>
        </div>
    </div>
@endsection
