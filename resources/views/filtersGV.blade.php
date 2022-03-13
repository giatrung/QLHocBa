@extends('home')
@section('filtersGV')
<h2 class="text-center mb-4">Danh sách giáo viên</h2>
<div>
    <form class="mb-3" action="{{ route('search')}}" method="POST">
        @csrf
       <label for="bomon">Bộ môn:</label>
       <select class="form-control d-inline text-center" style="width:25%" name="bomon" id="">
           @if(!empty($bomon))
                <option value="0">Tất cả</option>
               @foreach ($bomon as $value)
                <option value="{{$value->id}}">{{$value->tenmonhoc}}</option>
               @endforeach
           @endif
       </select>
       <label for="">Tên:</label>
       <input class="form-control d-inline" type="search" name="ten" style="width:25%">
       <button class="btn btn-primary mb-2">Tìm</button>
    </form>
    @if (session('status'))
        <div class="alert alert-success mt-3" role="alert">
            {{session('status')}}
        </div>
    @endif
    <table class="table table-bordered table-hover" style="width:100%">
        <thead class="text-center">
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Bộ môn</th>
            <th>Lớp chủ nhiệm</th>
            <th> # </th>
        </thead>
       <tbody>
           @if (!empty($giaovien))
                <?php $i=1?>
                @foreach ($giaovien as $value)
                <form action="{{route('update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="gv_id" value="{{$value->id}}" hidden>
                    <tr>
                        <td>{{$i}}
                        </td>
                        <td><a href="{{route('phanlop',['id'=>$value->id])}}">{{$value->name}}</a></td>
                        <td>{{$value->email}}</td>
                        <td>
                            @if (isset($giaovienbomon)||$giaovienbomon!=[] || !$giaovienbomon)
                                @foreach ($giaovienbomon['data'] as $valuegiaovienbomon )
                                    @if ($valuegiaovienbomon['gv_id']['id'] == $value->id)
                                        {{$valuegiaovienbomon['monhoc_id']['tenmonhoc']??''}}
                                    @endif
                                @endforeach
                            @endif
                            
                        </td>
                        <td>
                            <select class="lop" name="lop" style="width:90px">
                                @if (!$chunhiem || $chunhiem['data']!=[])
                                    <optgroup label="Chủ nhiệm"> 
                                        @foreach ($chunhiem['data'] as $valueChuNhiem)
                                            @if($value->id==$valueChuNhiem['gv_id'] && isset($valueChuNhiem['lop_id']['id']))
                                            <option value="{{$valueChuNhiem['lop_id']['id']}}" selected>{{$valueChuNhiem['lop_id']['TenLop']}}</option>
                                            @endif
                                        @endforeach
                                        <option value="0">Không có</option>
                                    </optgroup>
                                @endif
                                @if (!$lop || $lop!=[])
                                <optgroup label="Lớp">
                                    @foreach ($lop as $valueLop)
                                        <option value="{{$valueLop->id}}">{{$valueLop->TenLop}}</option>
                                    @endforeach
                                </optgroup> 
                                @endif
                            </select>
                        </td>
                        <td> 
                            <button id="change" type="submit" class="btn btn-primary" type="button">Lưu thay đổi</button>
                            <a class="btn btn-danger" href="{{route('delete',['id'=>$value->id])}}" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                        </td>
                    </tr>
                <?php $i++?>
                </form>
                @endforeach
           @endif
           <tr></tr>
       </tbody>
    </table>
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error )
                {{$error}} <br>
            @endforeach
        </div>
    @endif
</div>
@endsection