@extends('admin.layout')
@section('title', '. : Tiket : .')

@section('content')

<section class="content">

	<div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class='fa fa-folder-open'></i> Check In Tiket</h3>
                    </div>
                    
        
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">TIKET ID <small>*</small></label>
                            <div class="col-sm-12">
                                <div class='input-group'>
                                    <input type='text' class='form-control' id="tiket_id" name="tiket_id" placeholder='TIKET ID' />
                                    <span class='input-group-btn'><button class='btn btn-success btn-choose' onclick="check_tiket()" type='button'><i class='fa fa-search'></i></button></span>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
            <div class="col-12 col-lg-9 col-md-6 col-sm-12">
                <div id="callback"></div>
            </div>
        </div>

		
    </div>

</section>

@endsection

@section('custom_js')
<script>
    function check_tiket() {
        var callback = $("#callback");
        var tiket_id = $("#tiket_id").val();
        $.ajax({
			type	: "GET",
			dataType: "json",
			url		: "{{asset('admin/tiket/check-tiket')}}/"+tiket_id,
			processData: false,
			contentType: false,
			cache 	: false,
			beforeSend: function () { 
				in_load();
			},
			success	:function(data) {
                callback.html("");
                if(data.data!==null) {
                    if(data.data.status=='1') {
                        callback.append("<div class='row'>"
                            +"<div class='col-sm-12 col-md-12'>"
                                +"<div class='callout callout-warning bg-warning'>"
                                    +"<h4>WARNING</h4><p>Tiket ID telah Check IN </p>"
                                +"</div>"
                            +"</div>"
                        +"</div>");
                    } else {
                        callback.append("<h3>TIKET ID : "+data.data.tiket_id+"</h3>"
                        +"<div class='row'>"
                            +"<div class='col-sm-6'>"
                                +"<h6>"+data.data.kategori+"</h6>"
                            +"</div>"
                            +"<div class='col-sm-6'>"
                                +"<h6 style='text-align: right;'>Rp. "+conver_rupiah(data.data.harga)+"</h6>"
                            +"</div>"
                        +"</div>"
                        +"<table class='table table-striped'>"
                            +"<tr>"
                                +"<td width='15%'>Nama Lengkap</td>"
                                +"<td width='1px'>:</td>"
                                +"<td>"+data.data.nm_lengkap+"</td>"
                                +"<td width='15%'>No Hp</td>"
                                +"<td width='1px'>:</td>"
                                +"<td>"+data.data.no_hp+"</td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>Email</td>"
                                +"<td>:</td>"
                                +"<td>"+data.data.email+"</td>"
                                +"<td>Alamat</td>"
                                +"<td>:</td>"
                                +"<td>"+data.data.alamat+"</td>"
                            +"</tr>"
                        +"</table>"
                        +"<button type='button' onclick='check_in("+data.data.tiket_id+")' class='btn btn-sm btn-info'><i class='fa fa-check-square'></i> Check IN</button> ");
                    }
                    
                } else {
                    callback.append("<div class='row'>"
                        +"<div class='col-sm-12 col-md-12'>"
                            +"<div class='callout callout-danger bg-danger'>"
                                +"<h4>ERROR</h4><p>Tiket ID tidak ditemukan </p>"
                            +"</div>"
                        +"</div>"
                    +"</div>");
                }
				out_load();
			},
			error: function (error) {
				error_detail(error);
				out_load();
			}
		});
    }

    function check_in(tiket_id) {
        $.ajax({
			type	: "POST",
			dataType: "json",
			url		: "{{asset('admin/tiket/check-in')}}/"+tiket_id,
            data	: "_method=PUT&_token="+tokenCSRF,
			beforeSend: function () { 
				in_load();
			},
			success	:function(data) {
				swal(''+data.status+'',''+data.message+'',"success").then((value) => { 
                    window.location.reload(); 
                });
				out_load();
			},
			error: function (error) {
				error_detail(error);
				out_load();
			}
		});
    }
</script>
@endsection