<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">Reports</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h3 class="h5">List of Reports</h3>
                        <a href="{{ route('reports.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Report
                        </a>
                    </div>

                    <div class="table-responsive" x-data="dragDropTable()" x-init="initDragAndDrop">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Unit</th>
                                    <th>Brand</th>
                                    <th>Unit Model</th>
                                    <th>Location</th>
                                    <th>HM</th>
                                    <th>Problem Breakdown</th>
                                    <th>Date Start</th>
                                    <th>Date Finish</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach ($reports as $report)
                                    <tr 
                                        class="sortable-item"
                                        data-id="{{ $report->id }}" 
                                        draggable="true"
                                        @dragstart="dragStart($event)"
                                        @dragover.prevent
                                        @drop="drop($event)">
                                        <td>{{ $report->unit->codeunit }}</td>
                                        <td>{{ $report->brand->name }}</td>
                                        <td>{{ $report->unitModel->name }}</td>
                                        <td>{{ $report->location->name }}</td>
                                        <td>{{ $report->hm }}</td>
                                        <td>{{ $report->problem_desc}}</td>
                                        <td>{{ $report->date_start }}</td>
                                        <td>{{ $report->date_finish ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $report->id }})">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                            <form id="delete-form-{{ $report->id }}" action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: none;">
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
        function confirmDelete(reportId) {
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
                    document.getElementById('delete-form-' + reportId).submit();
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

    <script>
        function dragDropTable() {
            return {
                initDragAndDrop() {
                    let items = document.querySelectorAll(".sortable-item");
                    items.forEach(item => {
                        item.addEventListener("dragstart", this.dragStart);
                        item.addEventListener("drop", this.drop);
                        item.addEventListener("dragover", event => event.preventDefault());
                    });
                },
                dragStart(event) {
                    event.dataTransfer.setData("text/plain", event.target.getAttribute("data-id"));
                },
                drop(event) {
                    event.preventDefault();
                    let draggedId = event.dataTransfer.getData("text/plain");
                    let dropTarget = event.target.closest("tr");

                    if (!dropTarget) return;

                    let parent = dropTarget.parentNode;
                    let draggedElement = document.querySelector(`[data-id='${draggedId}']`);

                    if (draggedElement !== dropTarget) {
                        parent.insertBefore(draggedElement, dropTarget.nextSibling);
                        this.updateOrder();
                    }
                },
                updateOrder() {
                    let order = [];
                    document.querySelectorAll("#sortable tr").forEach((el, index) => {
                        order.push({ id: el.getAttribute("data-id"), order: index + 1 });
                    });

                    fetch("{{ route('update.order') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ order })
                    }).then(response => response.json())
                    .then(data => console.log("Order updated:", data));
                }
            };
        }
    </script>
</x-app-layout>
