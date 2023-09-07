@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="form-group">
                        <label for="wali_id">Wali Murid</label>
                        {!! Form::select('wali_id', $wali, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('wali_id') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="nama">Nama</label>
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="nisn">NISN</label>
                        {!! Form::text('nisn', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('nisn') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="jurusan">Jurusan</label>
                        {!! Form::select(
                            'jurusan',
                            [
                                'RPL' => 'Rekayasa Perangkat Lunak',
                                'TKJ' => 'Teknik Komputer Jaringan',
                            ],
                            null,
                            ['class' => 'form-control'],
                        ) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('jurusan') }}</strong>
                        </span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kelas">Kelas</label>
                        {!! Form::selectRange('kelas', 1, 6, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('kelas') }}</strong>
                        </span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="angkatan">Angkatan</label>
                        {!! Form::selectRange('angkatan', 2021, date('Y') + 1, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('angkatan') }}</strong>
                        </span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection