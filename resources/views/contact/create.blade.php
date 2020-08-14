@extends('layouts.app')
@section('content')

    <div class="container">

    {!! Form::open(['url' => 'foo/bar']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('NAME') !!}
                {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'กรอกชื่อ']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('EMAIL') !!}
                {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'กรอกอีเมล']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('PHONE') !!}
                {!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'กรอกเบอร์โทรศัพท์']) !!}
            </div>

        </div>
    {!! Form::close() !!}

    </div>



@endsection
