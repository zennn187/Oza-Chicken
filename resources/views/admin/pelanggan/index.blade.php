@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data Pelanggan</h1>
                <p class="mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-success text-white">
                    <i class="fas fa-plus me-1"></i> Tambah Pelanggan
                </a>
            </div>
        </div>
    </div>

    {{-- Filter & Search Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.pelanggan.index') }}">
                        <div class="row">
                            {{-- Search Input --}}
                            <div class="col-md-3 mb-3">
                                <label for="search" class="form-label">Cari Pelanggan</label>
                                <input type="text"
                                       class="form-control"
                                       id="search"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nama, Email, atau Telepon...">
                            </div>

                            {{-- Gender Filter --}}
                            <div class="col-md-2 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Semua</option>
                                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                    <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            {{-- Date Range Filter --}}
                            <div class="col-md-3 mb-3">
                                <label for="start_date" class="form-label">Tanggal Lahir Dari</label>
                                <input type="date"
                                       class="form-control"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ request('start_date') }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="end_date" class="form-label">Sampai</label>
                                <input type="date"
                                       class="form-control"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ request('end_date') }}">
                            </div>

                            {{-- Action Buttons --}}
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary w-100">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-pelanggan" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">ID</th>
                                    <th class="border-0">First Name</th>
                                    <th class="border-0">Last Name</th>
                                    <th class="border-0">Birthday</th>
                                    <th class="border-0">Gender</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Phone</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataPelanggan as $item)
                                    <tr>
                                        <td>{{ $item->pelanggan_id }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->birthday ? \Carbon\Carbon::parse($item->birthday)->format('d-m-Y') : '-' }}</td>
                                        <td>
                                            @if($item->gender == 'Male')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @elseif($item->gender == 'Female')
                                                <span class="badge bg-pink">Perempuan</span>
                                            @else
                                                <span class="badge bg-secondary">Lainnya</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.pelanggan.edit', $item->pelanggan_id) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.pelanggan.destroy', $item->pelanggan_id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Tidak ada data pelanggan yang ditemukan.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        @if($dataPelanggan->hasPages())
                            <div class="mt-3">
                                {{ $dataPelanggan->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @endif

                        {{-- Result Info --}}
                        <div class="mt-2 text-muted">
                            Menampilkan {{ $dataPelanggan->firstItem() ?? 0 }} - {{ $dataPelanggan->lastItem() ?? 0 }} dari {{ $dataPelanggan->total() }} data
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection

@push('scripts')
<script>
    // Clear date inputs when reset button is clicked
    document.addEventListener('DOMContentLoaded', function() {
        const resetBtn = document.querySelector('a[href*="pelanggan.index"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                document.getElementById('search').value = '';
                document.getElementById('gender').selectedIndex = 0;
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
            });
        }

        // Validate date range
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                if (endDate.value && startDate.value > endDate.value) {
                    alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                    startDate.value = '';
                }
            });

            endDate.addEventListener('change', function() {
                if (startDate.value && endDate.value < startDate.value) {
                    alert('Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
                    endDate.value = '';
                }
            });
        }
    });
</script>
@endpush
