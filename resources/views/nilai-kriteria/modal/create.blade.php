<div class="modal fade" id="modalFormKriteria" tabindex="-1" aria-labelledby="modalFormKriteriaLabel" aria-hidden="true">
    <form id="form-create-kriteria" method="post" action="{{ route('nilai-kriteria.store') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormKriteriaLabel">Tambah Nilai Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Kriteria</label>
                        <div class="col-sm-10">
                            <select type="text" name="kriteria"
                                class="form-control @error('kriteria') is-invalid @enderror" autocomplete="off"
                                required>
                                @foreach ($kriterias as $kriteria)
                                    <option value={{ $kriteria->id }}>{{ $kriteria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 1</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai1"
                                class="form-control @error('nilai1') is-invalid @enderror" value="{{ old('nilai1') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 1..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 2</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai2"
                                class="form-control @error('nilai2') is-invalid @enderror" value="{{ old('nilai2') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 2..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 3</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai3"
                                class="form-control @error('nilai3') is-invalid @enderror" value="{{ old('nilai3') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 3..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 4</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai4"
                                class="form-control @error('nilai1') is-invalid @enderror" value="{{ old('nilai4') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 4..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 5</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai5"
                                class="form-control @error('nilai5') is-invalid @enderror" value="{{ old('nilai5') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 4..." required>
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
                    url: '{{ route('nilai-kriteria.store') }}',
                    beforeSend: function() {
                        Swal.showLoading()
                    },
                    success: function(response) {
                        Swal.fire(
                            'Pemberitahuan',
                            response.message,
                            'success'
                        );

                        window.location.href = '{{ route('nilai-kriteria.index') }}';
                    },
                    error: function(err) {
                        $('#form-create-kriteria .invalid-feedback').remove();
                        Swal.close();
                        console.log(err.responseJSON)
                        for (const key in err.responseJSON.errors) {
                            $('#form-create-kriteria input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-create-kriteria select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-create-kriteria input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-create-kriteria select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-kriteria input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-kriteria select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
