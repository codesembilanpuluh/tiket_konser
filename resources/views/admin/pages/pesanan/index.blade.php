@extends('admin.layout')
@section('title', '. : Pesanan : .')

@section('content')

<section class="content">

	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
                <h3 class="card-title"><i class='fa fa-folder-open'></i> Detail Data Pesanan</h3>
            </div>
			
            <table class="table table-bordered table-striped dt-responsive table-xs" id="DTable">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Tiket ID</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>

</section>

@endsection

@section('custom_js')
<script>
    $(document).ready(function() {	
        $('#DTable').DataTable({
            "serverSide": true,
            "ajax": {
                "url"       : "{{ asset('admin/pesanan') }}",
                "type"      : "get",
            },
            
            "columns": [
                { "data": "DT_RowIndex","width": "5%","sClass": "text-center","orderable": false, 'searchable':false },
                { "data": "nm_lengkap"},
                { "data": "no_hp"},
                { "data": "email"},
                { "data": "alamat"},
                { "data": "tiket_id"},
                { "data": "kategori", "name": "kategoris.kategori"},
                { "data": "harga", "name": "kategoris.harga"},
                { "data": "act","width": "1%","sClass":"text-center","orderable": false, 'searchable':false } 
            ],
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                {
                    text: '<i class="fa fa-file-excel"></i> Export',
                    className: 'btn bg-success btn-sm',
                    action: function () {
                        form_export();
                    }
                }, 
            ],
            "order": []
        });
    });

    function form_export(id) {
        $("#modal-title").html('<i class="fa fa-bars"></i>&nbsp; Export Excel');
        $("#modal-body").html("<form id='form_export'>" 
            +"<div class='form-group row'>"
                +"<div class='col-lg-12'><select class='form-control' name='status' id='status'><option value=''>. : Semua Status : .</option><option value='0'>Belum Check IN</option><option value='1'>Check IN</option></select></div>"
            +"</div>"
        +"</form>");

        $("#modal-footer").html("<button type='button' class='btn bg-danger btn-sm' data-dismiss='modal'><b><i class='fa fa-times'></i></b> Close</button> <button type='button' onclick='submit_export()' class='btn bg-success btn-sm'><b><i class='fa fa-file-excel'></i></b> Export</button>");
        $("#modal-detail").modal('show');     
    }

    function submit_export() {
        var status = $("#status").val();
        window.open("{{asset('admin/pesanan/export-excel')}}?status="+status, '_blank');
    }

    
    function delete_data(id) {
        swal({
            title 	: 'Konfirmasi Hapus!',
            text  	: "apakah anda yakin ingin menghapus data",
            icon 	: 'warning',
            buttons : {
                cancel: "Batal",
                confirm: "Ya, Hapus!",
            },
            dangerMode: true
        }).then((deleteFile) => {
            if (deleteFile) {
                $.ajax({
                    type	: "POST",
                    dataType: "json",
                    url		: "{{ asset('admin/pesanan') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(result) {
                        window.location.reload();
                    }
                });
            }
        });
    }

</script>
@endsection