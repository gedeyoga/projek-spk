@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
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
                <div class="card-header">Perusahaan</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <img width="250" src="{{ $company->logo }}" class="img-thumbnail" alt="{{ $company->name }}">
                        </div>
                        <div class="col-lg-9">
                            <table class="table table-sm">
                                <tr>
                                    <td width="100px">Nama</td>
                                    <td>{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <td width="100px">Alamat</td>
                                    <td>{{ $company->address }}</td>
                                </tr>
                                <tr>
                                    <td width="100px">Telepon</td>
                                    <td>{{ $company->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Kinerja Karyawan</span>
                        <span>
                            <a class="btn btn-outline-dark" href="{{ route('laporan.ranking') }}" target="_blank">
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
                                <th>Alternatif</th>
                                <th>Nilai</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($terbobot->count() > 0)
                                @foreach ($terbobot->sortByDesc('total_nilai')->values() as $key => $item)
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
