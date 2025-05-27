@extends('admin.layouts.app')
@section('backoffice-title', 'Data Visitor')
@section('backoffice-content')

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Visitor</h5>
            <form method="GET" class="d-flex align-items-center">
                <label class="me-2">Tampilkan</label>
                <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach ([5, 10, 20, 50] as $size)
                        <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}
                        </option>
                    @endforeach
                </select>
                <span class="ms-2">data</span>
                <input type="hidden" name="page" value="{{ $page }}">
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-framed mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Device Info</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Bookmarks</th>
                            <th>Shares</th>
                            <th>Ratings</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitors as $i => $visitor)
                            <tr>
                                <td>{{ ($page - 1) * $perPage + $i + 1 }}</td>
                                <td>{{ $visitor->device_info ?? '-' }}</td>
                                <td>{{ $visitor->views_count }}</td>
                                <td>{{ $visitor->likes_count }}</td>
                                <td>{{ $visitor->bookmarks_count }}</td>
                                <td>{{ $visitor->shares_count }}</td>
                                <td>{{ $visitor->ratings_count }}</td>
                                <td>{{ $visitor->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data visitor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($totalPages > 1)
                <div class="p-3 d-flex justify-content-between align-items-center">
                    <form method="GET" class="d-flex align-items-center">
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <button class="btn btn-sm btn-outline-secondary me-2" name="page" value="{{ $page - 1 }}"
                            {{ $page <= 1 ? 'disabled' : '' }}>
                            &laquo; Prev
                        </button>
                        <span>Halaman {{ $page }} dari {{ $totalPages }}</span>
                        <button class="btn btn-sm btn-outline-secondary ms-2" name="page" value="{{ $page + 1 }}"
                            {{ $page >= $totalPages ? 'disabled' : '' }}>
                            Next &raquo;
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection
