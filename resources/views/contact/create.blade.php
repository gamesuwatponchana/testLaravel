@extends('layouts.app')

@section('asset_addition')
    <link rel="stylesheet" href="{{asset('css/btn-style.css')}}">
@endsection

@section('content')

    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Contact</div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                         @endif
                        <div class="card-body">
                            <a href="/contact">หน้าหลัก</a>
                            <br><br>

                            {!! Form::open(['action' => 'ContactController@store','method'=>'POST']) !!}
                            <div class="col-md-6">
                                <div class="form__group field">
                                    {!! Form::text('name', null, ['class'=>'form__field','placeholder'=>'กรอกชื่อ','id'=>'name']) !!}
                                    {!! Form::label('name','Name', ['class'=>'form__label']) !!}
                                </div>

                                <div class="form__group field">
                                    {!! Form::text('email', null, ['class'=>'form__field','placeholder'=>'กรอกอีเมล','id'=>'email']) !!}
                                    {!! Form::label('email','E-Mail Address', ['class'=>'form__label']) !!}
                                </div>

                                <div class="form__group field">
                                    {!! Form::text('phone', null, ['class'=>'form__field','placeholder'=>'กรอกเบอร์โทรศัพท์','id'=>'phone']) !!}
                                    {!! Form::label('phone','Phone', ['class'=>'form__label']) !!}
                                </div>

                                <input type="submit" value="บันทึก" class="button1">
                                <br>
                                <br>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
    </div>






@endsection
