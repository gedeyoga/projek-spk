@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Perhitungan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Perhitungan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Data Kriteria</span>
                    <span>
                        <a class="btn btn-outline-dark" href="{{  route('laporan.ranking') }}" target="_blank">
                            <i class="fas fa-print"></i>
                            Cetak PDF
                        </a>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <table class="table w-100 table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($kriteria->count() > 0)
                        @foreach($kriteria as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->type }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Data Alternatif
            </div>
            <div class="card-body">
                <table class="table w-100 table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Alternatif</th>
                            @foreach($kriteria as $item)
                            <th>{{ $item->name }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @if($alternatif->count() > 0)
                        @foreach($alternatif as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->name }}</td>
                            @foreach($kriteria as $kr)
                            @if( $item->penilaian->where('kriteria_id' , $kr->id)->count() == 1)
                            <td>{{ $item->penilaian->where('kriteria_id' , $kr->id)->first()->nilai }}</td>
                            @else
                            <td>0</td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Data Terbobot
            </div>
            <div class="card-body">
                <table class="table w-100 table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Alternatif</th>
                            @foreach($kriteria as $item)
                            <th>{{ $item->name }}</th>
                            @endforeach
                            <th>Yi = max</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($alternatif->count() > 0)
                        @foreach($alternatif as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->name }}</td>
                            @foreach($kriteria as $kr)
                            @if( $item->penilaian->where('kriteria_id' , $kr->id)->count() == 1)
                            <td>{{ $item->penilaian->where('kriteria_id' , $kr->id)->first()->matriks }}</td>
                            @else
                            <td>0</td>
                            @endif
                            @endforeach
                            <td>
                                {{ $item->penilaian->sum('matriks') }}
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
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Perankingan
            </div>
            <div class="card-body">
                <table class="table w-100 table-sm">
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
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('javascript')
@endpush