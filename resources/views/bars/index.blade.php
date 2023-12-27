@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bars</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Bars</li>
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
            <div class="card-body">

                <table class="table table-striped mb-3 table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Bars</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Anchor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $key => $kriteria)
                        <tr>
                            <td style="vertical-align: middle;" rowspan="5">{{ $kriteria->kode }}</td>
                            <td style="vertical-align: middle;" rowspan="5">{{ $kriteria->name }}</td>
                            <td>1</td>
                            @if($kriteria->kriteria_nilai()->count() == 1)
                                <td>{{ $kriteria->kriteria_nilai()->first()->ket1 }}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>2</td>
                            @if($kriteria->kriteria_nilai()->count() == 1)
                                <td>{{ $kriteria->kriteria_nilai()->first()->ket2 }}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>3</td>
                            @if($kriteria->kriteria_nilai()->count() == 1)
                                <td>{{ $kriteria->kriteria_nilai()->first()->ket3 }}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>4</td>
                            @if($kriteria->kriteria_nilai()->count() == 1)
                                <td>{{ $kriteria->kriteria_nilai()->first()->ket4 }}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>5</td>
                            @if($kriteria->kriteria_nilai()->count() == 1)
                                <td>{{ $kriteria->kriteria_nilai()->first()->ket5 }}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection