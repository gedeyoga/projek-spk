<div class="modal fade" id="modalPerformanceForm" tabindex="-1" aria-labelledby="modalFormKriteriaLabel" aria-hidden="true">
    <form id="form-create-performance" method="post" action="{{ route('user.store') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormKriteriaLabel">Tambah Performance</h5>
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
                        <label for="description" class="col-sm-2 col-form-label">Performance</label>
                        <div class="col-sm-10">
                            <input type="description" name="description"
                                class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"
                                autocomplete="off" placeholder="Masukkan Performances...">
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
            $('#modalPerformanceForm').modal('show');
        }

        $(document).ready(function() {
            $("#form-create-performance").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: "{{ route('bars.performance.store') }}",
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
                                window.location.href = "{{ route('bars.performance') }}";
                            }
                        });


                    },
                    error: function(err) {
                        $('#form-create-performance .invalid-feedback').remove();
                        Swal.close();
                        for (const key in err.responseJSON.errors) {
                            $('#form-create-performance input[name="' + key + '"]').removeClass(
                                'is-invalid');
                            $('#form-create-performance select[name="' + key + '"]').removeClass(
                                'is-invalid');


                            $('#form-create-performance input[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('#form-create-performance select[name="' + key + '"]').addClass(
                                'is-invalid');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-performance input[name="' + key + '"]');
                            $('<div class="invalid-feedback">' + err.responseJSON.errors[key][
                                0
                            ] + '</div>').insertAfter(
                                '#form-create-performance select[name="' + key + '"]');
                        }
                    }
                });
            });
        });
    </script>
@endpush
