<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodType;
use Storage, Auth, Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function main()
    {
        $food = $this->menu();
        $gallery = $this->gallery();
        return view('client.page.main', compact('food', 'gallery'));
    }
    public function menu()
    {
        $food_type = FoodType::all();
        $food = Food::all();
        return ['food_type' => $food_type, 'food' => $food];
    }
    public function gallery()
    {
        $image = \File::allFiles(public_path('storage/image_room'));
        $image_name = [];
        foreach ($image as $key => $value) {
            $filename = explode('_', $value->getFilename());
            $image_name[] = $filename[1];
        }
        $result = [];
        $image_unique = array_unique($image_name);
        foreach ($image_unique as $key => $value) {
            for ($i = 0; $i < count($image); $i++) {
                if ($key == $i) {
                    $result[] = $image[$i]->getFilename();
                }
            }
        }
        return array_slice($result, 3);
    }
    public function profile()
    {
        return view('client.page.user.profile');
    }
    public function update_profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            $param['image'] = Auth::guard('web')->user()->image;
            if ($request->hasFile('image') && $request->file('image')) {
                $deleteImage = $this->DeleteImage(Auth::guard('web')->user()->image);
                if ($deleteImage || Auth::guard('web')->user()->image == '') {
                    $param['image'] = $this->UploadImage('image_user', $request->file('image'));
                }
            }

            $update = User::find(Auth::guard('web')->user()->id)->update($param);
            if ($update) {
                notify()->success('Update success');
                return redirect()->route('client.profile');
            } else {
                notify()->error('Update error');
                return redirect()->route('client.profile');
            }
        }
        return view('client.page.user.update_profile');
    }
}
