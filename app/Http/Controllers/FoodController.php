<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest\StoreRequest;
use App\Http\Requests\FoodRequest\UpdateRequest;
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
            $food = $food->where('name', 'Like', "%{$request->search}%")->orWhere('ingredient', 'Like', "%{$request->search}%");
        }
        if (isset($request->foodtype)) {
            $food = $food->where('food_type_id',$request->foodtype);
        }
        $food = $food->paginate(6);
        $image_food = ImageFood::all();
        return view('admin.page.food.index', compact('food', 'foodtype', 'image_food'));
    }
    public function store(StoreRequest $request)
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
            $foodtype = $this->foodtype::all();
            $list_images = ImageFood::where('food_id', $id)->get();
            $files = [];
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
                    $files = $this->UploadMultiImage('image_food', $request->file('filenames'));
                }
                if (isset($request->images_uploaded)) {
                    $path_url_image = [];
                    foreach (json_decode($request->images_uploaded_origin) as $key => $value) {
                        $path_url_image[] = $value->image;
                    }
                    $files_remove = array_diff($path_url_image, $request->images_uploaded);
                    // $files = array_merge($request->images_uploaded, $files);
                } else {
                    $files_remove = [];
                    foreach (json_decode($request->images_uploaded_origin) as $key => $value) {
                        $files_remove[] = $value->image;
                    }
                }
                $update = $this->food->find($id)->update($param);
                if ($update) {
                    //Delete Image
                    foreach ($files_remove as $key => $value) {
                        $deleteImage = $this->DeleteImage($value);
                        $delete = ImageFood::where('image', $value)->delete();
                        $force = ImageFood::onlyTrashed()->where('image', $value)->forceDelete();
                    }
                    //Insert Image
                    foreach ($files as $key => $value) {
                        ImageFood::create(['food_id' => $id, 'image' => $value]);
                    }
                    notify()->success('Update success');
                    return redirect()->route('admin.food.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.food.index');
                }
            }
            return view('admin.page.food.update', compact('fd', 'foodtype', 'list_images'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Food::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.food.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.food.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $image_food = ImageFood::all();
        $foodtype = $this->foodtype::all();
        $food = Food::onlyTrashed();
        if ($request->search != '') {
            $food = Food::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $food = $food->get();
        if (empty($food)) {
            $food = $food->toQuery()->paginate(6);
        }
        return view('admin.page.food.trash', compact('food', 'foodtype', 'image_food'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Food::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.food.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.food.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = Food::withTrashed()->where('id', $id)->first()->image;
            $image_remove = ImageFood::where('food_id', $id)->get();
            foreach ($image_remove as $key => $value) {
                $deleteImage = $this->DeleteImage($value);
                $delete = ImageFood::where('image', $value)->delete();
                $force = ImageFood::onlyTrashed()->where('image', $value)->forceDelete();
            }
            $deleteImage = $this->DeleteImage($image);
            $delete = Food::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.food.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.food.trash');
            }
        }
    }
}
