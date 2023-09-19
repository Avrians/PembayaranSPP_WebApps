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
                    {{-- <div class="form-group mt-1">
                        <label for="biaya_id">Biaya Yang Ditagihkan </label>
                        {!! Form::select('biaya_id', $biaya, null, ['class' => 'form-control', 'multiple' => true]) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('biaya_id') }}</strong>
                        </span>
                    </div> --}}
                    <label>Tagihan Untuk </label>
                    @foreach ($biaya as $item)
                        <div class="form-check mt-3">
                            {!! Form::checkbox('biaya_id[]', $item->id, null, [
                                'class' => 'form-check-input',
                                'id' => 'defaultCheck'.$loop->iteration,
                            ]) !!}
                            <label for="defaultCheck{{ $loop->iteration }}" class="form-check-label">
                                {{ $item->nama_biaya_full }}
                            </label>
                        </div>
                    @endforeach

                    <div class="form-group mt-3">
                        <label for="angkatan">Tagihan Untuk Angkatan</label>
                        {!! Form::select('angkatan', $angkatan, null, ['class' => 'form-control', 'placeholder' => 'Pilih Angaktan']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('angkatan') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="kelas">Tagihan Untuk Kelas</label>
                        {!! Form::select('kelas', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih Kelas']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('kelas') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('tanggal_tagihan') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('tanggal_jatuh_tempo') }}</strong>
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">
                            <strong>{{ $errors->first('keterangan') }}</strong>
                        </span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
