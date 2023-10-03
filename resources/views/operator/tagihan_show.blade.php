@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">DATA SISWA</h5>

                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td rowspan="8" width="100"><img src="{{ \Storage::url($siswa->foto) }}" alt="{{ $siswa->nama }}" height="150"></td>
                        </tr>
                        <tr>
                            <td width="50">NISN</td>
                            <td>: {{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td width="50">NAMA</td>
                            <td>: {{ $siswa->nama }}</td>
                        </tr>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
