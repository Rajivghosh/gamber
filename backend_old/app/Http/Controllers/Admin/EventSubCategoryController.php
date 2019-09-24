<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventCategoryModel;
use View;
//Form request file (for validation)
use App\Http\Requests\Admin\EventSubCategoryRequest;

class EventSubCategoryController extends Controller
{
    public function index(Request $req)
    {
    	$parent = $req->id;
    	return View::make('admin.eventcategory.subcategory', compact('parent'));
    }

    public function data(Request $req)
    {
    	if (empty($req->id))
    		return response()->json(false);
    	return EventCategoryModel::where('category_parent_id', $req->id)->get()->toJson();
    }

    public function save(EventSubCategoryRequest $req)
    {
    	if (empty($req->input()))
    		return response()->json(false);
    	$parentCat = EventCategoryModel::find($req->input('parent'));
    	if (empty($parentCat))
    		return response()->json(false);
    	$model = EventCategoryModel::findOrNew($req->input('id'));
    	$model->level_id = $parentCat->level_id;
    	$model->screen_id = $parentCat->screen_id;
    	$model->name = $req->input('name');
    	$model->details = $parentCat->details;
    	$model->category_parent_id = $req->input('parent');
    	$model->save();
    	return response()->json(true);
    }

    public function remove(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $allow = 1;
        //Write dependency code implement here

        //----------------------------------//
        if ($allow == 1) {            
            EventCategoryModel::where('id', $req->id)->delete();
        }
        return response()->json(true);
    }
}
