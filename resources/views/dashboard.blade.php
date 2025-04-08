<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-lg border-0 rounded-4 text-center">
                <div class="card-body p-4">

                    {{-- Status --}}
                    <h5 class="fw-bold mb-3">
                        {{ __("You're logged in!") }}
                    </h5>
                    <p class="text-muted mb-4">
                        Target Bulanan SAP
                    </p>

                    {{-- Gambar (menggunakan komponen Blade) --}}
                    <div class="d-flex justify-content-center mb-4">
                        <x-target-bulanan-sap class="img-fluid rounded-3 shadow-sm" />
                    </div>

                    {{-- Tombol Link --}}
                    <a href="https://linktr.ee/get_ccm_sebakis"
                       target="_blank"
                       class="btn btn-success btn-lg px-4 shadow">
                        🌐 Kunjungi Linktree SAP nya yaaaa....... ^_^
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
