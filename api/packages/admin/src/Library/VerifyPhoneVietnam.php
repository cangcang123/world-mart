<?php

namespace SHOP\Admin\Library;

class VerifyPhoneVietnam
{
    const UNNECESSARY_CHARACTER = ['-', '.', ' ', '  '];

    const OPERATORS_LIST = [
        '086' => 'viettel',
        '096' => 'viettel',
        '097' => 'viettel',
        '098' => 'viettel',
        '032' => 'viettel',
        '033' => 'viettel',
        '034' => 'viettel',
        '035' => 'viettel',
        '036' => 'viettel',
        '037' => 'viettel',
        '038' => 'viettel',
        '039' => 'viettel',

        '089' => 'mobifone',
        '090' => 'mobifone',
        '093' => 'mobifone',
        '070' => 'mobifone',
        '079' => 'mobifone',
        '077' => 'mobifone',
        '076' => 'mobifone',
        '078' => 'mobifone',

        '088' => 'vinaphone',
        '091' => 'vinaphone',
        '094' => 'vinaphone',
        '083' => 'vinaphone',
        '084' => 'vinaphone',
        '085' => 'vinaphone',
        '081' => 'vinaphone',
        '082' => 'vinaphone',

        '092' => 'vietnamobile',
        '056' => 'vietnamobile',
        '058' => 'vietnamobile',

        '099' => 'gmobile',
        '059' => 'gmobile',

        '095' => 'sphone'
    ];

    // old new
    const OPERATORS_CHANGED_LIST = [
        '0162' => '032',
        '0163' => '033',
        '0164' => '034',
        '0165' => '035',
        '0166' => '036',
        '0167' => '037',
        '0168' => '038',
        '0169' => '039',

        '0120' => '070',
        '0121' => '079',
        '0122' => '077',
        '0126' => '076',
        '0128' => '078',

        '0123' => '083',
        '0124' => '084',
        '0125' => '085',
        '0127' => '081',
        '0129' => '082',

        '0186' => '056',
        '0188' => '058',

        '0199' => '059'
    ];

    public static function clearUnnecessaryCharacter($number)
    {
        return str_replace(self::UNNECESSARY_CHARACTER, '', $number);
    }

    public static function clearAllChar($number)
    {
        return preg_replace("/[^0-9]/", "", $number);
    }

    public static function isValidPhone($number)
    {
        $number = str_replace(self::UNNECESSARY_CHARACTER, '', $number);
        if (!preg_match('/^(841[2689]|01[2689]|84[39785]|0[39785])[0-9]{8}$/', $number)) return FALSE;
        return TRUE;
    }

    public static function isNationalNumber($number)
    {
        $number = self::clearUnnecessaryCharacter($number);
        return substr($number, 0, 2) == '84';
    }
}