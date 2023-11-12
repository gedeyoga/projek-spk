@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Kriteria</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Nilai Kriteria</li>
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
                        <div class="col-4 col-md-3">
                            <button onclick="onClickCreateModal()" class="btn btn-primary btn-sm">Tambah Kriteria</button>
                        </div>
                        <div class="col-8 col-md-3 ml-auto">
                            <form action="{{ route('kriteria.index') }}" method="get">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control"
                                        placeholder="Cari data kriteria..">

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-striped mb-3 table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kriteria</th>


                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilaiKriterias as $key => $kriteria)
                                <tr>
                                    <td>{{ ($nilaiKriterias->currentpage() - 1) * $nilaiKriterias->perpage() + $key + 1 }}
                                    </td>
                                    <td>{{ $kriteria->kriteria->name }}</td>



                                    <td class="d-flex">
                                        <button onclick="onShowModal('{{ $kriteria->id }}')"
                                            class="btn btn-sm btn-info mr-2"><i
                                                class="fas fa-pencil-alt fa-fw mr-1"></i>Edit</button>
                                        <button onclick="handleDelete('{{ $kriteria->id }}')"
                                            class="btn btn-sm btn-danger mr-2"><i
                                                class="fas fa-trash fa-fw mr-1"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($nilaiKriterias->count() == 0)
                                <tr>
                                    <td colspan="6"><span class="d-block text-center p-3">Tidak ada data</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if ($nilaiKriterias->previousPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $nilaiKriterias->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @php
                                        $start = $nilaiKriterias->currentPage() - 2;
                                        $start = $start < 1 ? 1 : $start;
                                        $end = $nilaiKriterias->currentPage() + 2;
                                        $end = $end > $nilaiKriterias->lastPage() ? $nilaiKriterias->lastPage() : $end;
                                    @endphp

                                    @for ($no = $start; $no <= $end; $no++)
                                        <li class="page-item  {{ $nilaiKriterias->currentPage() == $no ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ route('kriteria.index') . '?page=' . $no }}">{{ $no }}</a>
                                        </li>
                                    @endfor

                                    @if ($nilaiKriterias->nextPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $nilaiKriterias->nextPageUrl() }}">Next</a></li>
                                    @endif
                                </ul>
                                <small class="d-block text-center">Total data {{ $nilaiKriterias->total() }} </small>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        @include('nilai-kriteria.modal.create')
        @include('nilai-kriteria.modal.edit')
    </div>
    <!-- /.content -->
@endsection

@push('javascript')
    <script>
        function handleDelete(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: "DELETE",
                        data: {
                            "_token": $('meta[name="csrf-token"]')[0].content
                        },
                        url: route('nilai-kriteria.delete', {
                            kriteria: id
                        }),
                        success: function(response) {
                            Swal.fire(
                                'Pemberitahuan',
                                response.message,
                                'success'
                            );

                            window.location.href = route("nilai-kriteria.index");
                        },
                        error: function(err) {
                            Swal.close();
                            Swal.fire(
                                'Pemberitahuan',
                                'Gagal hapus data!',
                                'error'
                            );
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
@endpush
