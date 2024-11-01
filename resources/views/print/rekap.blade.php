@extends('layouts.template')

@section('content')
    <section>
        <div class="card">
            <div class="card-header">Print Gaji</div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="wrap">
                        <label for="tanggal">Pilih Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <button type="button" id="cetakPdf" class="btn btn-primary mt-3" style="display: none;">Cetak
                        PDF</button>
                </form>

                <!-- Tabel Gaji -->
                <div id="tabelGaji" style="display: none; margin-top: 20px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Gaji Pokok</th>
                                <th>Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody id="gajiData">
                            <!-- Data gaji akan dimuat di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('tanggal').addEventListener('change', function() {
            const tanggal = this.value;
            const cetakPdfBtn = document.getElementById('cetakPdf');
            if (tanggal) {
                fetch(`/gaji/filter-by-date?tanggal=${tanggal}`)
                    .then(response => response.json())
                    .then(data => {
                        const gajiTable = document.getElementById('tabelGaji');
                        const gajiData = document.getElementById('gajiData');
                        gajiData.innerHTML = '';

                        if (data.length > 0) {
                            gajiTable.style.display = 'block';
                            cetakPdfBtn.style.display = 'inline-block';

                            // Mengubah tautan cetak PDF menjadi tindakan JavaScript
                            cetakPdfBtn.onclick = function() {
                                window.open(`/gaji/cetakrekap?tanggal=${tanggal}`, '_blank');
                            };

                            data.forEach(gaji => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${gaji.karyawan.nama_karyawan}</td>
                                    <td>${gaji.tanggal}</td>
                                    <td>${gaji.gpokok}</td>
                                    <td>${gaji.total_gaji}</td>
                                `;
                                gajiData.appendChild(row);
                            });
                        } else {
                            gajiTable.style.display = 'none';
                            cetakPdfBtn.style.display = 'none';
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Tidak Ditemukan',
                                text: 'Data gaji tidak ditemukan untuk tanggal ini.',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
