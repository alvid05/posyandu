<?php

namespace App\Helpers;
use DB;
use File;
use Image;
use Illuminate\Http\Request;
use App\Helpers\Navigation;
use Illuminate\Support\Facades\Storage;

class Money{

    public static function rupiahToString($rp)
    {
        $result = substr(str_replace(".", "", $rp), 3);
        return $result;
    }

    public static function stringToRupiah($rp)
    {
        return 'Rp. ' . number_format($rp, 0, '', '.');
    }

    function convert_rupiah($rp)
    {
        $result = substr(str_replace(".", "", $rp), 3);
        return $result;
    }

    function rupiah($rp)
    {
        return 'Rp. ' . number_format($rp, 0, '', '.');
    }

}