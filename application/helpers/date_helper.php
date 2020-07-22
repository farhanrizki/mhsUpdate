<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper for company list dropdown
 *
 * @author Moch. Rasyid
 * @copyright 2018 Moch. Rasyid
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

if ( ! function_exists('date_ID'))
{
    function date_ID($code, $date_int)
    {
        $hari = array(
            "1" => "Senin",
            "2" => "Selasa",
            "3" => "Rabu",
            "4" => "Kamis",
            "5" => "Jumat",
            "6" => "Sabtu",
            "0" => "Minggu"
        );

        $bulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );



        $w = date("w", $date_int);
        $m = date("m", $date_int);

        
        $returnValue = str_replace("%D", $hari[$w], $code);
        $returnValue = str_replace("%F", $bulan[$m], $returnValue);
        $returnValue = str_replace("%Y", date("Y", $date_int), $returnValue);
        $returnValue = str_replace("%d", date("d", $date_int), $returnValue);
        $returnValue = str_replace("%m", date("m", $date_int), $returnValue);
 
        return $returnValue;
    }   
}
