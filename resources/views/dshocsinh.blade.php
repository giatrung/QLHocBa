@extends('home')
@section('danhsachhocsinh')
<h2 class="text-center mb-2">Danh sách học sinh</h2>
<div class="table-responsive">
    <table class="table table-bordered table-hover" style="width:100%">
        <thead class="text-center">
            <th>STT</th>
            <th>Họ</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
            <th>Thao tác</th>
        </thead>
        @if (!empty($dshocsinh) && $dshocsinh !=null)
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
                @if (Auth::user()->role==1)
                <a class="btn btn-primary" type="button" href="{{route('show',['lop'=>$lopBefore,'id'=>$hocsinh->id,'namhoc'=>$namhocBefore])}}">Xem</a>
                
                <a class="btn btn-danger" href="{{route('xoa',['id'=>$hocsinh->id,'lop'=>$hocsinh->TenLop,'namhoc'=>$hocsinh->NamHoc])}}" 
                    onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá
                </a>
                @else
                <a class="btn btn-primary" type="button" href="{{route('chamdiem',['lop'=>$lopBefore,'hocsinh'=>$hocsinh->id,'namhoc'=>$namhocBefore])}}">Xem</a>
                @endif
                </td>
            </tr>
            <?php
                $i++;
            ?>
            @endforeach
        </tbody>
        @endif
    </table>
</div>
@endsection