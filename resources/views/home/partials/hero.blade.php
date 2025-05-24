<div class="hero2 bg-cover" style="background-image: url(/template/frontend/img/bg/hero2-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="main-heading2">
                    <h1 class="text-anime-style-3">Hangout Seru di Purwokerto</h1>
                    <p class="mt-16" data-aos="fade-right" data-aos-duration="400" data-aos-delay="100">
                        Temukan tempat nongkrong terbaik di Purwokerto—mulai dari kafe kekinian, spot outdoor yang cozy,
                        hingga tempat hits buat ngumpul bareng teman atau keluarga.
                        Suasana asik dan vibes lokal yang hangat menanti kamu di setiap sudut kota.
                    </p>
                    <div class="form-area" data-aos="fade-right" data-aos-duration="400" data-aos-delay="300">
                        <form action="{{ route('home.directories') }}" method="GET">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." />
                            <div class="button">
                                <button class="theme-btn2" type="submit">Temukan Tempatnya</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="images-all">
                    <div class="image1 image-anime reveal">
                        <img src="https://img2.storyblok.com/1600x800/filters:focal(1236x530:1237x531):quality(90)/f/86150/1600x900/abcd73ae35/purwokerto-1.jpg"
                            alt="Tempat Hangout Purwokerto" />
                    </div>
                    <div class="shape animate2">
                        <img src="{{ asset('template/frontend/img/shapes/hero2-shape.png') }}" alt="vexon" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
