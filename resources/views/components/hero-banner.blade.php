@php
    $hasSlides = isset($sliders) && $sliders->count() > 0;
@endphp

<section class="hero-section">

@if($hasSlides)

<div id="heroBannerCarousel"
    class="carousel slide"
    data-bs-ride="carousel"
    data-bs-interval="5000">

    <div class="carousel-inner">

        @foreach($sliders as $index => $slider)

        <div class="carousel-item {{ $index==0 ? 'active' : '' }}">

            <div class="hero-slide">

                <img src="{{ $slider->image_url }}"
                    class="hero-image"
                    alt="{{ $slider->title }}">

                <div class="hero-overlay"></div>

                <div class="hero-content">

                    <span class="hero-top">
                        Berilmu, Berakhlak, Berprestasi
                    </span>

                    <h1>
                        Membentuk Generasi <br>
                        Berkarakter Qur’ani
                    </h1>

                    <p>
                        MA Miftahul Midad berkomitmen mencetak generasi muslim
                        yang unggul dalam ilmu pengetahuan, berakhlak mulia,
                        dan siap mengabdi untuk umat dan bangsa.
                    </p>

                    <div class="hero-buttons">

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @if($sliders->count()>1)

    <button class="carousel-control-prev"
        type="button"
        data-bs-target="#heroBannerCarousel"
        data-bs-slide="prev">

        <div class="hero-arrow">
            <i class="bi bi-chevron-left"></i>
        </div>

    </button>

    <button class="carousel-control-next"
        type="button"
        data-bs-target="#heroBannerCarousel"
        data-bs-slide="next">

        <div class="hero-arrow">
            <i class="bi bi-chevron-right"></i>
        </div>

    </button>

    @endif

</div>

@else

<div class="hero-slide">

    <img src="https://picsum.photos/1600/900"
        class="hero-image">

    <div class="hero-overlay"></div>

</div>

@endif


<div class="hero-feature-wrapper">

<div class="container">

<div class="row g-0 feature-box">

<div class="col-lg-3">

<div class="feature-item">

<div class="feature-icon">
<i class="bi bi-book"></i>
</div>

<div>

<h5>Pendidikan Berkualitas</h5>

<p>
Kurikulum terpadu yang mengembangkan potensi akademik dan spiritual.
</p>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="feature-item">

<div class="feature-icon">
<i class="bi bi-people"></i>
</div>

<div>

<h5>Pembinaan Karakter</h5>

<p>
Pembiasaan akhlak mulia dan nilai Islami dalam kehidupan sehari hari.
</p>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="feature-item">

<div class="feature-icon">
<i class="bi bi-trophy"></i>
</div>

<div>

<h5>Prestasi Unggul</h5>

<p>
Mendorong prestasi akademik maupun non akademik.
</p>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="feature-item">

<div class="feature-icon">
<i class="bi bi-house-heart"></i>
</div>

<div>

<h5>Lingkungan Islami</h5>

<p>
Suasana pondok yang nyaman, aman dan religius.
</p>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

<style>:root{
    --primary:#03A6A0;
    --primary-hover:#028F8A;
    --primary-dark:#027A76;
    --primary-light:#EAF8F7;
}

/* ===========================
   HERO SECTION
=========================== */

.hero-section{
    position:relative;
    overflow:visible;
    margin-bottom:90px;
}

.hero-slide{
    position:relative;
    height:650px;
}

.hero-image{
    width:100%;
    height:650px;
    object-fit:cover;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        90deg,
        rgba(0,0,0,.65) 0%,
        rgba(0,0,0,.45) 40%,
        rgba(0,0,0,.15) 70%,
        rgba(0,0,0,.05) 100%
    );
}

/* ===========================
   HERO CONTENT
=========================== */

.hero-content{
    position:absolute;
    top:95px;
    left:8%;
    width:520px;
    z-index:10;
    color:#fff;
}

.hero-top{
    display:inline-block;
    margin-bottom:18px;
    color:#ffd86b;
    font-size:15px;
    font-weight:700;
    letter-spacing:.5px;
}

.hero-content h1{
    font-family:"Playfair Display",serif;
    font-size:64px;
    line-height:1.08;
    font-weight:700;
    margin-bottom:24px;
    color:#fff;
}

.hero-content p{
    width:470px;
    font-size:17px;
    line-height:1.8;
    color:rgba(255,255,255,.88);
    margin-bottom:30px;
}

/* ===========================
   BUTTON
=========================== */

.hero-buttons{
    display:flex;
    gap:15px;
}

.hero-buttons .btn{
    border-radius:8px;
    padding:13px 26px;
    font-size:15px;
    font-weight:600;
    transition:.3s;
}

.hero-buttons .btn-success{
    background:var(--primary);
    border-color:var(--primary);
    color:#fff;
}

.hero-buttons .btn-success:hover{
    background:var(--primary-hover);
    border-color:var(--primary-hover);
}

.hero-buttons .btn-outline-light{
    border:2px solid rgba(255,255,255,.9);
    color:#fff;
}

.hero-buttons .btn-outline-light:hover{
    background:#fff;
    color:var(--primary-dark);
}

/* ===========================
   CAROUSEL
=========================== */

.carousel-control-prev,
.carousel-control-next{
    width:7%;
}

.carousel-control-prev{
    justify-content:flex-start;
    padding-left:30px;
}

.carousel-control-next{
    justify-content:flex-end;
    padding-right:30px;
}

.hero-arrow{
    width:52px;
    height:52px;
    border-radius:50%;
    background:rgba(255,255,255,.18);
    backdrop-filter:blur(6px);
    display:flex;
    justify-content:center;
    align-items:center;
    color:#fff;
    font-size:20px;
    transition:.3s;
}

.hero-arrow:hover{
    background:var(--primary);
}

/* ===========================
   FEATURE BOX
=========================== */

.hero-feature-wrapper{
    position:absolute;
    left:0;
    right:0;
    bottom:-60px;
    z-index:30;
}

.hero-feature-wrapper .container{
    max-width:1280px;
}

.feature-box{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 15px 45px rgba(0,0,0,.12);
}

.feature-item{
    display:flex;
    gap:18px;
    align-items:flex-start;
    padding:26px;
    transition:.3s;
}

.feature-item:hover{
    background:#fafafa;
}

.feature-icon{
    width:58px;
    height:58px;
    min-width:58px;
    border-radius:50%;
    background:var(--primary);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    transition:.3s;
}

.feature-item:hover .feature-icon{
    background:var(--primary-hover);
}

.feature-item h5{
    font-size:19px;
    font-weight:700;
    color:#222;
    margin-bottom:8px;
}

.feature-item p{
    font-size:14px;
    color:#666;
    line-height:1.8;
    margin:0;
}

/* ===========================
   UTILITY
=========================== */

.bg-primary{
    background:var(--primary)!important;
}

.text-primary{
    color:var(--primary)!important;
}

.border-primary{
    border-color:var(--primary)!important;
}

/* ===========================
   MOBILE
=========================== */

@media(max-width:992px){

.hero-slide,
.hero-image{
    height:560px;
}

.hero-content{
    top:70px;
    left:25px;
    right:25px;
    width:auto;
}

.hero-content h1{
    font-size:42px;
}

.hero-content p{
    width:100%;
    font-size:15px;
}

.hero-buttons{
    flex-direction:column;
}

.hero-buttons .btn{
    width:100%;
}

.hero-feature-wrapper{
    position:relative;
    bottom:auto;
    margin-top:-40px;
    padding:0 15px;
}

.feature-item{
    padding:22px;
}

}

@media(min-width:1400px){

.hero-slide,
.hero-image{
    height:700px;
}

.hero-content{
    top:110px;
}

.hero-content h1{
    font-size:70px;
}

}</style>
