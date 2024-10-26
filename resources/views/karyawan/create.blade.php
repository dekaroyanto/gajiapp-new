@extends('layouts.template')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Karyawan</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-column">Nama Karyawan</label>
                            <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror"
                                placeholder="Nama Karyawan" name="nama_karyawan" value="{{ old('nama_karyawan') }}">
                            @error('nama_karyawan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                                name="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">Jabatan</label>
                            <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror"
                                placeholder="Jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}">
                            @error('nama_jabatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">Kode Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                placeholder="Kode Jabatan" name="jabatan" value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12" hidden>
                        <div class="form-group">
                            <label for="last-name-column">Kode Jabatan</label>
                            <input type="hidden" name="kode_jabatan" value="{{ old('kode_jabatan') }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">No Rekening</label>
                            <input type="number" class="form-control @error('norek') is-invalid @enderror"
                                placeholder="No Rekening" name="norek" value="{{ old('norek') }}">
                            @error('norek')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">No Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror"
                                placeholder="No Telepon" name="no_telp" value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tgl_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                            @error('tgl_masuk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="lama_kerja">Lama Kerja (tahun)</label>
                            <input type="text" class="form-control @error('lama_kerja') is-invalid @enderror"
                                id="lama_kerja" name="lama_kerja" value="{{ old('lama_kerja') }}" readonly>
                            @error('lama_kerja')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <script>
                        function hitungLamaKerja() {
                            const tglMasuk = new Date(document.getElementById('tgl_masuk').value);
                            const today = new Date();

                            if (tglMasuk > today) {
                                document.getElementById('lama_kerja').value = "0.00";
                                return;
                            }

                            const diffTime = Math.abs(today - tglMasuk);
                            const lamaKerja = (diffTime / (1000 * 60 * 60 * 24 * 365)).toFixed(2);

                            document.getElementById('lama_kerja').value = lamaKerja;
                        }

                        document.getElementById('tgl_masuk').addEventListener('input', hitungLamaKerja);
                    </script>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        <a type="button" class="btn btn-light-secondary me-1 mb-1"
                            href="{{ route('karyawan.index') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
