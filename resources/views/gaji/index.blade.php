@extends('layouts.template')

@section('content')
    <div class="card mx-3">
        <div class="card-header">
            <h4 class="card-title">Data Gaji</h4>
        </div>
        <div class="card-body">
            <form id="filterForm" action="{{ route('gaji.index') }}" method="GET" class="d-flex justify-content-start mb-3">
                <div class="form-group mx-2 w-50">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control"
                        onchange="document.getElementById('filterForm').submit();">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mx-2 w-50">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control"
                        onchange="document.getElementById('filterForm').submit();">
                        <option value="">Pilih Tahun</option>
                        @for ($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>

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
@endsection
