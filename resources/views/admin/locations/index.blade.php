@extends('admin.layouts.app')

@section('backoffice-content')
    <div class="row mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar Lokasi</h5>
                <a href="{{ route('location.create') }}" class="btn btn-primary btn-sm">Tambah Lokasi</a>
            </div>
            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $i => $location)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->latitude ?? '-' }}</td>
                                <td>{{ $location->longitude ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('location.edit', $location->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('location.destroy', $location->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus lokasi ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
