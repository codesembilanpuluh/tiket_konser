@extends("layout")

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <h1>Tiket Konser</h1>
            <h2>Jangan sampai ketinggalan</h2>
            <a href="{{asset('daftar')}}" class="btn-get-started scrollto">Daftar Sekarang</a>
        </div>
    </section>
@endsection