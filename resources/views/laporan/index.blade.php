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


        <div class="row">
            <div class="col-lg-4">
                <form action="{{ route('laporan.index') }}" method="get" class="d-flex">
                    <div class="form-group d-flex align-items-center mr-3">
                        <label class="mr-3">Periode:</label>
                        <div class="input-group date" id="periode" data-target-input="nearest">
                            <input type="text" name="periode" class="form-control datetimepicker-input" data-target="#periode" />
                            <div class="input-group-append" data-target="#periode" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-fw fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Data Kinerja Karyawan</span>
                    @if($can_print)
                    <span>
                        <a class="btn btn-outline-dark" href="{{  route('laporan.ranking',  ['periode' => request()->get('periode' , date('Y'))]) }}" target="_blank">
                            <i class="fas fa-print"></i>
                            Cetak PDF
                        </a>
                    </span>
                    @endif
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


    <script>
        let datePeriode = "{{ !is_null( request()->get('periode')) ?  ''. request()->get('periode') : ''. date('Y') }}";

        $('#periode').datetimepicker({
            format: 'YYYY',
            viewMode: 'years', // Hanya menampilkan pilihan tahun
            minViewMode: 'years', // Minimum view mode adalah tahun
            defaultDate: moment(datePeriode),
        });
    </script>

    @endpush