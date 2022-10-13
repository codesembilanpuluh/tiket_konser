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

function angka(objek) {
	a = objek.value;
	b = a.replace(/[^\d]/g,"");
	objek.value = b;
}

function rupiah(objek) {
	separator = ".";
	a = objek.value;
	b = a.replace(/[^\d]/g,"");
	c = "";
	panjang = b.length; 
	j = 0; 
	for (i = panjang; i > 0; i--) {
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)) {
				c = b.substr(i-1,1) + separator + c;
		} else {
				c = b.substr(i-1,1) + c;
		}
	}
	objek.value = c;
}


function conver_rupiah(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

$.extend( $.fn.dataTable.defaults, {
		autoWidth: false,
		responsive: true,
		processing: true,
		language: {
			search: '_INPUT_',
		searchPlaceholder: 'Cari Data',
		lengthMenu: '_MENU_',
		paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
	},
});
