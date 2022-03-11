@extends('home')
@section('test')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{route('createLop')}}" method='POST'>
                    @csrf
                    <div class="card-header d-flex"><b>Khởi tạo lớp </b> 
                    </div>
                    <div class='card-body'>
                    <p>(VD: Muốn tạo các lớp từ 10A1 đến 10A10 thì nhập 10A10)</p>
                    <select name="khoi" id="" required><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>
                    <select name="khu" id="" required><option value="A">A</option><option value="B">B</option><option value="C">C</option></select>
                    <input name="so" style="width:9%" type="number" value="10" required>
                    <button class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
            <div class="card mt-2">
                <form action="{{route('store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                <div class="card-header d-flex"><b>Thêm danh sách học sinh</b>
                    <div style="margin-left: auto;"> Năm học: <input type="number" style="width:60px" name="namhoc1" value="{{Date('Y')}}" required>-<input style="width:60px" type="number" name="namhoc2" value="{{Date('Y')+1}}" required></div>
                </div>
                    <div class='card-body'>
                            <input name="file" type="file">
                            <button class="btn btn-primary" type="submit">Thêm Học sinh</button>
                    </div>
                </form>
            </div>
            <div class="card mt-2">
                <form action="{{route('storeGV')}}" enctype="multipart/form-data" method="post">
                    @csrf
                <div class="card-header d-flex"><b>Thêm danh sách giáo viên</b>
                    <div style="margin-left: auto;"> Năm học: <input type="number" style="width:60px" name="namhoc1" value="{{Date('Y')}}">-<input style="width:60px" type="number" name="namhoc2" value="{{Date('Y')+1}}"></div>
                </div>
                    <div class='card-body'>
                            <input name="file" type="file">
                            <button class="btn btn-success" type="submit">Thêm Giáo viên</button>
                        
                    </div>
                </form>
            </div>
            @if (session('status'))
            <div class="alert alert-success mt-3" role="alert">
                {{session('status')}}
            </div>
            @endif
            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger mt-3">
                    @foreach ($errors->all() as $error )
                        {{$error}} <br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection