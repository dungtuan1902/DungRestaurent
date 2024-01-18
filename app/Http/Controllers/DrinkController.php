<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrinkRequest\StoreRequest;
use App\Http\Requests\DrinkRequest\UpdateRequest;
use App\Models\Drink;
use App\Models\DrinkType;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function __construct()
    {
        $this->drink = new Drink();
        $this->drinktype = new DrinkType();
    }
    public function index(Request $request)
    {
        $drink = $this->drink;
        $drinktype = $this->drinktype::all();
        if ($request->search != '') {
            $drink = $drink->where('name', 'Like', "%{$request->search}%")->orWhere('ingredient', 'Like', "%{$request->search}%");
        }
        if (isset($request->drinktype)) {
            $drink = $drink->where('drink_type_id', $request->drinktype);
        }
        $drink = $drink->paginate(6);
        return view('admin.page.drink.index', compact('drink', 'drinktype'));
    }
    public function store(StoreRequest $request)
    {
        $drinktype = $this->drinktype::all();
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_drink', $request->file('image'));
            }
            $store = $this->drink->create($param);
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.drink.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.drink.store');
            }
        }
        return view('admin.page.drink.store', compact('drinktype'));
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $drink = $this->drink->find($id);
            $drinktype = $this->drinktype::all();
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $param['image'] = $drink->image;
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($drink->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_drink', $request->file('image'));
                    }
                }
                $update = $this->drink->find($id)->update($param);
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.drink.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.drink.index');
                }
            }
            return view('admin.page.drink.update', compact('drink', 'drinktype'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Drink::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.drink.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.drink.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $drinktype = $this->drinktype::all();
        $drink = Drink::onlyTrashed();
        if ($request->search != '') {
            $drink = Drink::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $drink = $drink->get();
        if (empty($drink)) {
            $drink = $drink->toQuery()->paginate(6);
        }
        return view('admin.page.drink.trash', compact('drink', 'drinktype'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Drink::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.drink.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.drink.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = Food::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $delete = Food::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.drink.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.drink.trash');
            }
        }
    }
}
