@extends('layouts.headeradmin')


@section('content')
<br>
<div class="container mt-5">
    <h4 class="text-center">MONITORING</h4>
  <!-- Filter Tahun dan Jurusan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="jurusan">
                <option selected>Jurusan</option>
                <!-- Tambahkan opsi jurusan -->
            </select>
        </div>
    </div>

    
    <br>
    <br>
    <br>
    <br>
@include('layouts.footer')
@endsection