<?php

namespace SHOP\Admin\Library;
use Illuminate\Support\Str;
use SHOP\Admin\Library\PhoneValidator;

class StatusHelper
{
    const UNNECESSARY_CHARACTER = ['+','-', '.', ' ', '  '];

    /** USER PROFILE */
    const DELETE_FIELDS = ['created_at', 'modified_at'];

    const STATUS_FOLLOW = [
        '0' => 'Undefined',
        '1' => 'Follow',
        '2' => 'Not Follow'
    ];

    const PROFILE_STATUS = [
        '0' => 'Undefined',
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    const GENDER = [
        '0' => 'Undefined',
        '1' => 'Male',
        '2' => 'Female',
    ];

    const USER_HEADING = [
        'Tên chủ điểm bán' => 'full_name',
        'Số điện thoại'    => 'phone',
        'Email'            => 'email',
        'Địa Chỉ'          => 'address',
        'Gender'           => 'gender',
        'Birthday'         => 'dob',
        'Thành Phố/Tỉnh'   => 'province',
        'Quận'             => 'district',
        'Huyện'            => 'ward',
    ];

    const USER_FIELDS = [
        'full_name'           => '',
        'phone'               => '',
        'email'               => '',
        'address'             => '',
        'gender'              => '',
        'dob'                 => '',
        'status_follow'       => '',
        'province'            => '',
        'district'            => '',
        'ward'                => '',
        'province_code'       => '',
        'district_code'       => '',
        'ward_code'           => '',
        'distributor'         => '',
        'sale_point'          => '',
        'sale_point_type'     => '',
        'user_type'           => '',
    ];

    const USER_EXPORT = [
        'phone'           => 'Số điện thoại',
        'email'           => 'Email',
        'address'         => 'Addres',
        'gender'          => 'Gender',
        'dob'             => 'Birthday',
        'status_follow'   => 'Status Follow',
        'province'        => 'Thành Phố/Tỉnh',
        'district'        => 'Quận',
        'ward'            => 'Huyện',
        'modified_at'     => 'Modify Date',
        'modified_by'     => 'Modify By',
        'zalo_name'       => 'Zalo Name',
        'zalo_id_by_app'  => 'Zalo ID',
        'zalo_id_by_oa'   => 'Zalo ID By OA',
        'oa_id'           => 'OA ID',
        'distributor'     => 'NPP',
        'full_name'       => 'Tên chủ điểm bán',
        'sale_point'      => 'Tên điểm bán',
        'sale_point_type' => 'Loại điểm bán',
        'user_type'       => 'USERS',
        'total_clicks'    => 'Total view content',
        'total_activities'=> 'Total activity',
    ];

    const FOLLOWER_EXPORT = [
        '_id'            => 'ID',
        'zalo_id_by_oa'  => 'Zalo ID',
        'zalo_name'      => 'Zalo Name',
        'phone'          => 'Phone Number',
        'modified_at'    => 'Follow date',
        'status_follow'  => 'Zalo Status',
    ];

    const LIST_PROVINCES = [
        'HO CHI MINH'       => '79',
        'DA NANG'           => '48',
        'HA NOI'            => '01',
        'HAI PHONG'         => '31',
        'CAN THO'           => '92',
        'HA GIANG'          => '02',
        'CAO BANG'          => '04',
        'BAC KAN'           => '06',
        'TUYEN QUANG'       => '08',
        'LAO CAI'           => '10',
        'DIEN BIEN'         => '11',
        'LAI CHAU'          => '12',
        'SON LA'            => '14',
        'YEN BAI'           => '15',
        'HOA BINH'          => '17',
        'THAI NGUYEN'       => '19',
        'LANG SON'          => '20',
        'QUANG NINH'        => '22',
        'BAC GIANG'         => '24',
        'PHU THO'           => '25',
        'VINH PHUC'         => '26',
        'BAC NINH'          => '27',
        'HAI DUONG'         => '30',
        'HUNG YEN'          => '33',
        'THAI BINH'         => '34',
        'HA NAM'            => '35',
        'NAM DINH'          => '36',
        'NINH BINH'         => '37',
        'THANH HOA'         => '38',
        'NGHE AN'           => '40',
        'HA TINH'           => '42',
        'QUANG BINH'        => '44',
        'QUANG TRI'         => '45',
        'THUA THIEN HUE'    => '46',
        'QUANG NAM'         => '49',
        'QUANG NGAI'        => '51',
        'BINH DINH'         => '52',
        'PHU YEN'           => '54',
        'KHANH HOA'         => '56',
        'NINH THUAN'        => '58',
        'BINH THUAN'        => '60',
        'KON TUM'           => '62',
        'GIA LAI'           => '64',
        'DAK LAK'           => '66',
        'DAK NONG'          => '67',
        'LAM DONG'          => '68',
        'BINH PHUOC'        => '70',
        'TAY NINH'          => '72',
        'BINH DUONG'        => '74',
        'DONG NAI'          => '75',
        'LONG AN'           => '80',
        'TIEN GIANG'        => '82',
        'BEN TRE'           => '83',
        'TRA VINH'          => '84',
        'VINH LONG'         => '86',
        'DONG THAP'         => '87',
        'AN GIANG'          => '89',
        'KIEN GIANG'        => '91',
        'HAU GIANG'         => '93',
        'SOC TRANG'         => '94',
        'BAC LIEU'          => '95',
        'CA MAU'            => '96',
        'BA RIA - VUNG TAU' => '77',
    ];

    /** END USER PROFILE */

    /**
     *  @param Integer $status
     */
    public static function exchangeStatusFollow($status) {
        if(isset(self::STATUS_FOLLOW[$status])) {
            return self::STATUS_FOLLOW[$status];
        } else {
            return $status;
        }
    }

    /**
     *  @param Integer $status
     */
    public static function exchangeUserstatus($table, $status) {
        switch($table) {
            case 'user_profiles':
                if(isset(self::PROFILE_STATUS[$status])) {
                    return self::PROFILE_STATUS[$status];
                }
                break;

                return $status;
        }
    }

    public static function formatToView($data) {
        $data->every(function ($value, $key) {
            if(isset($value['status_follow'])) {
                $value['status_follow'] = self::exchangeStatusFollow($value['status_follow']);
            }
            return $value;
        });

        return $data;
    }

    public static function formatExportField($row, $table, $isFollower=false) {
        $list    = [];
        $data = $isFollower ? $row : $row->getOriginal();

        if(isset($data['status_follow'])) {
            $data['status_follow'] = self::exchangeStatusFollow($data['status_follow']);
        }

        if(isset($data['gender'])) {
            $data['gender'] = isset(self::GENDER[$data['gender']]) ? self::GENDER[$data['gender']] : 'Undefined';
        }

        switch($table) {
            case 'user_profiles':
                break;
        }

        $columns = $isFollower ? self::FOLLOWER_EXPORT : self::USER_EXPORT;

        foreach ($columns as $key => $val) {
            $list[$val] = isset($data[$key]) ? $data[$key] : "";
        }

        return $list;
    }

    public static function formatImportFields($data, $table) {
        $data = self::deleteDataArray($data);
        $data = array_map('trim', $data);

        switch ($table) {
            case 'user_profiles':
                break;
        }

        $data = self::formatUserField($data);
        $data['query_user']['status'] = 1;

        return $data;
    }

    /**
     *  @param String $data
     *  @param Array $status
     */
    public static function formatStatus($data, $list_status) {
        if(!is_numeric($data)) {
            $data = array_search($data, $list_status) ? array_search($data, $list_status) : 0;
        }

        return $data;
    }

    /**
     *  @param Array $data
     */
    public static function formatUserField($data) {
        $condition = [];

        if(isset($data['status_follow'])) {
            if(!is_numeric($data['status_follow'])) {
                $data['status_follow'] = array_search($data['status_follow'], self::STATUS_FOLLOW) ? array_search($data['status_follow'], self::STATUS_FOLLOW) : 0;
            }
        }

        if(isset($data['email'])) {
            $data['email'] = self::checkValidEmail($data['email']);
        }

        if(isset($data['gender'])) {
            if(!is_numeric($data['gender'])) {
                $data['gender'] = array_search($data['gender'], self::GENDER) ? array_search($data['gender'], self::GENDER) : 0;
            }
        }

        if(isset($data['province'])) {
            // $data['province_code'] = self::getProvinceCode($data['province']);
        }

        if(isset($data['phone'])) {
            $data['phone'] =  strval(PhoneValidator::convertPhone($data['phone']));
            $condition = ['phone' => $data['phone']];
        }

        if(isset($data['dob'])) {
            $data['dob'] = date("Y-m-d", strtotime($data['dob']));
        }

        return [
            'query_user' => array_intersect_key($data, self::USER_FIELDS),
            'condition'  => $condition
        ];
    }

    /**
     *  @param Array $data
     */
    public static function deleteDataArray($data) {
        if (is_array($data)) {
            foreach(self::DELETE_FIELDS as $field) {
                unset($data[$field]);
            }
        }
        return $data;
    }

    public static function formatHeading($data, $table) {
        $list = [];
        $headings = self::USER_HEADING;

        switch ($table) {
            case 'user_profiles':
                // $headings['NPP']            = 'distributor';
                $headings['Tên điểm bán']   = 'sale_point';
                $headings['Loại điểm bán']  = 'sale_point_type';
                $headings['USERS']          = 'user_type';
                break;
        }

        foreach ($data as $key) {
            $key = trim($key);
            $list[] = isset($headings[$key]) ? $headings[$key] : $key;
        }
        return $list;
    }

    public static function checkValidEmail($email) {
        if (!preg_match('/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|xyz|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/', $email)) return null;
        return $email;
    }

    public static function getProvinceCode($city) {
        return isset(self::LIST_PROVINCES[$city]) ? self::LIST_PROVINCES[$city] : null;
    }

    public function getModelByTablename($tableName) {
        $name   =  Str::studly(Str::singular($tableName));
        $model  = 'SHOP\CRM\Models\\' . $name;
        return $model;
    }
}
