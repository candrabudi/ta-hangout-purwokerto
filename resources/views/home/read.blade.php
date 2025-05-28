@extends('template.app')
@section('title', $hangout->name)
@section('user-content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <style>
        .star {
            color: #ccc;
            transition: color 0.2s;
        }

        .star-filled {
            color: gold;
        }

        #star-rating .star:hover,
        #star-rating .star:hover~.star {
            color: #ccc;
        }

        #star-rating.hover-active .star.hovered {
            color: gold;
        }

        .hangout-info-box {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .thumbnail-bg {
            width: 100%;
            /* max-width: 250px; */
            height: 250px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            margin: 0 auto;
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .gallery-grid a {
            flex: 1 0 calc(33.333% - 10px);
            max-width: calc(33.333% - 10px);
            border-radius: 8px;
            overflow: hidden;
        }

        .gallery-grid img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }
    </style>
    <style>
        .hangout-gallery-box .swiper-slide img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .thumbnail-bg {
            width: 100%;
            max-height: 250px;
            background-repeat: no-repeat;
            border-radius: 12px;
        }
    </style>
    <style>
        .swiper-button-next,
        .swiper-button-prev {
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 50%;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>

    @include('home.partials.hero')
    <div class="blog-details1-all sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hangout-info-box p-4">
                        <h2 class="mb-3">{{ $hangout->name }}</h2>
                        <p class="text-muted mb-3">{{ $hangout->description }}</p>

                        <div class="info-item mb-2">
                            <strong>Alamat:</strong>
                            <p class="mb-0">{{ $hangout->address }}</p>
                        </div>

                        @if ($hangout->google_maps_url)
                            <div class="info-item mb-3">
                                <a href="{{ $hangout->google_maps_url }}" target="_blank"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fa-solid fa-map-location-dot"></i> Lihat di Google Maps
                                </a>
                            </div>
                        @endif

                        <div class="interaction-area d-flex align-items-center gap-3 mt-4">
                            <button id="like-btn" class="btn {{ $lastLike ? 'btn-success' : 'btn-primary' }}"
                                aria-pressed="{{ $lastLike ? 'true' : 'false' }}">
                                {{ $lastLike ? '👍 Liked' : '👍 Like' }}
                            </button>

                            <label class="mb-0">Rate this:</label>
                            <div id="star-rating" style="cursor:pointer; font-size: 1.5rem;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span
                                        class="star {{ $lastRating && $lastRating->rating_value >= $i ? 'star-filled' : '' }}"
                                        data-value="{{ $i }}">&#9733;</span>
                                @endfor
                            </div>
                        </div>

                        @if ($lastRating)
                            <p class="text-muted mt-2" style="font-size: 0.9rem;">
                                Last rated: {{ $lastRating->created_at->diffForHumans() }}
                                ({{ $lastRating->rating_value }} ★)
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hangout-gallery-box position-relative p-3">
                        <div class="thumbnail-bg mb-3"
                            style="background-image: url('{{ asset('storage/' . $hangout->thumbnail) }}'); 
                                background-size: cover; 
                                background-position: center; 
                                height: 250px; 
                                border-radius: 12px;
                            ">
                        </div>
                        @if ($hangout->images->count())
                            <div class="swiper hangoutSwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($hangout->images as $image)
                                        <div class="swiper-slide">
                                            <a href="{{ asset('storage/' . $image->image_path) }}"
                                                data-lightbox="hangout-gallery">
                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                    alt="{{ $hangout->name }}" class="img-fluid rounded" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Navigation buttons -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                                <!-- Pagination dots -->
                                <div class="swiper-pagination"></div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="blog-details1-all">
        <div class="container">
            <h4 class="mb-3">🔥 Populer Minggu Ini</h4>
            <div class="row">
                @foreach ($mostLiked as $popularHangout)
                    @include('home.partials.hangout_card', ['hangout' => $popularHangout])
                @endforeach
            </div>
        </div>
    </div>

    @if ($nearestHangouts->count())
        <div class="blog-details1-all mt-5">
            <div class="container">
                <h4 class="mb-3">📍 Terdekat Dari Lokasi Anda</h4>
                <div class="row">
                    @foreach ($nearestHangouts as $nearbyHangout)
                        @include('home.partials.hangout_card', ['hangout' => $nearbyHangout])
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        navigator.geolocation.getCurrentPosition(function(position) {
            fetch('{{ route('home.store_location') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                })
            });
        });
    </script>

    <script>
        new Swiper(".hangoutSwiper", {
            loop: true,
            spaceBetween: 20,
            slidesPerView: 3,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>


    <script>
        const stars = document.querySelectorAll('#star-rating .star');
        const starRatingDiv = document.getElementById('star-rating');
        let currentRating = {{ $lastRating ? $lastRating->rating_value : 0 }};

        function setStars(rating) {
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'));
                if (value <= rating) {
                    star.classList.add('star-filled');
                } else {
                    star.classList.remove('star-filled');
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                currentRating = value;
                setStars(currentRating);
                sendInteraction('rating', value);
            });

            star.addEventListener('mouseover', () => {
                const hoverValue = parseInt(star.getAttribute('data-value'));
                starRatingDiv.classList.add('hover-active');
                stars.forEach(st => {
                    const val = parseInt(st.getAttribute('data-value'));
                    st.classList.toggle('hovered', val <= hoverValue);
                });
            });

            star.addEventListener('mouseout', () => {
                starRatingDiv.classList.remove('hover-active');
                stars.forEach(st => st.classList.remove('hovered'));
                setStars(currentRating);
            });
        });

        setStars(currentRating);

        async function sendInteraction(type, ratingValue = null) {
            const slug = "{{ $hangout->slug }}";
            const data = {
                interaction_type: type
            };

            if (type === 'rating' && ratingValue !== null) {
                data.rating_value = ratingValue;
            }

            try {
                const response = await fetch(`/directories/${slug}/interact`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {
                    const resJson = await response.json();
                    Swal.fire({
                        icon: 'success',
                        title: type === 'rating' ? 'Terima kasih atas rating Anda!' : 'Berhasil!',
                        text: resJson.message || 'Interaksi berhasil dikirim.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error('Gagal melakukan interaksi. Silakan coba lagi.');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: error.message || 'Gagal mengirim interaksi.',
                });
            }
        }

        document.getElementById('like-btn')?.addEventListener('click', () => sendInteraction('like'));
        document.getElementById('rating-select')?.addEventListener('change', (e) => {
            const value = e.target.value;
            if (value) {
                sendInteraction('rating', parseInt(value));
            }
        });
    </script>

@endsection
