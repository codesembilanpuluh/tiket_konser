<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table width="100%" border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Tiket ID</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
        </tr>
        @php
            $no=1;
        @endphp
        @foreach ($result as $item)
            <tr>
                <td>{{$no}}</td>
                <td>{{$item['nm_lengkap']}}</td>
                <td>{{$item['no_hp']}}</td>
                <td>{{$item['email']}}</td>
                <td>{{$item['alamat']}}</td>
                <td>{{$item['tiket_id']}}</td>
                <td>{{$item['kategori']}}</td>
                <td>{{$item['harga']}}</td>
                <td>{{$item['status']}}</td>
                <td>{{$item['tgl_pesan']}}</td>
            </tr>
            @php
                $no++;
            @endphp
        @endforeach
    </table>
</body>
</html>