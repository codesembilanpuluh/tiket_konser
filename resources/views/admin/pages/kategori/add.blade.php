@extends('admin.layout')
@section('title', '. : Kategori : .')
    
   
@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
                <h3 class="card-title"><i class='fa fa-folder-open'></i> Tambah Data Kategori</h3>
				</div>
			<div class="card-body">

                <form class="form-horizontal" id="data_form">
					@csrf

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Kategori <small>*</small></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Harga <small>*</small></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="harga" id="harga" placeholder="Harga">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2"></label>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check-square"></i> Simpan</button> 
							<a href="{{asset('admin/kategori')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i>&nbsp; Batal</a>
						</div>
					</div>

				</form>

            </div>

        </div>
    </div>

</section>
@endsection



@section("custom_js")
<script>
	$('#data_form').on('submit', function(event) {
		event.preventDefault();
		idata = new FormData($('#data_form')[0]);

		$.ajax({
			type	: "POST",
			dataType: "json",
			url		: "{{asset('admin/kategori/create')}}",
			data	: idata,
			processData: false,
			contentType: false,
			cache 	: false,
			beforeSend: function () { 
				in_load();
			},
			success	:function(data) {
				swal(''+data.status+'',''+data.message+'',"success").then((value) => { window.location.href = "{{ asset('admin/kategori') }}"; });
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