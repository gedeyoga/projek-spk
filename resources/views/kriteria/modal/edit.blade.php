<div class="modal fade" id="modalEditFormKriteria" tabindex="-1" aria-labelledby="modalEditFormKriteriaLabel" aria-hidden="true">
    <form id="form-edit-kriteria" method="POST">
        @method('put')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditFormKriteriaLabel">Edit Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="Masukkan kriteria...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-sm-10">
                            <select name="type" class="custom-select">
                                <option>-- Pilih Tipe --</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nilai_bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" name="nilai_bobot" class="form-control @error('nilai_bobot') is-invalid @enderror" value="{{ old('nilai_bobot') }}" autocomplete="off" placeholder="Masukkan nilai bobot...">
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
            url: route('kriteria.edit' , {kriteria: id}),
            beforeSend: function() {
                Swal.showLoading()
            },
            success: function(response) {
                Swal.close();
                $('#form-edit-kriteria input[name="kriteria_id"]').remove();
                $('#modalEditFormKriteria').modal('show');
                let name = $('#form-edit-kriteria input[name="name"]');
                let nilai_bobot = $('#form-edit-kriteria input[name="nilai_bobot"]');
                let type = $('#form-edit-kriteria select[name="type"]');

                name.val(response.data.name);
                nilai_bobot.val(response.data.nilai_bobot);
                type.val(response.data.type);
                
                $('#form-edit-kriteria').append('<input type="hidden" name="kriteria_id" value="'+id+'">');
            },
            error: function(err) {
                Swal.close();
            }
        });
    }

    $(document).ready(function() {
        $("#form-edit-kriteria").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                data: $(this).serialize(),
                url: route("kriteria.update", {kriteria: $('#form-edit-kriteria input[name="kriteria_id"]').val()}),
                beforeSend: function() {
                    Swal.showLoading()
                },
                success: function(response) {
                    Swal.fire(
                        'Pemberitahuan',
                        response.message,
                        'success'
                    );

                    window.location.href = '{{ route("kriteria.index") }}';
                },
                error: function(err) {
                    $('#form-edit-kriteria .invalid-feedback').remove();
                    Swal.close();
                    for (const key in err.responseJSON.errors) {
                        $('#form-edit-kriteria input[name="' + key + '"]').removeClass('is-invalid');
                        $('#form-edit-kriteria select[name="' + key + '"]').removeClass('is-invalid');


                        $('#form-edit-kriteria input[name="' + key + '"]').addClass('is-invalid');
                        $('#form-edit-kriteria select[name="' + key + '"]').addClass('is-invalid');
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter('#form-edit-kriteria input[name="' + key + '"]');
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter('#form-edit-kriteria select[name="' + key + '"]');
                    }
                }
            });
        });
    });
</script>
@endpush