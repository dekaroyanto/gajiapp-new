@extends('layouts.template')

{{-- @section('cardheader')
    Data Karyawan <br>
    <form action="{{ route('karyawan.index') }}" method="GET">
        <select name="jabatan" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Jabatan</option>
            @foreach ($jabatan as $jab)
                <option value="{{ $jab }}" {{ request('jabatan') == $jab ? 'selected' : '' }}>
                    {{ $jab }}
                </option>
            @endforeach
        </select>
    </form>
@endsection --}}

{{-- @section('judulhal')
    Karyawan <br>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
@endsection --}}

{{-- @section('link', 'Karyawan') --}}

@section('content')
    <div class="card">
        <div class="card-header">
            Data Karyawan <br>
            <form action="{{ route('karyawan.index') }}" method="GET">
                <select name="jabatan" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Jabatan</option>
                    @foreach ($jabatan as $jab)
                        <option value="{{ $jab }}" {{ request('jabatan') == $jab ? 'selected' : '' }}>
                            {{ $jab }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center" id="table1">
                <thead>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td>Jabatan</td>
                        <td>Kode Jabatan</td>
                        <td>Tanggal Masuk</td>
                        <td>Lama Kerja</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->nama_jabatan }}</td>
                            <td>{{ $karyawan->kode_jabatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($karyawan->tgl_masuk)->translatedFormat('d F Y') }}</td>
                            <td>{{ $karyawan->lama_kerja }} Tahun</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <a type="button" class="btn btn-warning mx-1"
                                        href="{{ route('karyawan.edit', $karyawan->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                "pageLength": 10,
                "ordering": true,
                // nonaktifkan fitur search default dari DataTables karena kita sudah punya filter sendiri
                "searching": false
            });
        });
    </script>
@endsection --}}
