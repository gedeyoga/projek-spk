@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kriteria</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Kriteria</a></li>
                    <li class="breadcrumb-item" aria-current="page">Tambah</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <form id="form-create-kriteria" method="post" action="{{ route('kriteria.store') }}">
            <div class="card">
                <div class="card-header">
                    <span class="">Tambah Kriteria</span>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="Masukkan kriteria...">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="radio" name="type" class="form-check-input @error('type') is-invalid @enderror" {{ old('type') == 'benefit' ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Benefit
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" class="form-check-input @error('type') is-invalid @enderror" {{ old('type') == 'cost' ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Cost
                                </label>
                            </div>

                            @error('type')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nilai_bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                        <div class="col-sm-10">
                            <input type="number" name="nilai_bobot" class="form-control @error('nilai_bobot') is-invalid @enderror" value="{{ old('nilai_bobot') }}" autocomplete="off" placeholder="Masukkan nilai bobot...">
                            @error('nilai_bobot')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah Kriteria</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('javascript')
<script>
    $(document).ready(function() {
        $('#btn-tambah').on('click', function(e) {
            e.preventDefault();

            confirmation('Apakah anda yakin?', function() {
                $('#form-create-kriteria').submit();
            });
        })
    })
</script>
@endpush