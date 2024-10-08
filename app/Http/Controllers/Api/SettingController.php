<?php

namespace App\Http\Controllers\Api;
use App\Models\Fqs;
use App\Models\Image;
use App\Models\Intro;
use App\Models\Social;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Traits\ResponseTrait;
use App\Services\CouponService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coupon\checkCouponRequest;
use App\Http\Resources\Api\Settings\SocialResource;
use App\Http\Resources\Api\Settings\FqsResource;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Http\Resources\Api\Settings\IntroResource;
use App\Http\Resources\Api\Settings\CategoryResource;
use App\Models\Page;
use App\Models\PaymentBrand;

class SettingController extends Controller {
  use ResponseTrait;

  public function settings() {
    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
    return $this->successData($data);
  }

  public function about() {
    $about = Page::whereSlug('about')->first()->content;
    return $this->successData( $about);
  }

  public function terms() {
    $about = Page::whereSlug('terms')->first()->content;
    return $this->successData( $about);
  }
  public function privacy() {
    $about = Page::whereSlug('privacy')->first()->content;
    return $this->successData( $about);
  }

  public function intros() {
    $intros = IntroResource::collection(Intro::latest()->get());
    return $this->successData( $intros);
  }

  public function fqss() {
    $fqss = FqsResource::collection(Fqs::latest()->get());
    return $this->successData( $fqss);
  }

  public function socials() {
    $socials = SocialResource::collection(Social::latest()->get());
    return $this->successData( $socials);
  }

  public function images($id = null) {
    $images = ImageResource::collection(Image::latest()->get());
    return $this->successData( $images);
    //$images = ImageResource::collection(Image::paginate(1));
  }

  public function categories($id = null) {
    $categories = CategoryResource::collection(Category::where('parent_id', $id)->latest()->get());
    return $this->successData($categories);
  }

  public function checkCoupon(checkCouponRequest $request)
  {
    $checkCouponRes = CouponService::checkCoupon( $request->coupon_num , $request->total_price) ;
    return $this->response($checkCouponRes['key'] , $checkCouponRes['msg'] , $checkCouponRes['data'] ?? null);
  }
  public function isProduction()
  {
    $isProduction = SiteSetting::where(['key' => 'is_production'])->first()->value;
    return $this->successData($isProduction);
  }

  function paymentBrands() {
    $brands = PaymentBrand::where('status' , 'active')->latest()->get(['id' , 'name' , 'image' ]);
    return $this->successData($brands);
  }
}
