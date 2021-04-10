<?php

namespace SHOP\Admin\Library;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ChartHelper
{
    const LIST_TOP_CITIES = [
        '96' => 'Tỉnh Cà Mau',
        '93' => 'Tỉnh Hậu Giang',
        '91' => 'Tỉnh Kiên Giang',
        '86' => 'Tỉnh Vĩnh Long',
        '84' => 'Tỉnh Trà Vinh',
        '77' => 'Tỉnh Bà Rịa - Vũng Tàu',
        '52' => 'Tỉnh Bình Định',
        '42' => 'Tỉnh Hà Tĩnh',
        '40' => 'Tỉnh Nghệ An',
        '38' => 'Tỉnh Thanh Hóa',
    ];

    const LIST_SELECT_DONUT = ['total_sent', 'total_received', 'total_view'];

    const LIST_STATUS = [1,2];

    public static function getPercentage( $number, $total, $decimals = 2 ){
        return $total == 0 ? 0 : round( $number / $total * 100, $decimals );
    }

    public static function getListMonth() {
        $list_month = [];

        for($m=1; $m<=12; ++$m){
            $list_month[] = date('M', mktime(0, 0, 0, $m, 1));
        }

        return $list_month;
    }

    public static function getMonthFormat($year) {
        $data = [];
        $list_date = [];
        $list_month = [];
        $date_format = [];

        for($m=1; $m<=12; $m++) {
            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $list_date[] = join('-',[$year,$month]);
            $list_month[] = $month;
            $date_format[$month] = 0;
        }

        $data = [
            'list_date' => $list_date,
            'list_month' => $list_month,
            'date_format' => $date_format
        ];

        return $data;
    }

    public static function getCustomMongoDays($num = 7)
    {
        $list_date = [];
        for($i=0; $i < $num; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $list_date[] = $date;
            $date_format[$date] = 0;
        }

        return [
            'list_date' => $list_date,
            'date_format' => $date_format
        ];
    }

    public static function getCustomDays($num = 7) {
        $data = [];
        $list_date = [];
        $date_format = [];

        for($i=$num - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime(-$i .'days'));
            $list_date[] = $date;
            $date_format[$date] = 0;
        }

        $data = [
            'list_date' => $list_date,
            'date_format' => $date_format
        ];

        return $data;
    }

    public static function getListCustomDays( $num = 7) {
        $list_date = [];

        for($i=$num - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime(-$i .'days'));
            $list_date[] = $date;
        }

        return $list_date;
    }

    public static function formatStackedColumnChart($list) { //array
        $data_return = [];
        foreach ($list as $item) {
            $data_return['category'][] = $item['name'];
            $data_return['total_sent'][] = $item['total_sent'];
            $data_return['total_received'][] = $item['total_received'];
            $data_return['total_view'][] = $item['total_view'];
        }

        $data_return['data'] = [
            [
                'name' => 'Sent',
                'data' => $data_return['total_sent']
            ],
            [
                'name' => 'Received',
                'data' => $data_return['total_received']
            ],
            [
                'name' => 'View',
                'data' => $data_return['total_view']
            ]
        ];

        return $data_return;
    }
}
