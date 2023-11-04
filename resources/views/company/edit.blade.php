@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Setting</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('company.update' , ['company' => $company->id]) }}" id="form-edit-company" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $company->name }}" autocomplete="off" placeholder="Cth: Jhon Doe">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $company->phone }}" autocomplete="off" placeholder="Cth: 081233294329">
                            @error('phone')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="textarea" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $company->address }}" autocomplete="off" placeholder="Cth: JL. Teuku Umar">
                            @error('address')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" value="{{ $company->logo}}" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append btn-success">
                                    <a class="btn btn-success" href="{{ $company->logo }}" class="" target="_blank"><i class="fas fa-image"></i></a>
                                </div>
                            </div>
                            @error('logo')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-edit" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('javascript')
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush