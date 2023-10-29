@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <p>Total Alternatif</p>
                        <h3>{{ count($alternatifs) }}</h3>


                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-person-add"></i> --}}
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <p>Total Kriteria</p>
                        <h3>{{ count($kriterias) }}</h3>


                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-person-add"></i> --}}
                    </div>

                </div>
            </div>
        </div>
        @php

            $datas = [];

            class Data
            {
                public $nama;
                public $nilai;

                public function __construct($nama, $nilai)
                {
                    $this->nama = $nama;
                    $this->nilai = $nilai;
                }
            }
            foreach ($rankings as $ranking) {
                $datas[] = new Data($ranking->name, $ranking->total_nilai);
            }

        @endphp


        </ul>
        <div class="container-fluid">

            <canvas id="myChart"></canvas>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        const datas = @json($datas);

        const labelChart = []
        const dataChart = [];

        let nomor = 1;
        datas.forEach((data) => {
            labelChart.push(`Ranking ${nomor} / ${data.nama}`)
            dataChart.push(
                data.nilai,
            )

            nomor++;
        });

        console.log(dataChart)

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelChart,
                datasets: [{
                    label: 'Rangking',
                    data: dataChart,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- right col -->
@endsection
