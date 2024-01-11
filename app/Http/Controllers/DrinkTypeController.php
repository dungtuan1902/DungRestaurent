<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrinkTypeRequest\StoreRequest;
use App\Http\Requests\DrinkTypeRequest\UpdateRequest;
use App\Models\DrinkType;
use Illuminate\Http\Request;

class DrinkTypeController extends Controller
{
    public function __construct()
    {
        $this->drinktypes = new DrinkType();
    }
    public function index(Request $request)
    {
        $drinktype = $this->drinktypes;
        if ($request->search != '') {
            $drinktype = $this->drinktypes->where('name', 'Like', "%{$request->search}%");
        }
        $drinktype = $drinktype->paginate(3);
        return view('admin.page.drinktype.index', compact('drinktype'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_drink', $request->file('image'));
            }
            $store = $this->drinktypes->create($param);
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.drinktype.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.drinktype.store');
            }
        }
        return view('admin.page.drinktype.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $drinktype = $this->drinktypes->find($id);
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $param['image'] = $drinktype->image;
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($drinktype->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_food', $request->file('image'));
                    }
                }

                $update = $this->drinktypes->find($id)->update($param);
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.drinktype.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.drinktype.update', ['id' => $id]);
                }
            }
            return view('admin.page.drinktype.update', compact('drinktype'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = DrinkType::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.drinktype.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.drinktype.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $drinktypes = DrinkType::onlyTrashed();
        if ($request->search != '') {
            $drinktypes = DrinkType::onlyTrashed()->where('name', 'Like', "%{$request->search}%");
        }
        $drinktypes = $drinktypes->get();
        if (empty($drinktypes)) {
            $drinktypes = $drinktypes->toQuery()->paginate(6);
        }
        return view('admin.page.drinktype.trash', compact('drinktypes'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = DrinkType::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.drinktype.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.drinktype.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = DrinkType::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $delete = DrinkType::withTrashed()->where('id', $id)->forceDelete();
            if ($delete && $deleteImage) {
                notify()->success('Delete success');
                return redirect()->route('admin.drinktype.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.drinktype.trash');
            }
        }
    }
}
