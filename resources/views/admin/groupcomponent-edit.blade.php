<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">
            <i class="fas fa-map-marker-alt"></i> Edit Group Component
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Update Group Component</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('groupcomponent.update', $groupcomponents->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Group Component</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ $groupcomponents->name }}" placeholder="Enter New Group Component" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('groupcomponent.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
