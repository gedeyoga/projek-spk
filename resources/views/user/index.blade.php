@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                            <button onclick="onClickCreateModal()" class="btn btn-primary btn-sm">Tambah User</button>
                        </div>
                        <div class="col-8 col-md-3 ml-auto">
                            <form action="{{ route('user.index') }}" method="get">
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
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{ ($datas->currentpage() - 1) * $datas->perpage() + $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>******</td>

                                    <td class="d-flex">
                                        <button onclick="onShowModal('{{ $data->id }}')"
                                            class="btn btn-sm btn-info mr-2"><i
                                                class="fas fa-pencil-alt fa-fw mr-1"></i>Edit</button>
                                        <button onclick="handleDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger mr-2"><i
                                                class="fas fa-trash fa-fw mr-1"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($datas->count() == 0)
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
                                    @if ($datas->previousPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $datas->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @php
                                        $start = $datas->currentPage() - 2;
                                        $start = $start < 1 ? 1 : $start;
                                        $end = $datas->currentPage() + 2;
                                        $end = $end > $datas->lastPage() ? $datas->lastPage() : $end;
                                    @endphp

                                    @for ($no = $start; $no <= $end; $no++)
                                        <li class="page-item  {{ $datas->currentPage() == $no ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ route('kriteria.index') . '?page=' . $no }}">{{ $no }}</a>
                                        </li>
                                    @endfor

                                    @if ($datas->nextPageUrl())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $datas->nextPageUrl() }}">Next</a></li>
                                    @endif
                                </ul>
                                <small class="d-block text-center">Total data {{ $datas->total() }} </small>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        @include('user.modal.create')
        @include('user.modal.edit')
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
                        url: route('user.delete', {
                            user: id
                        }),
                        success: function(response) {
                            Swal.fire(
                                'Pemberitahuan',
                                response.message,
                                'success'
                            ).then((result) => {

                                if (result.isConfirmed) {
                                    window.location.href = '{{ route('user.index') }}';
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
