@extends('main')

@section('title', '| Forgot my Password')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif 

                    {!! form::open(['url' => 'password/email', 'method' => "POST"]) !!}

                        {{ form::label('email', 'Email:') }}
                        {{ form::email('email', null, ['class' => 'form-control']) }}
                        {{-- the null field is the default value that you want to appear on view --}}

                        {{ form::submit('Reset Password', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

                    {!! form::close() !!}

                </div>

            </div>
        </div>
    </div>
@endsection
