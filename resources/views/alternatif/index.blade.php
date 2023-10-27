@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Alternatif</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Pemberitahuan',
                {{ session('success') }}, 'success'
            )
        </script>
    @endif

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4 col-md-3">
                            <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm">Tambah Alternatif</a>
                        </div>
                        <div class="col-8 col-md-3 ml-auto">
                            <form action="{{ route('alternatif.index') }}" method="get">
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
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $key => $alternatif)
                                <tr>
                                    <td>{{ ($alternatifs->currentpage() - 1) * $alternatifs->perpage() + $key + 1 }}</td>
                                    <td>{{ $alternatif->kode }}</td>
                                    <td>{{ $alternatif->name }}</td>

                                    <td class="d-flex">
                                        <a href="{{ route('alternatif.edit', ['alternatif' => $alternatif->id]) }}"
                                            class="btn btn-sm btn-info mr-2"><i
                                                class="fas fa-pencil-alt fa-fw mr-1"></i>Edit</a>
                                        <button onclick="handleDelete('{{ $alternatif->id }}')"
                                            class="btn btn-sm btn-danger mr-2"><i
                                                class="fas fa-trash fa-fw mr-1"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($alternatifs->count() == 0)
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
                                    @if ($alternatifs->previousPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $alternatifs->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @php
                                        $start = $alternatifs->currentPage() - 2;
                                        $start = $start < 1 ? 1 : $start;
                                        $end = $alternatifs->currentPage() + 2;
                                        $end = $end > $alternatifs->lastPage() ? $alternatifs->lastPage() : $end;
                                    @endphp

                                    @for ($no = $start; $no <= $end; $no++)
                                        <li class="page-item  {{ $alternatifs->currentPage() == $no ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ route('kriteria.index') . '?page=' . $no }}">{{ $no }}</a>
                                        </li>
                                    @endfor

                                    @if ($alternatifs->nextPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $alternatifs->nextPageUrl() }}">Next</a></li>
                                    @endif
                                </ul>
                                <small class="d-block text-center">Total data {{ $alternatifs->total() }} </small>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        @include('kriteria.modal.create')
        @include('kriteria.modal.edit')
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
                        url: route('alternatif.delete', {
                            alternatif: id
                        }),
                        success: function(response) {
                            Swal.fire(
                                'Pemberitahuan',
                                response.message,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = route("alternatif.index");
                                }
                            });


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
