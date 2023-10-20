<div class="modal fade" id="modalFormKriteria" tabindex="-1" aria-labelledby="modalFormKriteriaLabel" aria-hidden="true">
    <form id="form-create-kriteria" method="post" action="{{ route('kriteria.store') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormKriteriaLabel">Tambah Kriteria</h5>
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
                                <option value="benefit" @error('type') is-invalid @enderror" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" @error('type') is-invalid @enderror" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost</option>
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
                    <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('javascript')
<script>
    function onClickCreateModal() {
        $('#modalFormKriteria').modal('show');
    }

    $(document).ready(function() {
        $("#form-create-kriteria").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                data: $(this).serialize(),
                url: '{{ route("kriteria.store") }}',
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
                    $('#form-create-kriteria .invalid-feedback').remove();
                    Swal.close();
                    for (const key in err.responseJSON.errors) {
                        $('#form-create-kriteria input[name="' + key + '"]').removeClass('is-invalid');
                        $('#form-create-kriteria select[name="' + key + '"]').removeClass('is-invalid');


                        $('#form-create-kriteria input[name="' + key + '"]').addClass('is-invalid');
                        $('#form-create-kriteria select[name="' + key + '"]').addClass('is-invalid');
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter('#form-create-kriteria input[name="' + key + '"]');
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter('#form-create-kriteria select[name="' + key + '"]');
                    }
                }
            });
        });
    });
</script>
@endpush