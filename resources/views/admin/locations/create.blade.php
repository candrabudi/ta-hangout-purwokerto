@extends('admin.layouts.app')

@section('backoffice-content')
    <div class="row mt-3">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Lokasi Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('location.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lokasi</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('location.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
