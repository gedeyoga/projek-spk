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
                                        <label for="code" class="col-sm-2 col-form-label">Kode</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $alternatif->kode }}" autocomplete="off" placeholder="kode" readonly>
                                    </div>
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
                                                $nilaiKriteria = null;
                                                $ket = null;
                                                foreach ($alternatif->penilaian as $penilaian) {
                                                    if ($penilaian->kriteria_id === $kriteria->id) {
                                                        $nilaiKriteria = $penilaian->nilai;

                                                        if ($penilaian->nilai == 1) {
                                                            $ket = $kriteria->kriteria_nilai[0]->ket1;
                                                        }
                                                        if ($penilaian->nilai == 2) {
                                                            $ket = $kriteria->kriteria_nilai[0]->ket2;
                                                        }
                                                        if ($penilaian->nilai == 3) {
                                                            $ket = $kriteria->kriteria_nilai[0]->ket3;
                                                        }
                                                        if ($penilaian->nilai == 4) {
                                                            $ket = $kriteria->kriteria_nilai[0]->ket4;
                                                        }
                                                        if ($penilaian->nilai == 5) {
                                                            $ket = $kriteria->kriteria_nilai[0]->ket5;
                                                        }
                                                    }
                                                }

                                            @endphp
                                            <select type="number" name="{{ $kriteria->name }}"
                                                class="form-control @error($kriteria->name) is-invalid @enderror"
                                                autocomplete="off" placeholder="Masukkan nilai.."
                                                onchange="changeHandler(this, '{{ $kriteria->kriteria_nilai[0] }}', '{{ $kriteria->name }}')"
                                                required>
                                                <option value="1" {{ $nilaiKriteria == 1 ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ $nilaiKriteria == 2 ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ $nilaiKriteria == 3 ? 'selected' : '' }}>3
                                                </option>
                                                <option value="4" {{ $nilaiKriteria == 4 ? 'selected' : '' }}>4
                                                </option>
                                                <option value="5" {{ $nilaiKriteria == 5 ? 'selected' : '' }}>5
                                                </option>
                                            </select>
                                            <p id="{{ $kriteria->name }}">Keterangan : {{ $ket }}</p>
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

    </div>
    <!-- /.content -->
@endsection
