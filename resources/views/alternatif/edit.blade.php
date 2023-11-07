@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Edit Alternatif</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Alternatif</li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">

                            <form action="{{ route('alternatif.update', ['alternatif' => $alternatif->id]) }}"
                                method="POST">

                                @method('put')
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-10">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $alternatif->name) }}" autocomplete="off"
                                            placeholder="Masukkan nama..." required>
                                    </div>

                                    @foreach ($kriterias as $kriteria)
                                        <div class="col-sm-10">
                                            <label for="name" class="col-form-label">{{ $kriteria->name }}</label>
                                            @php
                                                $nilaiKriteria = old($kriteria->name);
                                                foreach ($alternatif->penilaian as $penilaian) {
                                                    if ($penilaian->kriteria_id === $kriteria->id) {
                                                        $nilaiKriteria = $penilaian->nilai;
                                                    }
                                                }
                                            @endphp
                                            <input type="number" name="{{ $kriteria->name }}"
                                                class="form-control @error($kriteria->name) is-invalid @enderror"
                                                value="{{ $nilaiKriteria }}" autocomplete="off"
                                                placeholder="Masukkan nilai.." required>
                                        </div>
                                    @endforeach


                                </div>
                                       <button type="submit" class="btn btn-primary">Edit Alterantif</button>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection
