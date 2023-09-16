@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}
                    <div class="form-group mt-1">
                        <label for="angkatan">Tagihan Untuk Angkatan</label>
                        {!! Form::select('angkatan', $angkatan, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('angkatan') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="kelas">Tagihan Untuk Kelas</label>
                        {!! Form::select('kelas', $kelas, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('kelas') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah / Nominal</label>
                        {!! Form::text('jumlah', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('jumlah') }}</strong>
                        </span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
