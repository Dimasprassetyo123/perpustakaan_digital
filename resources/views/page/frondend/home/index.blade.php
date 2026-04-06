@extends('partials.frontend.app')
@section('content')
    <section id="home">

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>

                    <div class="main-slider pattern-overlay">
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Life of the Wild</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
                                    ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
                                    urna, a eu.</p>
                            </div><!--banner-content-->
                            <img src="{{ asset('assetsfrontend/images/main-banner1.jpg') }}" alt="banner"
                                class="banner-image">
                        </div><!--slider-item-->

                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Birds gonna be Happy</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
                                    ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
                                    urna, a eu.</p>
                                <div class="btn-wrap">
                                    <a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                            class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="{{ asset('assetsfrontend/images/main-banner2.jpg') }}" alt="banner"
                                class="banner-image">
                        </div><!--slider-item-->

                    </div><!--slider-->
                </div>
            </div>
        </div>

    </section>

    <section id="client-holder" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="logo-wrap">
                        <div class="grid">
                            <a href="#"><img src="{{ asset('assetsfrontend/images/client-image1.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('assetsfrontend/images/client-image2.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('assetsfrontend/images/client-image3.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('assetsfrontend/images/client-image4.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('assetsfrontend/images/client-image5.png') }}"
                                    alt="client"></a>
                        </div>
                    </div><!--image-holder-->
                </div>
            </div>
        </div>
    </section>

    <!---Semua buku-->
    <section id="popular-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">All Books</h2>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-8 mx-auto">

                            <div class="input-group input-group-lg shadow rounded-pill overflow-hidden">
                                <span class="input-group-text bg-white border-0">
                                    🔍
                                </span>

                                <input type="text" id="searchBuku" class="form-control border-0"
                                    placeholder="Cari judul buku..." style="box-shadow:none;">

                            </div>

                        </div>
                    </div>

                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">All Books</li>

                        @foreach ($buku->pluck('kategori')->unique() as $kat)
                            <li data-tab-target="#{{ Str::slug($kat) }}" class="tab">
                                {{ $kat }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">

                        <div id="all-genre" data-tab-content class="active">
                            <div class="row">

                                @forelse ($buku as $item)
                                    <!-- 🔥 INI YANG DIUBAH -->
                                    <div class="col-md-3 buku-item" data-judul="{{ strtolower($item->judul_buku) }}">
                                        <div class="product-item">
                                            <figure class="product-style">

                                                @if ($item->cover)
                                                    <img src="{{ asset('storage/' . $item->cover) }}" alt="Books"
                                                        class="product-item">
                                                @else
                                                    <img src="https://via.placeholder.com/300x400" alt="Books"
                                                        class="product-item">
                                                @endif

                                                <button type="button" class="add-to-cart">
                                                    <a href="{{ route('buku.detail', $item->id_buku) }}"
                                                        class="add-to-cart">
                                                        Detail
                                                    </a>
                                                </button>

                                            </figure>

                                            <figcaption>
                                                <h3>{{ $item->judul_buku }}</h3>
                                                <span>{{ $item->penulis }}</span>

                                                <div class="item-price">
                                                    <a href="#"
                                                        class="btn btn-primary btn-sm rounded-pill w-100 d-flex align-items-center justify-content-center gap-2">
                                                        📖 Pinjam
                                                    </a>
                                                </div>
                                            </figcaption>

                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12 text-center">
                                        <h5>Tidak ada data buku</h5>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                        @foreach ($buku->pluck('kategori')->unique() as $kat)
                            <div id="{{ Str::slug($kat) }}" data-tab-content>
                                <div class="row">

                                    @foreach ($buku->where('kategori', $kat) as $item)
                                        <!-- 🔥 INI JUGA DIUBAH -->
                                        <div class="col-md-3 buku-item" data-judul="{{ strtolower($item->judul_buku) }}">
                                            <div class="product-item">
                                                <figure class="product-style">

                                                    @if ($item->cover)
                                                        <img src="{{ asset('storage/' . $item->cover) }}"
                                                            class="product-item">
                                                    @else
                                                        <img src="https://via.placeholder.com/300x400"
                                                            class="product-item">
                                                    @endif

                                                    <button class="add-to-cart">Detail</button>

                                                </figure>

                                                <figcaption>
                                                    <h3>{{ $item->judul_buku }}</h3>
                                                    <span>{{ $item->penulis }}</span>

                                                    <div class="item-price">
                                                        <a href="#"
                                                            class="btn btn-primary btn-sm rounded-pill w-100 d-flex align-items-center justify-content-center gap-2">
                                                            📖 Pinjam
                                                        </a>
                                                    </div>
                                                </figcaption>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Populer Buku-->
    <section id="special-offer" class="bookshelf pb-5 mb-5">

        <div class="section-header align-center">
            <div class="title">
                <span>Grab your opportunity</span>
            </div>
            <h2 class="section-title">Books Populer</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="product-list" data-aos="fade-up">
                        <div class="grid product-grid">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="{{ asset('assetsfrontend/images/product-item5.jpg') }}" alt="Books"
                                        class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Simple way of piece life</h3>
                                    <span>Armor Ramsey</span>
                                    <div class="item-price">
                                        <span class="prev-price">$ 50.00</span>$ 40.00
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="{{ asset('assetsfrontend/images/product-item6.jpg') }}" alt="Books"
                                        class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Great travel at desert</h3>
                                    <span>Sanchit Howdy</span>
                                    <div class="item-price">
                                        <span class="prev-price">$ 30.00</span>$ 38.00
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="{{ asset('assetsfrontend/images/product-item7.jpg') }}" alt="Books"
                                        class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>The lady beauty Scarlett</h3>
                                    <span>Arthur Doyle</span>
                                    <div class="item-price">
                                        <span class="prev-price">$ 35.00</span>$ 45.00
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="{{ asset('assetsfrontend/images/product-item8.jpg') }}" alt="Books"
                                        class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Once upon a time</h3>
                                    <span>Klien Marry</span>
                                    <div class="item-price">
                                        <span class="prev-price">$ 25.00</span>$ 35.00
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="{{ asset('assetsfrontend/images/product-item2.jpg') }}" alt="Books"
                                        class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Simple way of piece life</h3>
                                    <span>Armor Ramsey</span>
                                    <div class="item-price">$ 40.00</div>
                                </figcaption>
                            </div>
                        </div><!--grid-->
                    </div>
                </div><!--inner-content-->
            </div>
        </div>
    </section>
@endsection
