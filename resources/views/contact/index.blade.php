@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">ข้อมูลติดต่อลูกค้า</div>
                    <div class="card-body">
                        <a href="/contact/create">สร้าง</a>
                        <br><br>

                        <div class="table-responsive-md">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ไอดี</th>
                                        <th>ชื่อ</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทรศัพท์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->phone}}</td>
                                        </tr>
                                    @endforeach

                                </table>
                          </div>
                    </div>
                </div>

            </div>
        </div>
</div>


@endsection
