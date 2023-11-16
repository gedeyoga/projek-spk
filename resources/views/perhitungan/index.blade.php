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
        <div class="row">
            <div class="col-lg-4">
                <form action="{{ route('perhitungan.index') }}" method="get" class="d-flex">
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
                <div class="d-flex justify-content-between">
                    <span>Data Kriteria</span>
                    <span>
                        @if($can_print)
                            <a class="btn btn-outline-dark float-left mr-3" href="{{  route('laporan.ranking', ['periode' => request()->get('periode' , date('Y'))]) }}" target="_blank">
                                <i class="fas fa-print"></i>
                                Cetak PDF
                            </a>
                        @endif
                        @if(request()->get('periode' , date('Y')) == date('Y'))
                        <form action="{{ route('perhitungan.save') }}" method="post" class="float-left">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perhitungan
                            </button>
                        </form>
                        @endif
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