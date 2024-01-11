<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodTypeRequest\StoreRequest;
use App\Http\Requests\FoodTypeRequest\UpdateRequest;
use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function __construct()
    {
        $this->foodtypes = new FoodType();
    }
    public function index(Request $request)
    {
        $foodtype = $this->foodtypes;
        if ($request->search != '') {
            $foodtype = $this->foodtypes->where('name', 'Like', "%{$request->search}%");
        }
        $foodtype = $foodtype->paginate(3);
        return view('admin.page.foodtype.index', compact('foodtype'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_food', $request->file('image'));
            }
            $store = $this->foodtypes->create($param);
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.foodtype.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.foodtype.store');
            }
        }
        return view('admin.page.foodtype.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $foodtype = $this->foodtypes->find($id);
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $param['image'] = $foodtype->image;
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($foodtype->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_food', $request->file('image'));
                    }
                }

                $update = $this->foodtypes->find($id)->update($param);
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.foodtype.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.foodtype.update', ['id' => $id]);
                }
            }
            return view('admin.page.foodtype.update', compact('foodtype'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = FoodType::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.foodtype.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.foodtype.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $foodtypes = FoodType::onlyTrashed();
        if ($request->search != '') {
            $foodtypes = FoodType::onlyTrashed()->where('name', 'Like', "%{$request->search}%");
        }
        $foodtypes = $foodtypes->get();
        if (empty($foodtypes)) {
            $foodtypes = $foodtypes->toQuery()->paginate(6);
        }
        return view('admin.page.foodtype.trash', compact('foodtypes'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = FoodType::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.foodtype.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.foodtype.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = FoodType::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $delete = FoodType::withTrashed()->where('id', $id)->forceDelete();
            if ($delete && $deleteImage) {
                notify()->success('Delete success');
                return redirect()->route('admin.foodtype.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.foodtype.trash');
            }
        }
    }
}
