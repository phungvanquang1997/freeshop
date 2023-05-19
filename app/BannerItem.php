<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'banner_items';

    protected $fillable = [
        'name',
        'image',
        'link',
        'code',
        'description',
        'status',
        'banner_id',
    ];

    public function banner()
    {
        return $this->belongsTo('App\Banner', 'banner_id');
    }
}
