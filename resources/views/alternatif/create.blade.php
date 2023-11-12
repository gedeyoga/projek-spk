@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Tambah Alternatif</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Alternatif</li>
                        <li class="breadcrumb-item active">Craete</li>
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

                            <form action="{{ route('alternatif.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-10">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('password') }}" autocomplete="off" placeholder="Masukkan nama..."
                                            required>
                                    </div>

                                    @foreach ($kriterias as $kriteria)
                                        <div class="col-sm-10">
                                            <label for="name" class="col-form-label">{{ $kriteria->name }}</label>
                                            <select name="{{ $kriteria->name }}"
                                                onchange="changeHandler(this, '{{ $kriteria->kriteria_nilai[0] ?? '' }}', '{{ $kriteria->name }}')"
                                                class="form-control" autocomplete="off" required>
                                                <option>Pilih nilai</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p id="{{ $kriteria->name }}"></p>
                                        </div>
                                    @endforeach


                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Alterantif</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content -->

    @push('javascript')
        <script>
            function elemen(elemen, currentElemen, jsonData) {
                setTimeout(() => {
                    const elemenName = document.getElementById(elemen);

                    if (currentElemen.value === '1') {
                        elemenName.innerHTML = `Keterangan : ${jsonData.ket1}`
                    } else if (currentElemen.value === '2') {
                        elemenName.innerHTML = `Keterangan : ${jsonData.ket2}`;
                    } else if (currentElemen.value === '3') {
                        elemenName.innerHTML = `Keterangan : ${jsonData.ket3}`
                    } else if (currentElemen.value === '4') {
                        elemenName.innerHTML = `Keterangan : ${jsonData.ket4}`
                    } else if (currentElemen.value === '5') {
                        elemenName.innerHTML = `Keterangan : ${jsonData.ket5}`
                    }
                }, 1);
            }

            function changeHandler(currentElemen, data, nameElemen) {
                const jsonData = JSON.parse(data);
                elemen(nameElemen, currentElemen, jsonData)


            }
        </script>
    @endpush
@endsection
