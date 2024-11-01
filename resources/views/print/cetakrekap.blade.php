<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rekap Gaji</title>
    <style>
        table.static {
            position: relative;
            border-collapse: collapse;
            /* width: 100%; */
        }

        table.static td,
        table.static th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border: none;
            padding: 1px 4px;
        }

        table.static th {
            border: 1px dotted;
            border-left: none;
            border-right: none;

        }

        table.static tr:nth-child(10n+1) {
            border-bottom: 1px dotted;
        }

        table.static tr.total-row td {
            border-top: 1px dotted;
            border-bottom: 1px dotted;
        }
    </style>
    <title>CETAK REKAP GAJI</title>
</head>

<body>
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp
    <h2>Rekap Gaji - {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Gaji Pokok</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gajis as $gaji)
                <tr>
                    <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                    <td>{{ \Carbon\Carbon::parse($gaji->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ number_format($gaji->gpokok, 2) }}</td>
                    <td>{{ number_format($gaji->total_gaji, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
