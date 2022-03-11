@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex flex-column col-md-2">
            @if(Auth::user()->role==1)
                    <a type="button" href="{{ route('index') }}" class="p-2 btn btn-light">DS Học Sinh</a>
                    <a type="button" href="{{ route('filterGV') }}" class="p-2 btn btn-light">DS Giáo viên</a>
                    <a type="button" href="{{ route('showImport') }}" class="p-2 btn btn-light">Nhập DS</a>
            @else
            {{--  {{dd($chunhiem);}}  --}}
                @if(isset($chunhiem))
                    <a type="button" href="{{ route('filters',['lop'=>$chunhiem['data']['lop_id']['TenLop'],'namhoc'=>$chunhiem['data']['namhoc'],]) }}" class="p-2 btn btn-light">{{$chunhiem['data']["lop_id"]["TenLop"]?? "null"}}</a>
                @endif
                @if (isset($damnhiems) && count($damnhiems)!=0)
                    @foreach ($damnhiems['data'] as $value )
                    <a type="button" href="{{ route('filters',['lop'=>$value['lop_id']['TenLop'],'namhoc'=>$value['namhoc'],]) }}" class="p-2 btn btn-light">{{$value["lop_id"]["TenLop"]?? "null"}}</a>
                    @endforeach
                @endif
            @endif
        
        </div>
        <div class="col-md-10">
                @yield('import')
                @yield('danhsachhocsinh')
                @yield('test')
                @yield('diemhocsinh')
                @yield('filters')
                @yield('filtersGV')
                @yield('phanlop')
                @yield('welcomeGV')
                @yield('chamdiem')
            </div>
    </div>
</div>
@endsection
