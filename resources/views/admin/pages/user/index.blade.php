@extends('admin.layout')
@section('title', '. : User : .')

@section('content')

<section class="content">

	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
                <h3 class="card-title"><i class='fa fa-folder-open'></i> Detail Data User</h3>
            </div>
			
            <table class="table table-bordered table-striped dt-responsive table-xs" id="DTable">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
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
                "url"       : "{{ asset('admin/user') }}",
                "type"      : "get",
            },
            
            "columns": [
                { "data": "DT_RowIndex","width": "5%","sClass": "text-center","orderable": false, 'searchable':false },
                { "data": "username"},
                { "data": "nm_lengkap"},
                { "data": "act","width": "10%","sClass":"text-center","orderable": false, 'searchable':false } 
            ],
            
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                {
                    text: '<i class="fa fa-plus-square"></i> Tambah',
                    className: 'btn bg-success btn-sm',
                    action: function () {
                        window.location.href = "{{asset('admin/user/add')}}";
                    }
                }, 
            ],
            "order": []
        });
    });

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
                    url		: "{{ asset('admin/user') }}/"+id,
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