@extends('admin.layout')
@section('title', '. : User : .')
    
   
@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
                <h3 class="card-title"><i class='fa fa-folder-open'></i> Ubah Data User</h3>
				</div>
			<div class="card-body">

                <form class="form-horizontal" id="data_form">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Lengkap <small>*</small></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nm_lengkap" id="nm_lengkap" value="{{$result->nm_lengkap}}" placeholder="Nama Lengkap">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Username <small>*</small></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" id="username" value="{{$result->username}}" placeholder="Username">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Password <small>*</small></label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2"></label>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check-square"></i> Simpan</button> 
							<a href="{{asset('admin/user')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i>&nbsp; Batal</a>
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
			url		: "{{asset('admin/user/'.$result->id)}}",
			data	: idata,
			processData: false,
			contentType: false,
			cache 	: false,
			beforeSend: function () { 
				in_load();
			},
			success	:function(data) {
				swal(''+data.status+'',''+data.message+'',"success").then((value) => { window.location.href = "{{ asset('admin/user') }}"; });
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