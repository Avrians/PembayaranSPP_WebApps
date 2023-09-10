@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <td width="15%">ID</td>
                                    <td>: {{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA</td>
                                    <td>: {{ $model->name }}</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>: {{ $model->email }}</td>
                                </tr>
                                <tr>
                                    <td>NO HP</td>
                                    <td>: {{ $model->nohp }}</td>
                                </tr>
                                <tr>
                                    <td>TGL BUAT</td>
                                    <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>TGL UBAH</td>
                                    <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </thead>
                        </table>
                        <h5 class="my-3">Tambah Data Murid</h5>
                        {!! Form::open() !!}
                        <div class="form-group">
                            <label for="siswa_id">Pilih Data Siswa</label>
                            {!! Form::select('siswa_id', $siswa, null, ['class' => 'form-control select2']) !!}
                            <span class="text-danger">{{ $errors->first('siswa_id') }}</span>
                        </div>
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary my-2']) !!}
                        {!! Form::close() !!}

                        <h5 class="my-3">Data Murid</h5>
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model->siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
