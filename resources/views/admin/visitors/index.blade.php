@extends('admin.layouts.app')
@section('backoffice-title', 'Data Visitor')
@section('backoffice-content')

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Visitor</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                 <table class="table table-framed">
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
                                <td>{{ $i + 1 }}</td>
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
        </div>
    </div>

@endsection
