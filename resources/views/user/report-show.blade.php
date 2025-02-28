<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">Report Details</h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-primary">{{ $report->unit->codeunit }} / {{ $report->brand->name }} {{ $report->unitmodel->name }}</h4>
                <p><strong>Lokasi:</strong> {{ $report->location->name }}</p>
                <p><strong>HM:</strong> {{ $report->hm }}</p>

                <div class="mb-3">
                    <h5>Problem:</h5>
                    <p>- {{ $report->problem_desc }}</p>
                </div>

                <p><strong>Group:</strong> {{ $report->groupComponent->name ?? '-' }}</p>
                <p><strong>Component:</strong> {{ $report->componentDetail->name ?? '-' }}</p>

                <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($report->date_start)->format('d-m-y H:i') }}</p>
                <p><strong>Ready:</strong> {{ $report->date_finish ? \Carbon\Carbon::parse($report->date_finish)->format('d-m-y H:i') : 'Belum selesai' }}</p>

                <div class="mb-3">
                    <h5>Activity:</h5>
                    <ul>
                        @foreach(explode("\n", $report->activity_report) as $activity)
                            <li>{{ $activity }}</li>
                        @endforeach
                    </ul>
                </div>

                <p><strong>Status:</strong> {{ $report->statusUnit->name ?? '-' }}</p>
                <p><strong>Backlog/Outstanding:</strong> {{ $report->backlog_outstanding ?? '-' }}</p>
                <p><strong>MP:</strong> 
                    @if ($report->manpower && $report->manpower->count() > 0)
                        @foreach ($report->manpower as $mp)
                            {{ $mp->name }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    @else
                        -
                    @endif
                </p>
                

                <hr>

                <!-- BOX LAPORAN -->
                <div class="border p-3 bg-light" id="reportText">
                    {{ $report->unit->codeunit }} / {{ $report->brand->name }} {{ $report->unitmodel->name }}
                    <br>Lokasi: {{ $report->location->name }}
                    <br>HM: {{ $report->hm }}
                    <br>Problem:
                    <br>- {{ $report->problem_desc }}
                    <br>Group: {{ $report->groupComponent->name ?? '-' }}
                    <br>Component: {{ $report->componentDetail->name ?? '-' }}
                    <br>Start: {{ \Carbon\Carbon::parse($report->date_start)->format('d-m-y H:i') }}
                    <br>Ready: {{ $report->date_finish ? \Carbon\Carbon::parse($report->date_finish)->format('d-m-y H:i') : 'Belum selesai' }}
                    <br>Activity:
                    @foreach(explode("\n", $report->activity_report) as $activity)
                    <br>- {{ $activity }}
                    @endforeach
                    <br>Status: {{ $report->statusUnit->name ?? '-' }}
                    <br>Backlog/Outstanding: {{ $report->backlog_outstanding ?? '-' }}
                    <br>MP: 
                    @foreach ($report->manpower as $manpowers)
                    {{ $manpowers->name }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @if ($report->manpower->isEmpty()) - @endif
                </div>

                <!-- TOMBOL COPY -->
                <div class="text-end mt-3">
                    <button id="copyReport" class="btn btn-primary">
                        <i class="fas fa-copy"></i> Copy Report
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('copyReport').addEventListener('click', function () {
            var reportText = document.getElementById("reportText").innerText;
            navigator.clipboard.writeText(reportText).then(function () {
                alert("Report copied to clipboard!");
            });
        });
    </script>
</x-app-layout>
