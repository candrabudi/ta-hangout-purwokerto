@extends('admin.layouts.app')

@section('backoffice-title', 'Edit Coffee Shop')
@section('backoffice-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <style>
        .fixed-size-thumbnail {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .delete-button {
            font-size: 12px;
            padding: 5px 10px;
            background-color: #dc3545;
            border: none;
            color: white;
            cursor: pointer;
            margin: auto;
            display: block;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Coffee Shop</h5>
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

                                    <form action="{{ route('admin.coffee_shops.update', $coffeeShop->id) }}" method="POST"
                                        enctype="multipart/form-data" id="main-form">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group mb-3">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $coffeeShop->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="address">Alamat</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ old('address', $coffeeShop->address) }}" required>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Deskripsi</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $coffeeShop->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="location_id">Lokasi</label>
                                            <select class="form-control @error('location_id') is-invalid @enderror"
                                                name="location_id" required>
                                                <option value="">-- Pilih Lokasi --</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                        {{ old('location_id', $coffeeShop->location_id) == $location->id ? 'selected' : '' }}>
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
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                name="status">
                                                <option value="1"
                                                    {{ old('status', $coffeeShop->status) == '1' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0"
                                                    {{ old('status', $coffeeShop->status) == '0' ? 'selected' : '' }}>
                                                    Nonaktif</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="google_maps_url">Google Maps URL</label>
                                            <input type="text"
                                                class="form-control @error('google_maps_url') is-invalid @enderror"
                                                name="google_maps_url"
                                                value="{{ old('google_maps_url', $coffeeShop->google_maps_url) }}">
                                            @error('google_maps_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="thumbnail">Thumbnail</label><br>
                                            @if ($coffeeShop->thumbnail)
                                                <img src="{{ asset('storage/' . $coffeeShop->thumbnail) }}"
                                                    alt="Current Thumbnail" class="img-thumbnail mb-2"
                                                    style="max-height: 120px;">
                                            @endif
                                            <input type="file"
                                                class="form-control @error('thumbnail') is-invalid @enderror"
                                                name="thumbnail">
                                            @error('thumbnail')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div id="uploaded-files"></div>

                                        <button type="submit" class="btn btn-primary mt-3">Update</button>
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
                                    <form action="{{ route('admin.coffee_shops.upload') }}" method="POST" class="dropzone"
                                        id="dropzone">
                                        @csrf
                                    </form>

                                    <div class="row mt-2">
                                        @foreach ($coffeeShopImages as $csi)
                                            <div class="col-6 col-sm-4 col-md-3 mb-4">
                                                <div class="card p-1">
                                                    <img src="{{ asset('storage/' . $csi->image_path) }}"
                                                        alt="Current Thumbnail" class="img-thumbnail fixed-size-thumbnail">
                                                    <form action="{{ route('admin.coffee_shops.deleteImage', $csi->id) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm delete-button mt-3"
                                                            onclick="return confirm('Are you sure you want to delete this image?');">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
