<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodType;
use App\Models\ImageFood;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->food = new Food();
        $this->foodtype = new FoodType();
    }
    public function index(Request $request)
    {
        $food = $this->food;
        $foodtype = $this->foodtype::all();
        if ($request->search != '') {
            $food = $this->food->where('name', 'Like', "%{$request->search}%")->orWhere('ingredient', 'Like', "%{$request->search}%");
        }
        $food = $food->paginate(6);
        $image_food = ImageFood::all();
        return view('admin.page.food.index', compact('food', 'foodtype', 'image_food'));
    }
    public function store(Request $request)
    {
        $foodtype = $this->foodtype::all();
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_food', $request->file('image'));
            }
            if ($request->hasFile('filenames') && $request->file('filenames')) {
                $array_image = $this->UploadMultiImage('image_food', $request->file('filenames'));
            }
            $store = $this->food->create($param);
            if ($store) {
                foreach ($array_image as $key => $item) {
                    $image = [
                        'food_id' => $store->id,
                        'image' => $item
                    ];
                    ImageFood::create($image);
                }
                notify()->success('Store success');
                return redirect()->route('admin.food.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.food.store');
            }
        }
        return view('admin.page.food.store', compact('foodtype'));
    }
    //dang lam do update 
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $fd = $this->food->find($id);
            $array_image = ImageFood::where('food_id', $id)->get();
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $param['image'] = $fd->image;
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($fd->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_admin', $request->file('image'));
                    }
                }
                if ($request->hasFile('filenames') && $request->file('filenames')) {
                    foreach ($array_image as $key => $value) {
                        $deleteImage = $this->DeleteImage($value);
                    }
                    if ($deleteImage) {
                        
                    }
                }
                $update = $this->admins->find($id)->update($param);
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.admin.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.admin.update', ['id' => $id]);
                }
            }
            return view('admin.page.admin.update', compact('dep', 'department', 'role'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Food::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.admin.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.admin.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $foodtype = $this->foodtype::all();
        $food = Food::onlyTrashed();
        if ($request->search != '') {
            $food = Food::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $food = $food->get();
        if (empty($food)) {
            $food = $food->toQuery()->paginate(6);
        }
        return view('admin.page.admin.trash', compact('food', 'role', 'department'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Food::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.admin.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.admin.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = Food::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $delete = Food::withTrashed()->where('id', $id)->forceDelete();
            if ($delete && $deleteImage) {
                notify()->success('Delete success');
                return redirect()->route('admin.admin.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.admin.trash');
            }
        }
    }
}
