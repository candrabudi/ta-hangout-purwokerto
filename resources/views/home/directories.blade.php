@extends('template.app')
@section('title', 'Direktori')
@section('user-content')
    <style>
        .blog1-single-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            transition: 0.3s ease;
        }

        .blog1-single-box .thumbnail {
            width: 100%;
            aspect-ratio: 1 / 1;
            /* square image area */
            overflow: hidden;
        }

        .blog1-single-box .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .blog1-single-box .heading1 {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .blog1-single-box .social-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .blog1-single-box h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .blog1-single-box p {
            font-size: 14px;
            color: #666;
            flex-grow: 1;
        }

        .author-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            margin-top: 15px;
        }

        .author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-tumb img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .author-text {
            font-size: 14px;
            color: #333;
            text-decoration: none;
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date a {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: #0077cc;
            text-decoration: none;
        }
    </style>

    @include('home.partials.hero')
    <div class="blog-page-sec sp">
        <div class="container">
            <div class="row">
                @foreach ($hangouts as $hangout)
                    <div class="col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-offset="50" data-aos-duration="400"
                        data-aos-delay="100">
                        <div class="blog1-single-box">
                            <div class="thumbnail image-anime">
                                <img src="{{ asset('storage/' . $hangout->thumbnail) }}" alt="{{ $hangout->name }}" />
                            </div>
                            <div class="heading1">
                                <div class="social-area">
                                    <a href="{{ route('home.directories.show', $hangout->slug) }}" class="social">Hangout
                                        Spot</a>
                                    <a href="#" class="time"><img
                                            src="{{ asset('template/frontend/img/icons/time1.svg') }}" alt="time" />
                                        {{ \Carbon\Carbon::parse($hangout->created_at)->translatedFormat('d F Y') }}</a>
                                </div>
                                <h4><a href="{{ route('home.directories.show', $hangout->slug) }}">{{ $hangout->name }}</a>
                                </h4>
                                <p class="mt-16">{{ Str::limit($hangout->description, 100) }}</p>
                                <div class="author-area">
                                    <div class="author">
                                        <div class="author-tumb">
                                            <img src="https://cdn-icons-png.flaticon.com/128/18390/18390769.png"
                                                alt="author" width="16" />
                                        </div>
                                        <a href="#" class="author-text">{{ $hangout->address }}</a>
                                    </div>
                                    <div class="date">
                                        <a href="{{ $hangout->google_maps_url }}" target="_blank">
                                            <img src="https://cdn-icons-png.flaticon.com/128/684/684908.png" width="16"
                                                alt="map" /> Map
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="space60"></div>
            <div class="row" data-aos-offset="50" data-aos="fade-up" data-aos-duration="400">
                <div class="col-12 m-auto">
                    <div class="theme-pagination text-center">
                        <ul>
                            <li>
                                <a href="{{ $hangouts->onFirstPage() ? '#' : $hangouts->previousPageUrl() }}">
                                    <i class="fa-solid fa-angle-left"></i>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $hangouts->lastPage(); $i++)
                                @if ($i == $hangouts->currentPage())
                                    <li><a class="active" href="#">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</a></li>
                                @elseif ($i == 1 || $i == $hangouts->lastPage() || abs($i - $hangouts->currentPage()) <= 1)
                                    <li><a href="{{ $hangouts->url($i) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</a>
                                    </li>
                                @elseif (
                                    ($i == 2 && $hangouts->currentPage() > 3) ||
                                        ($i == $hangouts->lastPage() - 1 && $hangouts->currentPage() < $hangouts->lastPage() - 2))
                                    <li><span>...</span></li>
                                @endif
                            @endfor
                            <li>
                                <a href="{{ $hangouts->hasMorePages() ? $hangouts->nextPageUrl() : '#' }}">
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
