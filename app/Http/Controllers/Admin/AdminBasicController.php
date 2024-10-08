<?php

namespace App\Http\Controllers\Admin;
use App\Traits\ReportTrait;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class AdminBasicController extends Controller {

  protected $model;
  protected $StoreReequest;

  public function __construct(Model $model , Request $StoreReequest){
     $this->model = $model;
     $this->StoreReequest = $StoreReequest;
  } 
  // اسم ال moddel
  protected function modelName(){
      return class_basename($this->model);
  }   

  //  جمع اسم ال model
  protected function PluralModelName(){
      return Str::plural($this->modelName());
  }
  
  //اسم الفولدر في ال views
  protected function getFolderNameFromModel(){
      return strtolower($this->PluralModelName());
  }

  public function index(Request $request)
  {
      if (request()->ajax()) {
          $cities = $this->model::search($request)->paginate(30);
          $html = view('admin.'.$this->getFolderNameFromModel().'.table' ,compact('cities'))->render() ;
          return response()->json(['html' => $html]);
      }
      return view('admin.'.$this->getFolderNameFromModel().'.index');
  }

  public function create()
  {
      return view('admin.'.$this->getFolderNameFromModel().'.create');
  }

  public function edit($id)
  {
      $row = $this->model::findOrFail($id);
      return view('admin.cities.edit' , ['row' => $row]);
  }
  
  public function show($id)
  {
      $row = $this->model::findOrFail($id);
      return view('admin.'.$this->getFolderNameFromModel().'.show' , ['row' => $row ]);
  }

  public function destroy($id)
    {
        $row = $this->model::findOrFail($id)->delete();
        ReportTrait::addToLog('  حذف '.$this->PluralModelName()) ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if ($this->model::WhereIn('id',$ids)->get()->each->delete()) {
            ReportTrait::addToLog('  حذف العديد من  '.$this->PluralModelName()) ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

}
