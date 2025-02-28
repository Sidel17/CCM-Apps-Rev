<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">Add New Report</h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="unit_id" class="form-label">Unit</label>
                            <select id="unit_id" name="unit_id" class="form-select" required>
                                <option value="">-- Select Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->codeunit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <input type="text" id="brand_id" class="form-control" disabled>
                            <input type="hidden" name="brand_id" id="brand_id_hidden">
                        </div>
                        <div class="col-md-3">
                            <label for="unitmodel_id" class="form-label">Unit Model</label>
                            <input type="text" id="unitmodel_id" class="form-control" disabled>
                            <input type="hidden" name="unitmodel_id" id="unitmodel_id_hidden">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="hm" class="form-label">HM</label>
                            <input type="number" id="hm" name="hm" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="location_id" class="form-label">Location</label>
                            <select id="location_id" name="location_id" class="form-select" required>
                                <option value="">-- Select Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="statusunit_id" class="form-label">Status Unit</label>
                            <select id="statusunit_id" name="statusunit_id" class="form-select" required>
                                <option value="">-- Select Status --</option>
                                @foreach ($statusUnits as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="date_start" class="form-label">Date & Time Start</label>
                            <input type="datetime-local" id="date_start" name="date_start" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="date_finish" class="form-label">Date & Time Finish</label>
                            <input type="datetime-local" id="date_finish" name="date_finish" class="form-control">
                        </div>

                    <div class="col-md-4">
                        <label for="manpowers" class="form-label">Select Manpowers</label>
                        <select name="manpowers[]" id="manpowers" class="form-control select2" multiple="multiple">
                            @foreach ($manpowers as $manpower)
                                <option value="{{ $manpower->id }}">{{ $manpower->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="problem_desc" class="form-label">Problem Description</label>
                            <textarea id="problem_desc" name="problem_desc" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="groupcomponent_id" class="form-label">Group Component</label>
                            <select id="groupcomponent_id" name="groupcomponent_id" class="form-select" required>
                                <option value="">-- Select Group Component --</option>
                                @foreach ($groupComponents as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="componentdetail_id" class="form-label">Component</label>
                            <select id="componentdetail_id" name="componentdetail_id" class="form-select" required>
                                <option value="">-- Select Component --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="activity_report" class="form-label">Activity Report</label>
                            <textarea id="activity_report" name="activity_report" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="backlog_outstanding" class="form-label">Backlog & Outstanding</label>
                            <textarea id="backlog_outstanding" name="backlog_outstanding" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('unit_id').addEventListener('change', function () {
            let unitId = this.value;

            if (unitId) {
                fetch(`/get-brand-model/${unitId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging: lihat hasil respons di console

                    if (data.brand && data.unitmodel) {
                        document.getElementById('brand_id').value = data.brand.name; 
                        document.getElementById('brand_id_hidden').value = data.brand.id;

                        document.getElementById('unitmodel_id').value = data.unitmodel.name;
                        document.getElementById('unitmodel_id_hidden').value = data.unitmodel.id;
                    } else {
                        document.getElementById('brand_id').value = "Not Found";
                        document.getElementById('brand_id_hidden').value = "";

                        document.getElementById('unitmodel_id').value = "Not Found";
                        document.getElementById('unitmodel_id_hidden').value = "";
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });


        document.getElementById('groupcomponent_id').addEventListener('change', function() {
            let groupId = this.value;
            fetch(`/get-component-details/${groupId}`)
                .then(response => response.json())
                .then(data => {
                    let componentSelect = document.getElementById('componentdetail_id');
                    componentSelect.innerHTML = '<option value="">-- Select Component --</option>';
                    data.forEach(component => {
                        componentSelect.innerHTML += `<option value="${component.id}">${component.name}</option>`;
                    });
                });
        });

        // $(document).ready(function() {
        //     $('.selectpicker').selectpicker();
        // });

        $(document).ready(function() {
            $('#manpowers').select2({
                placeholder: "Select Manpowers",
                allowClear: true
            });
        });

    </script>
</x-app-layout>
