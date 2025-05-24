@extends('admin.layouts.app')
@section('backoffice-title', 'Data Hangout')
@section('backoffice-content')
    <div class="row mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Data Hangout</h5>
                    <small class="text-muted">Menampilkan daftar Hangout yang ada di Purwokerto.</small>
                </div>
                <a href="{{ route('hangout.create') }}" class="btn btn-primary mt-2 mt-md-0">Tambah Rekomendasi Hangout</a>
            </div>

            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-framed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Jumlah Gambar</th>
                                <th>Rata-rata Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hangouts as $index => $hangout)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $hangout->name }}</td>
                                    <td>{{ $hangout->address }}</td>
                                    <td>{{ $hangout->location->name ?? '-' }}</td>
                                    <td>
                                        @if ($hangout->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $hangout->images_count }}</td>
                                    <td>{{ number_format($hangout->average_rating, 1) }}</td>
                                    <td>
                                        <a href="{{ route('hangout.edit', $hangout->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('hangout.destroy', $hangout->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus coffee shop ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
