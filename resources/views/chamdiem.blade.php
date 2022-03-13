@extends('home')

@section('chamdiem')

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
            <tr style="text-align: center">
                <th>HKI</th>
                <th>HKII</th>
                <th>Cả năm</th>
            </tr>
        </thead>
        <tbody>
        <?php $err=''?>
        @if (isset($chunhiem) && isset($monHocs) && $chunhiem['data']['lop_id']['TenLop'] == $lop)
            @foreach ($monHocs as $monhoc)
            <form action="{{route('chamdiemact',['hocsinh_id'=>$id,'monhoc_id'=>$monhoc->id])}}" method="POST">
                @csrf
            <tr style="text-align: center">
                <td>{{$monhoc->tenmonhoc}}</td>
                <td><input value="0" type="number" name="HKI" min="0" max="10"></td>
                <td><input value="0" type="number" name="HKII" min="0" max="10"></td>
                <td><input value="0" type="number" name="CaNam" min="0" max="10"></td>
                <td><input value="0" type="number" name="ThiLai" min="0" max="10"></td>
                <td class="text-center">
                    @if ((count($damnhiem)!=0 || isset($damnhiem)) && isset($gv_bomon))
                    @foreach ($damnhiem['data'] as $valueDamnhiem)
                        @foreach ($listGVBoMon['data'] as $valueGv_bomon)
                            @if ($valueGv_bomon['gv_id']== $valueDamnhiem['gv_id']['id'] && $valueDamnhiem['lop_id']['TenLop']== $lop)
                                {{$valueDamnhiem['gv_id']['name']}}
                            @endif
                        @endforeach
                    @endforeach
                 @else
                     <?php $err='Oops! đã xảy ra lỗi đâu đó!'?>
                @endif
                 </td>
            </tr>
        </form>
            @endforeach
        @else
            @if(isset($gv_bomon))
            <form action="{{route('chamdiemact',['hocsinh_id'=>$id,'monhoc_id'=>$gv_bomon['data'][0]['monhoc_id']['id']])}}" method="POST">
                @csrf
            <tr style="text-align: center">
                <td>{{$gv_bomon['data'][0]['monhoc_id']['tenmonhoc']}}</td>
                <td><input value="0" type="number" name="HKI" min="0" max="10"></td>
                <td><input value="0" type="number" name="HKII" min="0" max="10"></td>
                <td><input value="0" type="number" name="CaNam" min="0" max="10"></td>
                <td><input value="0" type="number" name="ThiLai" min="0" max="10"></td>
            <td><button class="btn btn-primary" type="submit">Xác nhận</button>
            </td>
        </form>
            </tr>
            @endif
        @endif
           
        </tbody>
    </table>
</div>
@if ($err!='')
<div class="alert alert-danger mt-3">
    {{$error}} <br>
</div>
@endif
@endsection