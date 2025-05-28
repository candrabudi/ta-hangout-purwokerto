<div class="col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-offset="50" data-aos-duration="400" data-aos-delay="100">
    <div class="blog1-single-box">
        <div class="thumbnail image-anime">
            <img src="{{ asset('storage/' . $hangout->thumbnail) }}" alt="{{ $hangout->name }}" />
        </div>
        <div class="heading1">
            <div class="social-area">
                <a href="{{ route('home.directories.show', $hangout->slug) }}" class="social">Hangout Spot</a>
                <a href="#" class="time">
                    <img src="{{ asset('template/frontend/img/icons/time1.svg') }}" alt="time" />
                    {{ \Carbon\Carbon::parse($hangout->created_at)->translatedFormat('d F Y') }}
                </a>
            </div>
            <h4>
                <a href="{{ route('home.directories.show', $hangout->slug) }}">{{ $hangout->name }}</a>
            </h4>
            <p class="mt-16">{{ Str::limit($hangout->description, 100) }}</p>
            <div class="author-area">
                <div class="author">
                    <div class="author-tumb">
                        <img src="https://cdn-icons-png.flaticon.com/128/18390/18390769.png" alt="author" width="16" />
                    </div>
                    <a href="#" class="author-text">{{ $hangout->address }}</a>
                </div>
                <div class="date">
                    <a href="{{ $hangout->google_maps_url }}" target="_blank">
                        <img src="https://cdn-icons-png.flaticon.com/128/684/684908.png" width="16" alt="map" /> Map
                    </a>
                </div>
            </div>
            @if(isset($hangout->distance_km))
                <div class="distance mt-2 text-muted" style="font-size: 0.875rem;">
                    📍 {{ $hangout->distance_km }} km dari Anda
                </div>
            @endif
        </div>
    </div>
</div>
