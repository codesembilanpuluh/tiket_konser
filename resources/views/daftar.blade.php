@extends("layout")

@section('content')
<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Pesan</h2>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title">
                        <h2>Daftarkan diri anda segera</h2>
                        <p>Silahkan melakukan pendaftaran dengan cara mengisi data diri dan kategori tiket pada form isian</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form id="data_form" class="mt-4">
                        @csrf

                        <div class="form-group">
                            <select class="form-control" name="kategori_id" id="kategori_id">
                                <option value="">. : Pilih Kategori Tiket : .</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{$kategori->id}}">{{ $kategori->kategori }} - {{ $kategori->harga }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="text"  class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Hp"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nm_lengkap" id="nm_lengkap" placeholder="Nama Lengkap" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                        </div>

                        <div class="text-center"><button type="submit" class="btn btn-info">Pesan Sekarang</button></div>

                    </form>
                </div>
            </div>

        </div>
    </section>
</main>

@endsection


@section("custom_js")
<script>
    function out_load() {
        $('.preload-wrapper').hide();
    }
    function in_load() {
        $('.preload-wrapper').show();
    }

    function error_detail(error) {
        console.log(error);
        if(error.status=="500") {
            if(error.responseJSON.message) {
                swal(''+error.status+'',''+error.responseJSON.message+'','error');
                return false;
            } else {	
                response = error.responseJSON.message?error.responseJSON.message:error.statusText;
                swal(''+error.status+'',''+response+'','error');
                return false;
            }
        } else if(error.responseJSON.status=="warning") {
            swal('Warning',''+error.responseJSON.message+'','warning');
            return false;

        } else if(error.responseJSON.status=="error") {
            swal('Error',''+error.responseJSON.message+'','error');
            return false;
        }
    }

	$('#data_form').on('submit', function(event) {
		event.preventDefault();
		idata = new FormData($('#data_form')[0]);

		$.ajax({
			type	: "POST",
			dataType: "json",
			url		: "{{asset('pesan')}}",
			data	: idata,
			processData: false,
			contentType: false,
			cache 	: false,
			beforeSend: function () { 
				in_load();
			},
			success	:function(data) {
				swal(''+data.status+'',''+data.message+'',"success").then((value) => { 
                    window.open("{{asset('print-tiket/')}}/"+data.data.tiket_id, '_blank');
                    window.location.href = "{{ asset('/') }}"; });
				out_load();
			},
			error: function (error) {
				error_detail(error);
				out_load();
			}
		});
	});
</script>
@endsection