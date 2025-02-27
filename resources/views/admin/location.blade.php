<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">Locations</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Alert untuk sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h3 class="h5">List of Locations</h3>
                        <a href="{{ route('locations.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Location
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{ $location->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $location->id }})">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                            <form id="delete-form-{{ $location->id }}" action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(locationId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + locationId).submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>
