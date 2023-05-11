<?php 
namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composers([
			'App\Http\Composers\AdminBreadcrumbComposer' => 'admin.includes.boxed.breadcrumb',
			'App\Http\Composers\BlogSidebarComposer'     => 'web.pages.blog._sidebar',
			'App\Http\Composers\HeaderComposer'          => 'web.partials.header',
			'App\Http\Composers\FooterComposer'			 => 'web.partials.footer',
			'App\Http\Composers\CartComposer'            => 'web.partials.cart',
			'App\Http\Composers\AdminSidebarComposer'    => 'admin.includes.boxed.sidebar',
			'App\Http\Composers\AdvHomeFrontComposer'    => 'web.partials.adv_front',
			'App\Http\Composers\TopNavComposer'          => 'web.partials.header',
			'App\Http\Composers\HeadComposer'          	 => 'web.partials.head',
			'App\Http\Composers\HomeComposer'          	 => 'web.home.index',
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
