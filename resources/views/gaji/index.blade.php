@extends('layouts.template')



@section('content')
    <div class="card mx-3">
        <div class="card-header">
            <h4 class="card-title">Data Gaji</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>T. JAB</th>
                        <th>T. OPR</th>
                        <th>T. SVC</th>
                        <th>Insentif Kehadiran</th>
                        <th>Absensi Kehadiran</th>
                        <th>Total Gaji</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gajis as $gaji)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gaji->tanggal }}</td>
                            <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                            <td>{{ $gaji->karyawan->nama_jabatan }}</td>
                            <td>{{ number_format($gaji->gpokok) }}</td>
                            <td>{{ number_format($gaji->gjabatan) }}</td>
                            <td>{{ number_format($gaji->oprs) }}</td>
                            <td>{{ number_format($gaji->service) }}</td>
                            <td>{{ number_format($gaji->insentif) }}</td>
                            <td>{{ $gaji->hadir }}</td>
                            <td>{{ number_format($gaji->total_gaji) }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="btn btn-warning mx-1"
                                        href="{{ route('gaji.edit', $gaji->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('gaji.destroy', $gaji->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus gaji ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="mb-3">
        <a href="{{ route('gaji.create') }}" class="btn btn-primary">Tambah Gaji</a>
    </div> --}}
@endsection
