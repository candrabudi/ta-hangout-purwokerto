@extends('template.app')
@section('title', 'Beranda')
@section('user-content')
    @include('home.partials.hero')
    <style>
        .img-fixed {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
        }

        .square-thumb {
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 8px;
        }

        .square-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
    </style>

    <div class="blog2-boxs-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    @foreach ($newPlace as $place)
                        <div class="blog2-single-box {{ !$loop->first ? 'mt-40' : '' }}">
                            <div class="row align-items-center">
                                @if ($loop->iteration % 2 != 0)
                                    {{-- Image kiri, Text kanan --}}
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                        <div class="image _relative image-anime mr-30">
                                            <img src="{{ asset('/storage/' . $place->thumbnail ?? 'default.jpg') }}"
                                                alt="{{ $place->name }}" class="img-fixed" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                                        <div class="blog2-box-content md:mt-30 sm:mt-30">
                                            <div class="author-area2">
                                                <a href="#"><img src="/template/frontend/img/icons/date1.svg"
                                                        alt="vexon" />
                                                    {{ \Carbon\Carbon::parse($place->created_at)->translatedFormat('d F Y') }}
                                                </a>
                                            </div>
                                            <div class="heading2">
                                                <h4><a href="#">{{ $place->name }}</a></h4>
                                                <p class="mt-16">
                                                    {{ \Illuminate\Support\Str::limit($place->description, 150) }}</p>
                                                <a href="{{ route('home.directories.show', $place->slug) }}" target="_blank" class="learn">
                                                    Lihat Tempat Nongkrong <span><i
                                                            class="fa-regular fa-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Text kiri, Image kanan --}}
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                                        <div class="blog2-box-content">
                                            <div class="author-area2">
                                                <a href="#"><img src="/template/frontend/img/icons/date1.svg"
                                                        alt="vexon" />
                                                    {{ \Carbon\Carbon::parse($place->created_at)->translatedFormat('d F Y') }}
                                                </a>
                                            </div>
                                            <div class="heading2">
                                                <h4><a href="#">{{ $place->name }}</a></h4>
                                                <p class="mt-16">
                                                    {{ \Illuminate\Support\Str::limit($place->description, 150) }}</p>
                                                <a href="{{ route('home.directories.show', $place->slug) }}" target="_blank" class="learn">
                                                    Lihat Tempat Nongkrong <span><i
                                                            class="fa-regular fa-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                        <div class="image _relative image-anime mr-30 sm:mr-0 md:mr-0 sm:mt-30 md:mt-30">
                                            <img src="{{ asset('/storage/' . $place->thumbnail ?? 'default.jpg') }}"
                                                alt="{{ $place->name }}" class="img-fixed" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>



    <div class="blog4-all sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog4-boxs-all">
                        <h5 class="pb-10">Tempat Nongkrong Lainnya</h5>

                        @foreach ($otherPlaces as $place)
                            <div class="aos-init aos-animate" data-aos="fade-up" data-aos-duration="400"
                                data-aos-delay="100">
                                <div class="blog4-single-box mt-30">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <div class="image image-anime _relative square-thumb">
                                                <img src="{{ asset('/storage/' . $place->thumbnail ?? 'default.jpg') }}"
                                                    alt="{{ $place->name }}">
                                            </div>

                                        </div>
                                        <div class="col-lg-8">
                                            <div class="content-area">
                                                <div class="author-area3">
                                                    <a href="#">
                                                        <img src="{{ asset('template/frontend/img/icons/date1.svg') }}"
                                                            alt="vexon">
                                                        {{ \Carbon\Carbon::parse($place->created_at)->translatedFormat('d F Y') }}
                                                    </a>
                                                </div>
                                                <div class="heading4">
                                                    <h4>
                                                        <a href="#">
                                                            {{ $place->name }}
                                                        </a>
                                                    </h4>
                                                     <p style="font-size: 16px; font-weight: normal;">
                                                    {{ \Illuminate\Support\Str::limit($place->description, 150) }}</p>
                                                    <a href="{{ route('home.directories.show', $place->slug) }}" class="learn" target="_blank">
                                                        Lihat Tempat Nongkrong
                                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="space60"></div>
                    <div class="row">
                        <div class="col-12 text-center aos-init" data-aos="fade-up" data-aos-delay="100"
                            data-aos-duration="400">
                            <a href="{{ route('home.directories') }}" class="btn btn-primary px-4 py-2" id="loadMore">
                                Lihat Lebih Banyak
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="blog4-sidebar-area mt-70 ml-30 sm:ml-0 md:ml-0 md:mt-30 sm:mt-30">
                        <div class="sidebar-widget_2 mt-40">
                            <h3>Lokasi Populer di Purwokerto</h3>
                            <div class="row">
                                @foreach ($locations as $location)
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ route('home.directories', ['location_id' => $location->id]) }}">{{ $location->name }}</p>
                                            </div>
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
@endsection
