<?php

namespace SHOP\Admin\Library;

class PhoneValidator
{
    const operators = [
        '086'=>'viettel',
        '096'=>'viettel',
        '097'=>'viettel',
        '098'=>'viettel',
        '032'=>'viettel',
        '033'=>'viettel',
        '034'=>'viettel',
        '035'=>'viettel',
        '036'=>'viettel',
        '037'=>'viettel',
        '038'=>'viettel',
        '039'=>'viettel',

        '089'=>'mobifone',
        '090'=>'mobifone',
        '093'=>'mobifone',
        '070'=>'mobifone',
        '079'=>'mobifone',
        '077'=>'mobifone',
        '076'=>'mobifone',
        '078'=>'mobifone',

        '088'=>'vinaphone',
        '091'=>'vinaphone',
        '094'=>'vinaphone',
        '083'=>'vinaphone',
        '084'=>'vinaphone',
        '085'=>'vinaphone',
        '081'=>'vinaphone',
        '082'=>'vinaphone',

        '092'=>'vietnamobile',
        '056'=>'vietnamobile',
        '058'=>'vietnamobile',

        '099'=>'gmobile',
        '059'=>'gmobile',

        '095' =>'sphone'
    ];

    const operator_changed_list = [
        '0162'=>'032',
        '0163'=>'033',
        '0164'=>'034',
        '0165'=>'035',
        '0166'=>'036',
        '0167'=>'037',
        '0168'=>'038',
        '0169'=>'039',

        '0120' =>'070',
        '0121' =>'079',
        '0122' =>'077',
        '0126' =>'076',
        '0128' =>'078',

        '0123' =>'083',
        '0124' =>'084',
        '0125' =>'085',
        '0127' =>'081',
        '0129' =>'082',

        '0186' =>'056',
        '0188' =>'058',

        '0199' =>'059'
    ];


    public static function isValidPhone($number) {
        $number = preg_replace("/[^0-9]/", "", $number);
        if (!preg_match('/^(841[2689]|01[2689]|84[239785]|0[239785])[0-9]{8}$/', $number)) return '';
        return $number;
    }

    public static function convertToLocalNumber($number){
        $number = preg_replace("/[^0-9]/", "", $number);
        if(substr($number,0,2) == '84'){
            $number =  '0' . substr($number,2,strlen($number) -2);
        }
        return $number;
    }

    public static function checkOldPhone($phone, $allow_convert = false){
        if(!self::isValidPhone($phone)) return false;
            $phone = (string)$phone;
            $sub_number = substr($phone,0,4);
            if(!empty(self::operator_changed_list[$sub_number])){
                if($allow_convert){
                    return self::operator_changed_list[$sub_number] . substr($phone,4,strlen($phone) -4);
                }
                return $phone;
            }
        return false;
    }

    public static function convertPhone($number){
        $number = self::convertToLocalNumber($number);
        $phone  = self::checkOldPhone($number,true);
        if($phone){
            return $phone;
        }
        return self::isValidPhone($number);
    }
}