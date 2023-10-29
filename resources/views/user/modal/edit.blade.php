<div class="modal fade" id="modalEditFormUser" tabindex="-1" aria-labelledby="modalEditFormKriteriaLabel"
    aria-hidden="true">
    <form id="form-edit-user" method="POST">
        @method('put')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditFormKriteriaLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                autocomplete="off" placeholder="Masukkan Nama...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                autocomplete="off" placeholder="Masukkan Email...">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                value="{{ old('new_password') }}" autocomplete="off" placeholder="Masukkan Password Baru...">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="btn-tambah" type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('javascript')
    <script>
        function onShowModal(id) {

            $.ajax({
                type: "GET",
                data: {
                    "_token": $('meta[name="csrf-token"]')[0].content
                },
                url: route('user.edit', {
                    user: id
                }),
                beforeSend: function() {
                    Swal.showLoading()
                },
                success: function(response) {
                    Swal.close();
                    $('#form-edit-user input[name="id"]').remove();
                    $('#modalEditFormUser').modal('show');
                    let name = $('#name');
                    let email = $('#email');

                    console.log(response)

                    name.val(response.data.name);
                    email.val(response.data.email);


                    $('#form-edit-user').append('<input type="hidden" name="id" value="' + id +'">');
                },
                error: function(err) {
                    Swal.close();
                }
            });
        }

        $(document).ready(function() {
            $("#form-edit-user").submit(function(e) {
                e.preventDefault();



                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: route("user.update", {
                        user: $('#form-edit-user input[name="id"]').val()
                    }),
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
                        $('#form-edit-user .invalid-feedback').remove();
                        Swal.close();
                        console.log(err.responseJSON)
                        for (const key in err.responseJSON.errors) {
                            $('#form-edit-user input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-edit-user select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-edit-user input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-edit-user select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-user input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-user select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
