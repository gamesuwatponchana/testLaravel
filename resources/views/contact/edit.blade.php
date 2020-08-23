@extends('layouts.app')

@section('asset_addition')
    <link rel="stylesheet" href="{{asset('css/btn-style.css')}}">
@endsection

@section('content')

    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                         <div class="card-header">Contact แก้ไข</div>

                        <div class="card-body">
                            <a href="/contact" class="btn_link btn_link1">หน้าหลัก</a>
                            <br><br>

                            {!! Form::open([  'action' =>['ContactController@update', $data->id  ],
                                              'method'=>'PUT'
                                           ])        !!}
                                           
                            <div class="col-md-6">
                                <div class="form__group field">
                                    {!! Form::text('name', $data->name, ['class'=>'form__field','placeholder'=>'กรอกชื่อ','id'=>'name']) !!}
                                    {!! Form::label('name','Name', ['class'=>'form__label']) !!}
                                </div>
                                    @if ($errors->has('name'))
                                        <div class="btn btn-danger">

                                            @foreach ($errors->get('name') as $message)
                                                {{$message}}
                                            @endforeach

                                        </div>
                                    @else

                                    @endif

                                <div class="form__group field">
                                    {!! Form::text('email', $data->email, ['class'=>'form__field','placeholder'=>'กรอกอีเมล','id'=>'email']) !!}
                                    {!! Form::label('email','E-Mail Address', ['class'=>'form__label']) !!}
                                </div>
                                    @if ($errors->has('email'))
                                        <div class="btn btn-danger">

                                            @foreach ($errors->get('email') as $message)
                                                {{$message}}
                                            @endforeach

                                        </div>
                                    @else

                                    @endif

                                <div class="form__group field">
                                    {!! Form::text('phone', $data->phone, ['class'=>'form__field','placeholder'=>'กรอกเบอร์โทรศัพท์','id'=>'phone']) !!}
                                    {!! Form::label('phone','Phone', ['class'=>'form__label']) !!}
                                </div>
                                    @if ($errors->has('phone'))
                                        <div class="btn btn-danger">

                                            @foreach ($errors->get('phone') as $message)
                                                {{$message}}
                                            @endforeach

                                        </div>
                                    @else

                                    @endif
                                <br>
                                <br>
                                <input type="submit" value="แก้ไข" class="button1">
                                <br>
                                <br>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
    </div>





    {{-- @dd($errors->has('name')) --}}


@endsection

