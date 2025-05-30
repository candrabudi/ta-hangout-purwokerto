@extends('admin.layouts.app')
@section('backoffice-title', 'Data Hangout')
@section('backoffice-content')
    <div class="row mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">Data Hangout</h5>
                    <small class="text-muted">Menampilkan daftar Hangout yang ada di Purwokerto.</small>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('location.index') }}" class="btn btn-outline-secondary btn-sm">Kelola Lokasi</a>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-secondary btn-sm">Kelola Kategori</a>
                    <a href="{{ route('hangout.create') }}" class="btn btn-primary btn-sm">Tambah Rekomendasi Hangout</a>
                </div>
            </div>


            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-framed datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Jumlah Gambar</th>
                                <th>Rata-rata Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hangouts as $index => $hangout)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $hangout->name }}</td>
                                    <td>{{ $hangout->address }}</td>
                                    <td>{{ $hangout->location->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $hangout->status == 1 ? 'success' : 'danger' }}">
                                            {{ $hangout->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($hangout->categories as $category)
                                            <span class="badge bg-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($hangout->average_rating, 1) }}</td>
                                    <td>
                                        <a href="{{ route('hangout.edit', $hangout->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('hangout.destroy', $hangout->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus coffee shop ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                pageLength: 10,
                lengthChange: false,
                ordering: true,
                language: {
                    search: "Cari:",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    },
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                }
            });
        });
    </script>
@endpush
