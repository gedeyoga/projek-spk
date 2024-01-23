<div class="modal fade" id="modalEditIncidentCriticalForm" tabindex="-1" aria-labelledby="modalEditFormKriteriaLabel"
    aria-hidden="true">
    <form id="form-edit-incident" method="POST">
        @method('put')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditFormKriteriaLabel">Edit Incident Critical</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Kriteria</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kriteria_id" id="">
                                @foreach($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Critical Incident</label>
                        <div class="col-sm-10">
                            <input type="description" name="description"
                                class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"
                                autocomplete="off" placeholder="Masukkan Critical Incidents...">
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
                url: route('bars.critical-incident.show', {
                    critical: id
                }),
                beforeSend: function() {
                    Swal.showLoading()
                },
                success: function(response) {
                    Swal.close();
                    $('#form-edit-incident input[name="id"]').remove();
                    $('#modalEditIncidentCriticalForm').modal('show');
                    let kriteria = $('#form-edit-incident select[name=kriteria_id]');
                    let description = $('#form-edit-incident input[name=description]');

                    kriteria.val(response.data.kriteria_id);
                    description.val(response.data.description);


                    $('#form-edit-incident').append('<input type="hidden" name="id" value="' + id +'">');
                },
                error: function(err) {
                    Swal.close();
                }
            });
        }

        $(document).ready(function() {
            $("#form-edit-incident").submit(function(e) {
                e.preventDefault();



                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: route("bars.critical-incident.update", {
                        critical: $('#form-edit-incident input[name="id"]').val()
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
                            // if (result.isConfirmed) {
                                // }
                            window.location.href = "{{ route('bars.critical-incident') }}";
                        });



                    },
                    error: function(err) {
                        $('#form-edit-incident .invalid-feedback').remove();
                        Swal.close();
                        console.log(err.responseJSON)
                        for (const key in err.responseJSON.errors) {
                            $('#form-edit-incident input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-edit-incident select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-edit-incident input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-edit-incident select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-incident input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-incident select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
