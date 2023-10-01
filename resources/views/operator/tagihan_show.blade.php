@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">DATA SISWA</h5>

                <div class="card-body">
                    <table>
                        <tr>
                            <td>NISN</td>
                            <td>:{{ $siswa->nisn }}</td>
                        </tr>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
