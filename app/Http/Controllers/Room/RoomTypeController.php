<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest\StoreRequest;
use App\Http\Requests\RoomTypeRequest\UpdateRequest;
use App\Models\RoomType;
use App\Models\UlitityRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        $this->roomtype = new RoomType();
        $this->ulitity = new UlitityRoom();
    }
    public function index(Request $request)
    {
        $roomtype = $this->roomtype;
        $ulitity = $this->ulitity::all();
        $configUlitity = Config::get('ulitity');
        // dd($ulitity,$configUlitity);
        if ($request->search != '') {
            $roomtype = $roomtype->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $roomtype = $roomtype->paginate(6);
        return view('admin.page.roomtype.index', compact('roomtype', 'ulitity', 'configUlitity'));
    }
    public function store(StoreRequest $request)
    {
        $ulitity = Config::get('ulitity');
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_room', $request->file('image'));
            }

            $store = $this->roomtype->create($param);
            if ($store) {
                foreach ($param['ulitity'] as $key => $value) {
                    $ulitityStore = $this->ulitity->create(['room_type_id' => $store->id, 'name' => $value]);
                }
                notify()->success('Store success');
                return redirect()->route('admin.roomtype.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.roomtype.store');
            }
        }
        return view('admin.page.roomtype.store', compact('ulitity'));
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $roomtype = $this->roomtype->find($id);
            $ulitity = Config::get('ulitity');
            $ulitityRoom = $this->ulitity->where('room_type_id', $id)->get();
            $ulitityValueChecked = [];
            foreach ($ulitityRoom as $key => $value) {
                $ulitityValueChecked[] = (int) $value->name;
            }
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $ulitityNew = $request->ulitity;
                $arrayUlitityInsert = array_diff($ulitityNew, $ulitityValueChecked);
                $arrayUlitityRemove = array_diff($ulitityValueChecked, $ulitityNew);
                if ($arrayUlitityInsert != []) {
                    foreach ($arrayUlitityInsert as $key => $value) {
                        $insert = UlitityRoom::create(['room_type_id' => $id, 'name' => $value]);
                    }
                }
                if ($arrayUlitityRemove != []) {
                    foreach ($arrayUlitityRemove as $key => $value) {
                        $delete = UlitityRoom::where('room_type_id', $id)->where('name', $value)->delete();
                        $force = UlitityRoom::withTrashed()->where('room_type_id', $id)->where('name',(string) $value)->forceDelete();
                    }
                }
                $param['image'] = $roomtype->image;
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($roomtype->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_room', $request->file('image'));
                    }
                }
                $update = $this->roomtype->find($id)->update($param);
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.roomtype.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.roomtype.index');
                }
            }
            return view('admin.page.roomtype.update', compact('roomtype', 'ulitity', 'ulitityValueChecked'));
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $delete = RoomType::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.roomtype.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.roomtype.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $ulitity = $this->ulitity::all();
        $configUlitity = Config::get('ulitity');
        $roomtype = RoomType::onlyTrashed();
        if ($request->search != '') {
            $roomtype = RoomType::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $roomtype = $roomtype->get();
        if (empty($roomtype)) {
            $roomtype = $roomtype->toQuery()->paginate(6);
        }
        return view('admin.page.roomtype.trash', compact('roomtype', 'ulitity', 'configUlitity'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = RoomType::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.roomtype.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.roomtype.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $image = RoomType::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $deleteUlitity = UlitityRoom::where('room_type_id', $id)->delete();
            $force = UlitityRoom::withTrashed()->where('room_type_id', $id)->forceDelete();
            $delete = RoomType::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.roomtype.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.roomtype.trash');
            }
        }
    }
}
