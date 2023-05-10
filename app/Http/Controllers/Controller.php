<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController {

    use DispatchesCommands, ValidatesRequests;

    public function __construct()
    {
        $this->lang_id = Session('lang', \Config::get('app.locale'));
    }
}
