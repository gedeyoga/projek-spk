<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Ranking</title>

    <style>
        @page {
            margin: 100px 50px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -90px;
            right: 0px;
            height: 90px;
            text-align: center;
            border-bottom: 1px solid black;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -100px;
            right: 0px;
            height: 90px;
            border-top: 1px solid black;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td,
        table tr th {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="header">
            <h4>{{ $company->name }}</h4>
            <h3>Laporan Kinerja Karyawan {{ date('Y' , strtotime($periode)) }}</h3>

    </div>
    <div id="footer">
        
    </div>
    <div id="content">

        <h3>Tabel Kinerja Karyawan</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Alternatif</th>
                    <th>Nilai</th>
                    <th>Ranking</th>
                </tr>
            </thead>

            <tbody>
                @if($terbobot->count() > 0)
                @foreach($terbobot->sortByDesc('total_nilai')->values() as $key => $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->penilaian->sum('matriks') }}</td>
                    <td>
                        {{ $key + 1 }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
                @endif
            </tbody>
        </table>
        <!-- <p style="page-break-before: always;">the second page</p> -->
    </div>
</body>

</html>