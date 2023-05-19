<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController {

    use Dispatchable, ValidatesRequests;

    public function __construct()
    {
        $this->lang_id = Session('lang', \Config::get('app.locale'));
    }
}
