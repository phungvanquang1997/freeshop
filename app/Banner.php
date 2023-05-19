<?php
namespace App;

use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_BANNER = 1;
    const TYPE_SLIDER = 2;
    const TYPE_ADS = 3;

    const POS_TOP_UP = 1;
    const POS_TOP_DOWN = 2;
    const POS_RIGHT_TOP = 3;
    const POS_RIGHT_BOTTOM = 4;
    const POS_LEFT_TOP = 5;
    const POS_LEFT_BOTTOM = 6;
    const POS_CENTER_TOP = 7;
    const POS_CENTER_CENTER = 8;
    const POS_CENTER_BOTTOM = 9;
    const POS_BOTTOM = 10;
    const POS_FOOTER_LEFT = 11;
    const POS_FOOTER_RIGHT = 12;
    const POS_FOOTER_CENTER = 13;
    const POS_FOOTER_BOTTOM = 14;

    public static $positions = [
        1 => 'TOP',
        2 => 'TOP DOWN',
        3 => 'RIGHT TOP',
        4 => 'RIGHT BOTTOM',
        5 => 'LEFT TOP',
        6 => 'LEFT BOTTOM',
        7 => 'CENTER TOP',
        8 => 'CENTER MIDDLE',
        9 => 'CENTER BOTTOM',
        10 => 'BOTTOM',
        11 => 'FOOTER LEFT',
        12 => 'FOOTER RIGHT',
        13 => 'FOOTER CENTER',
        14 => 'FOOTER BOTTOM',
    ];

    public static $status = [
        1 => 'Active',
        0 => 'Inactive',
    ];

    protected $table = 'banners';

    protected $fillable = [
        'name',
        'position',
        'status',
        'lang_id',
        'type',
    ];

    public function bannerItems()
    {
        return $this->hasMany('App\BannerItem', 'banner_id');
    }

}
