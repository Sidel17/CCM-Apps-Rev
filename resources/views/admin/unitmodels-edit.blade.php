<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">
            {{ __('Edit Unit Model') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Update Unit Model</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('unitmodels.update', $unitmodel->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="brand_id" class="form-label fw-bold">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $unitmodel->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Model Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $unitmodel->name }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('unitmodels.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
