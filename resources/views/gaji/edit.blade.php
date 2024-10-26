@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Gaji</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('gaji.update', $gaji->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="karyawan">Nama Karyawan</label>
                            <select name="karyawan_id" class="form-control">
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}"
                                        {{ $gaji->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama_karyawan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ $gaji->tanggal }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="hadir">Jumlah Hadir</label>
                            <input type="number" class="form-control" name="hadir" value="{{ $gaji->hadir }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="pinjaman">Pinjaman</label>
                            <input type="number" class="form-control" name="pinjaman" value="{{ $gaji->pinjaman }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="bpjs">BPJS</label>
                            <input type="number" class="form-control" name="bpjs" value="{{ $gaji->bpjs }}">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                        <a type="button" href="{{ route('gaji.index') }}"
                            class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
