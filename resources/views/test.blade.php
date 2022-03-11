@extends('home')
@section('test')
<h2 class="text-center mb-2">Danh sách học sinh</h2>
<div>
    <form action="{{ route('filters')}}" method="POST">
        @csrf
        <table id="filter" style="width:60%">
            <tr>
                <td class="pt-2"><label for="khoi">Khối:</label>
                    <select name="khoi" id="">
                        <option value="10">Khối 10</option>
                        <option value="11">Khối 11</option>
                        <option value="12">Khối 12</option>
                    </select>
                </td>
                <td class="pt-2"><label for="namhoc">Năm học:</label>
                    <select name="namhoc" id="">
                        <option value="2022">2022</option>
                        <option value="2023">Khối 11</option>
                        <option value="2024">Khối 12</option>
                    </select>
                </td>
                <td class="pt-2"><label for="lop">Lớp:</label>
                    <select name="lop" id="">
                        <option value="10A1">10A1</option>
                        <option value="10A2">Khối 11</option>
                        <option value="10A3">Khối 12</option>
                    </select>
                </td>
                <td><button type="submit">Xuất danh sách</button></td>
            </tr>
        </table>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover" style="width:100%">
        <thead class="text-center">
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Lớp</th>
            <th>Thao tác</th>
        </thead>
    </table>
</div>
@endsection