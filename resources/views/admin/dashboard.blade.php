@extends('admin.layouts.app')

@section('backoffice-title', 'Dashboard')

@section('backoffice-content')

    <div class="row g-3 mb-4 mt-4">
        @foreach([
            ['label' => 'Total Hangouts', 'value' => $totalHangout, 'color' => 'primary'],
            ['label' => 'Hangout Aktif', 'value' => $activeHangout, 'color' => 'success'],
            ['label' => 'Total Gambar', 'value' => $totalImages, 'color' => 'info'],
            ['label' => 'Rata-rata Rating', 'value' => $avgRatingAll, 'color' => 'warning'],
        ] as $card)
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-light text-center">
                    <div class="card-body">
                        <h6 class="text-muted mb-1">{{ $card['label'] }}</h6>
                        <h3 class="text-{{ $card['color'] }}">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
            <h5 class="mb-0">5 Hangout Terbaru</h5>
            <a href="{{ route('hangout.create') }}" class="btn btn-sm btn-primary">+ Tambah Hangout</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-nowrap mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Rating</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hangouts as $index => $hangout)
                            <tr class="align-middle text-center">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $hangout->name }}</td>
                                <td class="text-start">{{ $hangout->address }}</td>
                                <td>{{ $hangout->location->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $hangout->status ? 'success' : 'secondary' }}">
                                        {{ $hangout->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>{{ $hangout->images_count }}</td>
                                <td>{{ number_format($hangout->average_rating, 1) ?? '0.0' }}</td>
                                <td>
                                    <a href="{{ route('hangout.edit', $hangout->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('hangout.destroy', $hangout->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada data hangout.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
