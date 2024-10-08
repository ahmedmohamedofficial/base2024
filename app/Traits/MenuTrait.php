<?php

namespace App\Traits;

use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Employee;
use App\Models\Intro;
use App\Models\IntroFqs;
use App\Models\IntroFqsCategory;
use App\Models\IntroMessages;
use App\Models\IntroPartener;
use App\Models\IntroService;
use App\Models\IntroSlider;
use App\Models\IntroSocial;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Role;
use App\Models\Seo;
use App\Models\Service;
use App\Models\SMS;
use App\Models\Social;
use App\Models\Story;
use App\Models\User;
use App\Models\IntroHowWork;
use Spatie\LaravelPackageTools\Package;
use App\Builders\MenuBuilder;
use App\Models\Admin;
use App\Models\LogActivity;
use App\Enums\ApprovedCenter;


trait MenuTrait {
	public function home()
	{
		// Create a new menu builder
		$menuBuilder = new MenuBuilder();

		// Build the menu with various menu items
		$menu = $menuBuilder
			->addMenuItem( 'routes.admin.admins.index', Admin::count(), 'fa-solid fa-user-secret', 'admins.index' )
			->addMenuItem( 'routes.admin.clients.index', User::all()->count(),'fa-solid fa-person-chalkboard','clients.index')
			->addMenuItem( 'routes.admin.clients.active', User::where( 'is_active',true)->count(),'fa-solid fa-person','clients.active')
			->addMenuItem( 'routes.admin.clients.notActive', User::where('is_active',false )->count(),'fa-solid fa-person','clients.notActive')
			->addMenuItem( 'routes.admin.clients.blocked', User::where('is_blocked',true )->count(),'fa-solid fa-person-circle-xmark','clients.blocked')
			->addMenuItem( 'routes.admin.cities.index', City::count(), 'fa-solid fa-flag', 'cities.index' )
			->addMenuItem( 'routes.admin.countries.index', Country::count(), 'fa-solid fa-flag', 'countries.index' )
			->addMenuItem( 'routes.admin.intros.index', Intro::count(), 'fa-solid fa-image', 'intros.index' )
			->addMenuItem( 'routes.admin.socials.index', Social::count(), 'fa-regular fa-envelope', 'socials.index' )
			->addMenuItem( 'routes.admin.coupons.index', Coupon::count(), 'fa-solid fa-sack-xmark', 'coupons.index' )
			->addMenuItem( 'routes.admin.roles.index', Role::count(), 'fa-solid fa-person', 'roles.index' )
			->addMenuItem( 'routes.admin.seos.index', Seo::count(), 'fa-solid fa-school', 'seos.index' )
			->addMenuItem( 'routes.admin.reports.index', LogActivity::count(), 'fa-solid fa-image', 'reports.index' )
			->addMenuItem( 'routes.admin.pages.index', Page::count(), 'fa-solid fa-file', 'pages.index' )
			->getMenu();

		// Return the built menu
		return $menu;


	}
	public function home2()
	{
		// Create a new menu builder
		$menuBuilder = new MenuBuilder();

		$menus2 = $menuBuilder


			->addMenuItem( 'routes.admin.intros.index', Intro::count(), 'fa-solid fa-image', 'intros.index' )
			->addMenuItem( 'routes.admin.introsliders.index', IntroSlider::count(), 'fa-solid fa-image', 'introsliders.index' )
			->addMenuItem( 'routes.admin.introservices.index', IntroService::count(), 'fa-solid fa-image', 'introservices.index' )
			->addMenuItem( 'routes.admin.introfqscategories.index', IntroFqsCategory::count(), 'fa-solid fa-image', 'introfqscategories.index' )
			->addMenuItem( 'routes.admin.introfqs.index', IntroFqs::count(), 'fa-solid fa-image', 'introfqs.index' )
			->addMenuItem( 'routes.admin.introparteners.index', IntroPartener::count(), 'fa-solid fa-image', 'introparteners.index' )
			->addMenuItem( 'routes.admin.intromessages.index', IntroMessages::count(), 'fa-solid fa-image', 'intromessages.index' )
			->addMenuItem( 'routes.admin.introsocials.index', IntroSocial::count(), 'fa-solid fa-image', 'introsocials.index' )
			->addMenuItem( 'routes.admin.introhowworks.index', IntroHowWork::count(), 'fa-solid fa-image', 'introhowworks.index' )





			->getMenu();

		// Return the built menu
		return $menus2;
	}

}