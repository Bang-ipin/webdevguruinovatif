<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded =[];

    public static function tgl_sql($date){
        $exp = explode('-',$date);
        if(count($exp) == 3) {
            $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        }
        return $date;
    }

    public static function converttanggal($tanggal)
    {
        date_default_timezone_set('Asia/Jakarta');
        $format = array('Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Agu', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des');
        $tanggal = date('d M Y', strtotime($tanggal));
        return strtr($tanggal, $format);
    }
    public static function tgl_indo($date){
        $exp = explode('-',$date);
        if(count($exp) == 3) {
            $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        }
        return $date;
    }
}
