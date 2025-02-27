<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">
            {{ __('Edit Component') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Update Component</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('componentdetail.update', $componentdetail->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="groupcomponent_id" class="form-label fw-bold">Group Component</label>
                            <select name="groupcomponent_id" id="groupcomponent_id" class="form-select" required>
                                @foreach ($groupcomponent as $groupcomponents)
                                    <option value="{{ $groupcomponents->id }}" {{ $componentdetail->groupcomponent_id == $groupcomponents->id ? 'selected' : '' }}>
                                        {{ $groupcomponents->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Component</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $componentdetail->name }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('componentdetail.index') }}" class="btn btn-secondary">
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
