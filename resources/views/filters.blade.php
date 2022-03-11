@extends('home')
@section('danhsachhocsinh')
<h2 class="text-center mb-2">Chọn lớp</h2>
<div>
    <form action="{{ route('filters')}}" method="GET">
        @csrf
        <table class="table table-bordered table-hover" id="filter" style="width:30%; margin: auto">
            <tr>
                <td><label for="namhoc">Năm học:</label></td>
                <td class="pt-2">
                    <select class="form-control text-center" name="namhoc" id="">
                        @if (isset($namhocs))
                        @foreach ($namhocs as $namhoc)
                            <option value="{{$namhoc->tennamhoc}}">{{$namhoc->tennamhoc}}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="lop">Lớp:</label></td>
                <td class="pt-2">
                    <select class="form-control text-center" name="lop" id="">
                        @if (isset($lops))
                        @foreach ($lops as $lop)
                            <option value="{{$lop->TenLop}}">{{$lop->TenLop}}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
                
            </tr>
            <tr class="text-center">
                <td colspan="2"><button class="btn btn-primary" type="submit">Xuất danh sách</button></td>
            </tr>
        </table>
    </form>
</div>
{{--  <div class="table-responsive">
    <table class="table table-bordered table-hover" style="width:100%">
        <thead class="text-center">
            <th>STT</th>
            <th>Họ</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
            <th>Thao tác</th>
        </thead>
        @if (isset($dshocsinh))
        
        <tbody>
            <?php
                $i=1;
            ?>
            @foreach ( $dshocsinh as $hocsinh)
            <tr class="text-center">
                <td>{{$i}}</td>
                <td>{{$hocsinh->Ho}}</td>
                <td>{{$hocsinh->Ten}}</td>
                <td>{{$hocsinh->TenLop}}</td>
                <td>{{date_format(date_create($hocsinh->NgaySinh),'d-m-Y')}}</td>
                <td>
                <a class="btn btn-primary" type="button" href="{{route('show',['id'=>$hocsinh->id])}}">Xem</a>
                <a class="btn btn-danger" href="{{route('xoa',['id'=>$hocsinh->id,'lop'=>$hocsinh->TenLop,'namhoc'=>$hocsinh->NamHoc])}}" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                </td>
            </tr>
            <?php
                $i++;
            ?>
            @endforeach
        </tbody>
        @endif
    </table>
</div>  --}}
@endsection