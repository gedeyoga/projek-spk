<div class="modal fade" id="modalEditFormKriteria" tabindex="-1" aria-labelledby="modalEditFormKriteriaLabel"
    aria-hidden="true">
    <form id="form-edit-kriteria-nilai" method="POST">
        @method('put') @csrf <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditFormKriteriaLabel">Edit Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Kriteria</label>
                        <div class="col-sm-10">
                            <select type="text" name="kriteria_id" id="kriteria_id" class="form-control" required>
                                @foreach ($kriterias as $kriteria)
                                    <option class="kriteria" value={{ $kriteria->id }}>{{ $kriteria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 1</label>
                        <div class="col-sm-10">
                            <input type="text" name="ket1"
                                class="form-control @error('nilai1') is-invalid @enderror" value="{{ old('nilai1') }}"
                                autocomplete="off" id="nilai1" placeholder="Masukkan keterangan nilai 1..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 2</label>
                        <div class="col-sm-10">
                            <input type="text" name="ket2" id="nilai2"
                                class="form-control @error('nilai2') is-invalid @enderror" value="{{ old('nilai2') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 2..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 3</label>
                        <div class="col-sm-10">
                            <input type="text" name="ket3" id="nilai3"
                                class="form-control @error('nilai3') is-invalid @enderror" value="{{ old('nilai3') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 3..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 4</label>
                        <div class="col-sm-10">
                            <input type="text" name="ket4" id="nilai4"
                                class="form-control @error('nilai1') is-invalid @enderror" value="{{ old('nilai4') }}"
                                autocomplete="off" placeholder="Masukkan keterangan nilai 4..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Nilai 5</label>
                        <div class="col-sm-10">
                            <input type="text" name="ket5"
                                class="form-control @error('nilai5') is-invalid @enderror" value="{{ old('nilai5') }}"
                                autocomplete="off" id="nilai5" placeholder="Masukkan keterangan nilai 5..." required>
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
                url: route('nilai-kriteria.edit', {
                    kriteria: id
                }),
                beforeSend: function() {
                    Swal.showLoading();
                },
                success: function(response) {
                    console.log(response);
                    Swal.close();
                    $('#form-edit-kriteria-nilai input[name="kriteria_id2"]').remove();
                    $('#modalEditFormKriteria').modal('show');
                    let nilai1 = $('#nilai1');
                    let nilai2 = $('#nilai2');
                    let nilai3 = $('#nilai3');
                    let nilai4 = $('#nilai4');
                    let nilai5 = $('#nilai5');
                    const kriteria = document.querySelectorAll('.kriteria')

                    kriteria.forEach(element => {
                        if (element.innerText === response.kriteria) {
                            element.setAttribute('selected', true);
                        }
                    });



                    nilai1.val(response.data.ket1);
                    nilai2.val(response.data.ket2);
                    nilai3.val(response.data.ket3);
                    nilai4.val(response.data.ket4);
                    nilai5.val(response.data.ket5);

                    $('#form-edit-kriteria-nilai').append('<input type="hidden" name="kriteria_id2" value="' +
                        id +
                        '">');
                },
                error: function(err) {
                    Swal.close();
                }
            });
        }




        $(document).ready(function() {
            $("#form-edit-kriteria-nilai").submit(function(e) {
                e.preventDefault();

                console.log($('#form-edit-kriteria-nilai input[name="kriteria_id2"]')
                    .val())

                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: route("nilai-kriteria.update", {
                        kriteria: $('#form-edit-kriteria-nilai input[name="kriteria_id2"]')
                            .val()
                    }),
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
                        $('#form-edit-kriteria-nilai .invalid-feedback').remove();
                        Swal.close();
                        for (const key in err.responseJSON.errors) {
                            $('#form-edit-kriteria input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-edit-kriteria select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-edit-kriteria input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-edit-kriteria select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-kriteria input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-edit-kriteria select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
