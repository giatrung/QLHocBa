@extends('home')

@section('diemhocsinh')
<a href="{{route('filters',['lop'=>$lop,'namhoc'=>$namhoc])}}">Trở về trang DS Học sinh</a>
<div>
    <h2 class="text-center">Bảng điểm</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th style="vertical-align: middle" rowspan="2" >Môn học</th>
                <th style="vertical-align: middle" colspan="3">Điểm trung bình môn học</th>
                <th style="vertical-align: middle" rowspan="2">Điểm KT lại (nếu có)</th>
                <th style="vertical-align: middle" rowspan="2">Xác nhận giáo viên bộ môn</th>
            </tr>
            <tr>
                <th>HKI</th>
                <th>HKII</th>
                <th>Cả năm</th>
            </tr>
        </thead>
        <tbody>
            {{--  {{dd($damnhiem)}}  --}}
            @if (!empty($diem) && $diem!=null)
                @foreach ( $diem['data'] as $value)
               <tr>
                   <td class="text-center">{{$value['monhoc_id']['tenmonhoc']??''}}</td>
                   <td class="text-center">{{$value['HKI']??''}}</td>
                   <td class="text-center">{{$value['HKII']??''}}</td>
                   <td class="text-center">{{$value['ThiLai']??''}}</td>
                   <td class="text-center">{{$value['CaNam']??''}}</td>
                   <td class="text-center">
                   @if ($damnhiem!=[] || !$damnhiem)
                       @foreach ($damnhiem['data'] as $valueDamnhiem)
                           @if ($valueDamnhiem['monhoc_id']== $value['monhoc_id'] && $valueDamnhiem['lop_id']['TenLop']== $lop)
                               {{$valueDamnhiem['gv_id']['name']}}
                           @endif
                       @endforeach
                   @endif
                </td>
               </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection