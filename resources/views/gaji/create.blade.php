@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Input Gaji</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('gaji.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="karyawan">Nama Karyawan</label>
                            <select name="karyawan_id" class="form-select choices">
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Gaji</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="gpokok">Gaji Pokok</label>
                            <input type="number" class="form-control" name="gpokok" id="gpokok"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- Insentif -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="insentif">Insentif</label>
                            <input type="number" class="form-control" name="insentif" id="insentif"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label for="hadir">Hadir</label>
                            <input type="number" class="form-control" name="hadir" id="hadir"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <div class="col-md-2 col-4">
                        <div class="form-group">
                            <label for="hadir">Izin</label>
                            <input type="number" class="form-control" name="izin">
                        </div>
                    </div>

                    <div class="col-md-2 col-4">
                        <div class="form-group">
                            <label for="hadir">Sakit</label>
                            <input type="number" class="form-control" name="sakit">
                        </div>
                    </div>

                    <div class="col-md-2 col-4">
                        <div class="form-group">
                            <label for="hadir">Terlambat</label>
                            <input type="number" class="form-control" name="terlambat">
                        </div>
                    </div>

                    <div class="col-md-2 col-4">
                        <div class="form-group">
                            <label for="hadir">Alpha</label>
                            <input type="number" class="form-control" name="alpa">
                        </div>
                    </div>


                    <!-- Gaji Jabatan -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="gjabatan">Gaji Jabatan</label>
                            <input type="number" class="form-control" name="gjabatan" id="gjabatan"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- OPRS -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="oprs">OPRS</label>
                            <input type="number" class="form-control" name="oprs" id="oprs"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="service">Service</label>
                            <input type="number" class="form-control" name="service" id="service"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- HP -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="hp">HP</label>
                            <input type="number" class="form-control" name="hp" id="hp"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>



                    <!-- Angsuran -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="angsuran">Angsuran</label>
                            <input type="number" class="form-control" name="angsuran" id="angsuran"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- BPJS -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="bpjs">BPJS</label>
                            <input type="number" class="form-control" name="bpjs" id="bpjs"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- Kasbon -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kasbon">Kasbon</label>
                            <input type="number" class="form-control" name="kasbon" id="kasbon"
                                oninput="calculateTotalGaji()">
                        </div>
                    </div>

                    <!-- Total Gaji -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="total_gaji">Total Gaji</label>
                            <input type="number" class="form-control" name="total_gaji" id="total_gaji" readonly>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        <a type="button" href="{{ route('gaji.index') }}"
                            class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                    </div>
                </div>
            </form>

            <script>
                function calculateTotalGaji() {
                    const hadir = parseFloat(document.getElementById("hadir").value) || 0;
                    const gpokok = parseFloat(document.getElementById("gpokok").value) || 0;
                    const gjabatan = parseFloat(document.getElementById("gjabatan").value) || 0;
                    const oprs = parseFloat(document.getElementById("oprs").value) || 0;
                    const service = parseFloat(document.getElementById("service").value) || 0;
                    const hp = parseFloat(document.getElementById("hp").value) || 0;
                    const insentif = parseFloat(document.getElementById("insentif").value) || 0;
                    const angsuran = parseFloat(document.getElementById("angsuran").value) || 0;
                    const bpjs = parseFloat(document.getElementById("bpjs").value) || 0;
                    const kasbon = parseFloat(document.getElementById("kasbon").value) || 0;

                    const totalGaji = gpokok + (insentif * hadir) + gjabatan + oprs + service + hp - angsuran - bpjs - kasbon;
                    document.getElementById("total_gaji").value = totalGaji;
                }
            </script>
        </div>
    </div>
@endsection
