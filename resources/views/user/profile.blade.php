@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('user.updateProfile' , ['user' => $user->id]) }}" id="form-edit-user">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" autocomplete="off" placeholder="Cth: Jhon Doe">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" autocomplete="off" placeholder="cth: example@example.com" value="{{ $user->email }}">
                            @error('email')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-10">
                            <input name="new_password" type="password" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Masukan Password Baru..">
                            @error('password')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
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
    $(document).ready(function() {

    })
</script>
@endpush