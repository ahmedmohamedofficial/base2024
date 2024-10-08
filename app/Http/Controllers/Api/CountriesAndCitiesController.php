<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Settings\CityResource;
use App\Http\Resources\Api\Settings\CountryResource;
use App\Http\Resources\Api\Settings\CountryWithCitiesResource;

class CountriesAndCitiesController extends Controller
{
  use ResponseTrait;

  public function countries() {
    $countries = CountryResource::collection(Country::latest()->get());
    return $this->successData( $countries);
  }

  public function cities() {
    $cities = CityResource::collection(City::latest()->get());
    return $this->successData( $cities);
  }

  public function CountryCities($country_id) {
    $cities = CityResource::collection(City::where('country_id', $country_id)->latest()->get());
    return $this->successData( $cities);
  }

  public function countriesWithCities() {
    $countries = CountryWithCitiesResource::collection(Country::with('cities')->latest()->get());
    return $this->successData( $countries);
  }
}
