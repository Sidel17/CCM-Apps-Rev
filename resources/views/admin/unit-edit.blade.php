<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">Edit Unit</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Alert sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">Edit Unit - {{ $unit->codeunit }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('units.update', $unit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Code Unit -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Code Unit <span class="text-danger">*</span></label>
                                <input type="text" name="codeunit" class="form-control" value="{{ $unit->codeunit }}" required>
                            </div>

                            <!-- Brand -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" id="brand_id" class="form-select" required>
                                    <option value="">-- Select Brand --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $unit->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Unit Model -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Unit Model <span class="text-danger">*</span></label>
                                <select name="unitmodel_id" id="unitmodel_id" class="form-select" required>
                                    <option value="">-- Select Unit Model --</option>
                                    @foreach($unitModels as $unitmodel)
                                        <option value="{{ $unitmodel->id }}" {{ $unit->unitmodel_id == $unitmodel->id ? 'selected' : '' }}>
                                            {{ $unitmodel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('units.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Unit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery untuk AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let selectedBrand = $('#brand_id').val();
            loadUnitModels(selectedBrand, {{ $unit->unitmodel_id }});

            $('#brand_id').change(function() {
                let brandId = $(this).val();
                loadUnitModels(brandId);
            });

            function loadUnitModels(brandId, selectedUnitModel = null) {
                $('#unitmodel_id').empty().append('<option value="">Loading...</option>').prop('disabled', true);

                if (brandId) {
                    $.ajax({
                        url: '/get-unitmodels/' + brandId,
                        type: 'GET',
                        success: function(data) {
                            $('#unitmodel_id').empty().append('<option value="">-- Select Unit Model --</option>').prop('disabled', false);
                            $.each(data, function(key, unitmodel) {
                                let selected = (selectedUnitModel == unitmodel.id) ? 'selected' : '';
                                $('#unitmodel_id').append('<option value="' + unitmodel.id + '" ' + selected + '>' + unitmodel.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#unitmodel_id').empty().append('<option value="">-- Select Unit Model --</option>').prop('disabled', true);
                }
            }
        });
    </script>
</x-app-layout>
