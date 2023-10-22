<div class="modal fade" id="modalFormUser" tabindex="-1" aria-labelledby="modalFormKriteriaLabel" aria-hidden="true">
    <form id="form-create-user" method="post" action="{{ route('user.store') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormKriteriaLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                autocomplete="off" placeholder="Masukkan nama...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('email') }}"
                                autocomplete="off" placeholder="Masukkan email...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('password') }}"
                                autocomplete="off" placeholder="Masukkan password...">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('javascript')
    <script>
        function onClickCreateModal() {
            $('#modalFormUser').modal('show');
        }

        $(document).ready(function() {
            $("#form-create-user").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: '{{ route('user.store') }}',
                    beforeSend: function() {
                        Swal.showLoading()
                    },
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
                        $('#form-create-user .invalid-feedback').remove();
                        Swal.close();
                        for (const key in err.responseJSON.errors) {
                            $('#form-create-user input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-create-user select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-create-user input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-create-user select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-user input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-user select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
