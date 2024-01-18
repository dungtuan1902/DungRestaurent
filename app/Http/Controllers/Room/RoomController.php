<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\ImageRoom;
use App\Models\TableRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->room = new Room();
        $this->roomtype = new RoomType();
    }
    public function index(Request $request)
    {
        $room = $this->room;
        $roomtype = $this->roomtype::all();
        if ($request->search != '') {
            $room = $room->where('name', 'Like', "%{$request->search}%")->orWhere('ingredient', 'Like', "%{$request->search}%");
        }
        if (isset($request->roomtype)) {
            $room = $room->where('room_type_id', $request->roomtype);
        }
        $room = $room->paginate(6);
        $image_room = ImageRoom::all();
        return view('admin.page.room.index', compact('room', 'roomtype', 'image_room'));
    }
    public function store(Request $request)
    {
        $roomtype = $this->roomtype::all();
        if ($request->isMethod('post')) {
            $param = $request->except('_token', 'quantity_people');
            $param['quantity_table'] = (int) $request->quantity_table;
            $param['number_floor'] = (int) $request->number_floor;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_room', $request->file('image'));
            }
            if ($request->hasFile('filenames') && $request->file('filenames')) {
                $array_image = $this->UploadMultiImage('image_room', $request->file('filenames'));
            }
            $store = $this->room->create($param);
            if ($store) {
                foreach ($array_image as $key => $item) {
                    $image = [
                        'room_id' => $store->id,
                        'image' => $item
                    ];
                    ImageRoom::create($image);
                }
                for ($i = 0; $i < (int) $param['quantity_table']; $i++) {
                    $number_table = (100 * (int) $request->number_floor) + $i;
                    $table = TableRoom::create(['room_id' => $store->id, 'number_table' => $number_table, 'quantity_people' => $request->quantity_people]);
                }
                notify()->success('Store success');
                return redirect()->route('admin.room.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.room.store');
            }
        }
        return view('admin.page.room.store', compact('roomtype'));
    }
    public function update(Request $request, $id)
    {
        if ($id) {
            $fd = $this->room->find($id);
            $roomtype = $this->roomtype::all();
            $list_images = ImageFood::where('room_id', $id)->get();
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
                    $files = $this->UploadMultiImage('image_room', $request->file('filenames'));
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
                $update = $this->room->find($id)->update($param);
                if ($update) {
                    //Delete Image
                    foreach ($files_remove as $key => $value) {
                        $deleteImage = $this->DeleteImage($value);
                        $delete = ImageFood::where('image', $value)->delete();
                        $force = ImageFood::onlyTrashed()->where('image', $value)->forceDelete();
                    }
                    //Insert Image
                    foreach ($files as $key => $value) {
                        ImageFood::create(['room_id' => $id, 'image' => $value]);
                    }
                    notify()->success('Update success');
                    return redirect()->route('admin.room.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.room.index');
                }
            }
            return view('admin.page.room.update', compact('fd', 'roomtype', 'list_images'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Food::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.room.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.room.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $image_room = ImageFood::all();
        $roomtype = $this->roomtype::all();
        $room = Food::onlyTrashed();
        if ($request->search != '') {
            $room = Food::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $room = $room->get();
        if (empty($room)) {
            $room = $room->toQuery()->paginate(6);
        }
        return view('admin.page.room.trash', compact('room', 'roomtype', 'image_room'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Food::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.room.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.room.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = Food::withTrashed()->where('id', $id)->first()->image;
            $image_remove = ImageFood::where('room_id', $id)->get();
            foreach ($image_remove as $key => $value) {
                $deleteImage = $this->DeleteImage($value);
                $delete = ImageFood::where('image', $value)->delete();
                $force = ImageFood::onlyTrashed()->where('image', $value)->forceDelete();
            }
            $deleteImage = $this->DeleteImage($image);
            $delete = Food::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.room.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.room.trash');
            }
        }
    }
}
