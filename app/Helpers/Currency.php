<?php namespace App\Helpers;

use NumberFormatter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class Currency
{

	public static function currency($price)
	{
		$currentCurrency = Session::get('currency') ? Session::get('currency') : Config::get('app.currency_default');
		$rate = Config::get('app.currency_rate_' . Config::get('app.currency_default'). '_to_' . $currentCurrency);

		$finalPrice = $price * $rate;
		switch ($currentCurrency) {
			case 'VND':
				$fmt = new NumberFormatter('vi_VN', NumberFormatter::CURRENCY);
				break;
			case 'USD':
				$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
				break;
			default:
				$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
				break;
		}

		return  $finalPrice > 0 ? $fmt->formatCurrency($finalPrice, $currentCurrency) : trans('lang.Contact');
	}

	public static function signals($nation = 'vn')
	{
		if ($nation === 'vn') return ' <span>' . '₫' . '</span>';
		elseif ($nation === 'cn') return ' <span>' . '¥' . '</span>';
	}

	public static function display($number, $currency = 'vn')
	{
		$sign = self::signals($currency);
		if ($currency === 'vn') return number_format($number) . $sign;
		if ($currency === 'cn') return number_format($number, 2) . $sign;
	}

	public static function displayBold($number, $currency = 'vn')
	{
		$sign = self::signals($currency);
		if ($currency === 'vn') return '<strong>' . number_format($number) . '</strong>' . $sign;
		if ($currency === 'cn') return '<strong>' . number_format($number, 2) . '</strong>' . $sign;
	}

	public static function normalizeYuan($value)
	{
		return str_replace(',', '.', $value);
	}

}
