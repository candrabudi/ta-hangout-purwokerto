@extends('admin.layouts.app')

@section('backoffice-title', 'Tambah Coffee Shop')
@section('backoffice-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />

    <div class="row mt-3">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Coffee Shop</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hangout.store') }}" method="POST" enctype="multipart/form-data" id="main-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="categories">Kategori</label>
                            <select name="categories[]" id="select-categories" multiple
                                class="form-control select2 @error('categories') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group mb-3">
                            <label for="address">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="location_id">Lokasi</label>
                            <select class="form-control @error('location_id') is-invalid @enderror" name="location_id"
                                required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="google_maps_url">Google Maps URL</label>
                            <input type="text" class="form-control @error('google_maps_url') is-invalid @enderror"
                                name="google_maps_url" value="{{ old('google_maps_url') }}">
                            @error('google_maps_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                name="thumbnail" required>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="uploaded-files"></div>

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5>Upload Gambar Tambahan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hangout.upload.image') }}" method="POST" class="dropzone" id="dropzone">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        Dropzone.options.dropzone = {
            paramName: "file",
            maxFilesize: 2,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            success: function(file, response) {
                const input = `<input type="hidden" name="images[]" value="${response.name}">`;
                document.getElementById('uploaded-files').insertAdjacentHTML('beforeend', input);
            }
        };
    </script>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-categories').select2({
                placeholder: 'Pilih kategori',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
