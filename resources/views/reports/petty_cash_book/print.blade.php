<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Petty Cash Book</title>
</head>
<body>
  <h1>Percobaan</h1>
    <div class="card-body">
      <div class="dt-responsive">
        @php
        function format_uang($angka){
          $hasil =  number_format($angka,2, ',' , '.');
          return $hasil;
        }
        function format_uang2($angka){
          $hasil =  number_format($angka,0, ',' , '.');
          return $hasil;
        }
        @endphp
        <table id="complex-dt" class="table table-bordered nowrap" width="100%" style="width:100%" border="0">
          <thead>
            <tr class="bg-secondary font-weight-bold">
              <th class="col-2 text-light">Tanggal</th>
              <th class="col-2 text-light">Deskripsi</th>
              <th class="col-2 text-light">Nomor Akun</th>
              <th class="col-2 text-light">Nama Akun</th>
              <th class="col-2 text-light">Debet</th>
              <th class="col-2 text-light">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pc_detail as $data)
              <tr>
                <td>{{date('d F Y', strtotime($data->pettycash->tanggal ))}}</td>
                <td>{{$data->pettycash->description}}</td>
                <td>{{$data->nomor_akun}}</td>
                <td>{{$data->nama_akun}}</td>
                <td class="text-right">
                  {{format_uang2($data->debet)}}
                </td>
                <td class="text-right">
                  {{format_uang2($data->kredit)}}
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-success font-weight-bold">
              <td></td>
              <td class="text-light" colspan="3">Total</td>
              <td class="text-light text-right">{{format_uang2($sum_debet)}}</td>
              <td class="text-light text-right">{{format_uang2($sum_kredit)}}</td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div style="margin-bottom: 40px;"></div>
      <div class="dt-responsive">
        <table id="simpletable" class="table table-bordered nowrap" width="100%" style="width:100%" border="0">
          <thead>
            <tr class="bg-secondary font-weight-bold">
              <td class="text-light text-center" colspan="4">Rekapitulasi</td>
            </tr>
            <tr>
              <td class="col-3">Nomor Akun</td>
              <td class="col-3">Nama Akun</td>
              <td class="col-3">Debet</td>
              <td class="col-3">Kredit</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($distinct_pc as $rekap)
              <tr>
                <td>{{$rekap->nomor_akun}}</td>
                <td>{{$rekap->nama_akun}}</td>
                <td class="text-right">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('debet'))}}</td>
                <td class="text-right">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('kredit'))}}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-success font-weight-bold">
              <td class="text-light text-right" colspan="2">Total</td>
              <td class="text-light text-right">{{format_uang2($sum_debet)}}</td>
              <td class="text-light text-right">{{format_uang2($sum_kredit)}}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
</body>
</html>
