@extends('home')
@section('phanlop')
<h2 class="text-center mb-2">Phân lớp</h2>
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
<form action="{{route('storeLop',['id'=>$gv_id])}}" method="POST">
@csrf
Năm học: <input class="mb-2" type="number" name="namhoc1" style="width:8%" min="2019" value="2022" required> - <input min="2019" style="width:8%" class="mb-2" type="number" name="namhoc2" value="2023" required>
    <table class="table table-bordered table-hover" style="width:100%">
        <tr style="text-align: center">
            <td style="width:10%; vertical-align: middle"><b>Lớp:</b></td>
            <td style="vertical-align: middle">
                
                @if(isset($lop10) && count($lop10)!=0)
                    @foreach ($lop10 as $value)
                    <?php $x=''?>
                        @foreach ($damnhiem as $valueDamNhiem )
                            @if ($value->id == $valueDamNhiem->lop_id)
                                <?php $x='checked' ?>
                            @endif
                        @endforeach
                        <input type="checkbox" name="lop[]" value="{{$value->id}}" {{$x}}>{{$value->TenLop}}<br>
                    @endforeach
                @else
                    <span>Chưa có</span>
                @endif
            </td>
            <td style="vertical-align: middle">
                @if(isset($lop11) && count($lop11)!=0)
                    @foreach ($lop11 as $value)
                    <?php $x=''?>
                        @foreach ($damnhiem as $valueDamNhiem )
                            @if ($value->id == $valueDamNhiem->lop_id)
                                <?php $x='checked' ?>
                            @endif
                        @endforeach
                        <input type="checkbox" name="lop[]" value="{{$value->id}}" {{$x}}>{{$value->TenLop}}<br>
                    @endforeach
                @else
                    <span>Chưa có</span>
                @endif
            </td>
            <td style="vertical-align: middle">
                @if(isset($lop12) && count($lop12)!=0)
                    @foreach ($lop12 as $value)
                    <?php $x=''?>
                        @foreach ($damnhiem as $valueDamNhiem )
                            @if ($value->id == $valueDamNhiem->lop_id)
                                <?php $x='checked' ?>
                            @endif
                        @endforeach
                        <input type="checkbox" name="lop[]" value="{{$value->id}}" {{$x}}>{{$value->TenLop}}<br>
                    @endforeach
                @else
                    <span>Chưa có</span>
                @endif
            </td>
            <td>
                <button class="btn btn-primary">Phân công</button>
            </td>
        </tr>
    </table>
</form>
@endsection