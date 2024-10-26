@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Karyawan</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama_karyawan"
                                value="{{ $karyawan->nama_karyawan }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jabatan">Nama Jabatan</label>
                            <input type="text" class="form-control" placeholder="Nama Jabatan" name="nama_jabatan"
                                value="{{ $karyawan->nama_jabatan }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jabatan">Kode Jabatan</label>
                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan"
                                value="{{ $karyawan->jabatan }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control" placeholder="NIK" name="nik"
                                value="{{ $karyawan->nik }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="norek">No Rekening</label>
                            <input type="number" class="form-control" placeholder="No Rekening" name="norek"
                                value="{{ $karyawan->norek }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="norek">No Telepon</label>
                            <input type="number" class="form-control" placeholder="No Rekening" name="no_telp"
                                value="{{ $karyawan->no_telp }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tgl_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk', $karyawan->tgl_masuk) }}"
                                value="{{ $karyawan->tgl_masuk }}">
                            @error('tgl_masuk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="lama_kerja">Lama Kerja (tahun)</label>
                            <input type="text" class="form-control @error('lama_kerja') is-invalid @enderror"
                                id="lama_kerja" name="lama_kerja" value="{{ $karyawan->lama_kerja }}" readonly>
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
                        <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                        <a href="{{ route('karyawan.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
