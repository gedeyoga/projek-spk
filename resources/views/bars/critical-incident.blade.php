@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Critical Incident</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Bars</a></li>
                    <li class="breadcrumb-item active">Critical Incident</li>
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

                <div class="d-flex justify-content-end">
                     <button onclick="onClickCreateModal()" class="btn btn-primary btn-sm">Tambah Critical Incident</button>
                </div>

                <table class="table table-striped mb-3 table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col" width="500px">Incident</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $key => $kriteria)
                        <tr>
                            <td style="vertical-align: middle;" rowspan="{{ $kriteria->critical_incidents->count() + 1 }}">{{ $kriteria->kode }}</td>
                            <td style="vertical-align: middle;" rowspan="{{ $kriteria->critical_incidents->count() + 1 }}">{{ $kriteria->name }}</td>
                        </tr>

                        @foreach($kriteria->critical_incidents as $incident)
                        <tr>
                            <td>{{ $incident->description }}</td>
                            <td>
                                <button onclick="onShowModal('{{ $incident->id }}')" class="btn btn-sm btn-info mr-2"><i class="fas fa-pencil-alt fa-fw mr-1"></i>Edit</button>
                                <button onclick="handleDelete('{{ $incident->id }}')" class="btn btn-sm btn-danger mr-2"><i class="fas fa-trash fa-fw mr-1"></i>Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    @include('bars.modal.create-incident')
    @include('bars.modal.edit-incident')
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
                    url: route('bars.critical-incident.destroy', {
                        critical: id
                    }),
                    success: function(response) {
                        Swal.fire(
                            'Pemberitahuan',
                            response.message,
                            'success'
                        ).then((result) => {

                            if (result.isConfirmed) {
                                window.location.href = "{{ route('bars.critical-incident') }}";
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