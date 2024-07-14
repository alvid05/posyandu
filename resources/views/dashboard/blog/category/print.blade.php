<html>
    <head>
    <title>Berita Acara</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
        </style>
        <style>
            @font-face {
            font-family: 'Tangerine';
            /* src: url('https://fonts.googleapis.com/css?family=Tangerine")}}') format('truetype'); */
            src:url('<?php  echo public_path('/template-front/assets/fonts/flexslider-icon.ttf'); ?>') format('truetype');
            }
            .typed {
            font-family: 'Tangerine';
            }
/*
            *{
                font-family: Arial, Helvetica, sans-serif;
            } */
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                 /* margin: 0cm 0cm; */
                 margin: 100px 20px;
            }
            .font9 {
                font-size: 9px;
            }
            .font10 {
                font-size: 12px;
            }
            .font12{
                font-size: 12px;
            }
            .font13{
                font-size: 13px;
            }
            .font14{
                font-size: 14px;
            }
            .font16{
                font-size: 16px;
            }
            .mb0{
                line-height: 2.2;
                margin: -10px 0 -10px 0;
            }
            .mt10{
                margin-top: 10px;
            }

            /** Define now the real margins of every page in the PDF **/
             body {
                margin-top: 1.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
                margin-bottom: 4cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 3cm;
            }
            main{
                /* top: 6cm;
                left: 1cm;
                right: 1cm;
                height: 3cm;
                position: absolute; */
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: -10px;
                left: 1cm;
                right: 1cm;
                height: 4cm;
            }
            td.bottom {
                border-top: 1px solid rgb(138, 136, 136);
                border-bottom: 1px solid rgb(138, 136, 136);
                border-right: 1px solid rgb(138, 136, 136);
                }
            #tab2 {
            border-collapse: collapse;
            }
            #tab2 tbody tr td {
                    border: 1px solid rgb(138, 136, 136);
                    padding: 8px;
            }
            #china {
                font-family: wt064;
            }
            .text-center{
                text-align: center;
                margin-bottom: 2px;
            }
            .mb-2{
                 line-height: 20px;
            }

            .ls{
                letter-spacing:1px;
            }
            .font-arial{
                font-family: Arial, Helvetica, sans-serif;
            }
            #detail {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
            }
            .border{
                border-collapse: collapse;
                border: 1px solid rgb(138, 136, 136);
            }

            #detail td, #detail th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #approval {
                font-family: Arial, Helvetica, sans-serif;
                /* border-collapse: collapse; */
            }

            #approval td, #approval th {
            /* border: 1px solid rgb(138, 136, 136); */
            padding: 8px;
            }
            .bold{
                font-weight: bold;
            }
            div.page_break + div.page_break{
             page-break-inside: always;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        {{-- RANGKAP 1 --}}
        <header>
            <table width="100%" id="tab" class="mb0">
                <td align="left" width="5%"> <img class="mt10" src="{{ $logo }}" width="110px"></td>
                <td align="center"  width="53%">
                    <p class="font14 mb0 bold">PT. LANCAR ARTHA MEDIA DATA</p>
                    <p class="font10 mb0">Jl. Indrokilo, RT.008/RW.003, Dsn. Dayurejo, Kec. Prigen, Kab. Pasuruan, Jawa Timur</p>
                    <p class="font10 mb0">Telp      : 087889990473</p>
                    <p class="font10 mb0">Email     : lancararthamediadata@gmail.com &nbsp;&nbsp;&nbsp;&nbsp;   Website   : lamdanet.net</p>
                </td>
            </table>
            <hr>
            <h2 class="text-center mt10 mb-2 font16 bold">FORM BERITA ACARA</h2>
        </header>

        <footer>
            <p>Mengetahui :</p>
            <table width="100%" id="approval">
                <tr>
                    {{-- <th class="text-center font16" rowspan="2">Barang Keluar</th> --}}
                    <td class="text-center">Pelanggan</td>
                    <td class="text-center">Marketing</td>
                    <td class="text-center">NOC</td>
                </tr>
                <tr>
                    <td class="text-center bold" style="height: 40%">
                        {{-- @if ($data['content']->user_approval_id <> null)
                            {{ $data['content']->approval->name }}
                        @endif --}}
                    </td>
                    <td class="text-center bold">
                        {{-- @if ($data['content']->user_security_id <> null)
                            {{ $data['content']->security->name  }}
                        @endif --}}
                    </td>
                    <td class="text-center"><span class="bold">
                        {{-- @if ($data['content']->driver <> null)
                           {{ $data['content']->driver }}</span> <br>( {{ $data['content']->nopol }} )
                        @endif --}}
                    </td>
                </tr>
            </table>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h5 class="bold">Data Berita Acara</h5>
            <table width='100%'  id="tab2">
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">Nomor BA</td>
                    <td class="font12 ls mb-2" width="30%">{{ $beritaAcara->no_ba }}</td>
                    <td class="font12 ls mb-2 bold" width="20%">Tanggal BA</td>
                    <td class="font12 ls mb-2" width="30%">{{ date('d/m/Y', strtotime($beritaAcara->tgl_survey)) }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">Nama</td>
                    <td class="font12 ls mb-2" colspan="3" width="70%">{{ $beritaAcara->nama }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">Alamat</td>
                    <td class="font12 ls mb-2" colspan="3" width="70%">{{ $beritaAcara->alamat }}</td>
                    {{-- <td></td>
                    <td></td> --}}
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">No KTP/SIM</td>
                    <td class="font12 ls mb-2" width="20%">{{ $beritaAcara->ktp }}</td>
                    <td class="font12 ls mb-2 bold" width="25%">Pembuat BA</td>
                    <td class="font12 ls mb-2" width="25%">{{ $beritaAcara->pembuat_ba }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">No HP</td>
                    <td class="font12 ls mb-2" width="20%">{{ $beritaAcara->hp }}</td>
                    <td class="font12 ls mb-2 bold" width="25%">Paket</td>
                    <td class="font12 ls mb-2" width="25%">{{ $beritaAcara->paketInternet->name }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">Email</td>
                    <td class="font12 ls mb-2" width="20%">{{ $beritaAcara->email }}</td>
                    <td class="font12 ls mb-2 bold" width="25%">Nama Usaha</td>
                    <td class="font12 ls mb-2" width="25%">{{ $beritaAcara->nama_usaha }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%">Jenis Instalasi</td>
                    <td class="font12 ls mb-2" width="20%">{{ $beritaAcara->jenis_instalasi }}</td>
                    <td class="font12 ls mb-2 bold" width="25%">Tanggal Survey</td>
                    <td class="font12 ls mb-2" width="25%">{{ date('d/m/Y', strtotime($beritaAcara->tgl_survey2)) }}</td>
                </tr>
                <tr class="mb-2">
                    <td class="font12 ls mb-2 bold" width="20%"> Biaya Registrasi</td>
                    <td class="font12 ls mb-2" width="20%">{{ $beritaAcara->biaya_registrasi }}</td>
                    <td class="font12 ls mb-2 bold" width="25%">Biaya Registrasi</td>
                    <td class="font12 ls mb-2" width="25%">{{ $beritaAcara->biaya_registrasi2 }}</td>
                </tr>
            </table>
            <br><br>
            <h5 class="bold">Keterangan Berita Acara</h5>
            <p class="font14 ls">Pada hari ini tanggal <b>{{ date('d/m/Y', strtotime($beritaAcara->tgl_survey)) }}</b> telah disepakati pemasangan baru internet dirumah <br>
             bapak/ibu/saudara <b>{{ $beritaAcara->nama }}</b> dengan biaya <b>Rp. {{ $beritaAcara->biaya_registrasi }}</b> <br>
            dengan kesepakatan perjanjian yang telah disepakati bersama sabagai berikut : <br>
          <ol class="font14 ls">
              <li class="ls">Semua perangkat internet yang dipasang adalah milik <b>PT. LANCAR ARTHA MEDIA DATA</b></li>
              <li class="ls">Masa berlangganan minimal 1 tahun, jika sebelum 1 tahun putus berlangganan maka pelanggan bersedia membayar denda sebesar <b>Rp. 500.000,-</b></li>
              <li class="ls">Kerusakan perangkat yang diakibatkan kelalaian/kesalahan pelanggan wajib mengganti perangkat yang rusak tersebut.</li>
              <li class="ls">Jarak maksimal pemasangan dari titik ODP ke pelanggan sejauh 250 meter, dan apabila jarak lebih dari 250 meter
                  maka akan dibebankan kepada pelanggan per 1 meternya <b>Rp. 1500,-</b>
              </li>
          </ol></p>
        </main>
          <script type="text/php">
                if ( isset($pdf) ) {
                    $pdf->page_script('
                        if ($PAGE_COUNT > 1) {
                            $font = $fontMetrics->get_font("serif", "normal");
                            $size = 12;
                            $pageText = "Page " . $PAGE_NUM . "/" . $PAGE_COUNT;
                            $y = $pdf->get_height() - 24;
                            $x = $pdf->get_width() - 55;
                            $pdf->text($x, $y, $pageText, $font, $size);
                        }
                    ');
                }
        </script>
    </body>
</html>
