<!DOCTYPE html>
<html lang="en">
<style>
    .custom_table { font-size:8px; margin-bottom:10px; }
    .custom_table th { padding: 5px 10px; vertical-align:top; }
    .custom_table td { vertical-align:top; padding: 5px 10px; }
</style>
<body>

    <h3>TIKET ID : {{$result->tiket_id}}</h3>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="custom_table">
        <tr>
            <td width='15%'>Nama Lengkap</td>
            <td width='1px'>:</td>
            <td>{{$result->nm_lengkap}}</td>
            <td width='15%'>No Hp</td>
            <td width='1px'>:</td>
            <td>{{$result->no_hp}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{$result->email}}</td>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$result->alamat}}</td>
        </tr>
    </table>


</body>
</html>