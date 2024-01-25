<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest\StoreRequest;
use App\Http\Requests\AdminRequest\UpdateRequest;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash, Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->admins = new Admin();
        $this->department = new Department();
        $this->role = new Role();
    }
    public function index(Request $request)
    {
        $department = $this->department::all();
        $role = $this->role::all();
        $admin = $this->admins;
        if ($request->search != '') {
            $admin = $this->admins->where('name', 'Like', "%{$request->search}%")->orWhere('username', 'Like', "%{$request->search}%");
        }
        if ($request->department != 0) {
            $admin = $this->admins->where('department_id', $request->department);
        }
        $admin = $admin->paginate(6);
        return view('admin.page.admin.index', compact('admin', 'department', 'role'));
    }
    public function store(StoreRequest $request)
    {
        $department = $this->department::all();
        $role = $this->role::all();
        if ($request->isMethod('post')) {
            $param = $request->except('_token');
            $param['password'] = Hash::make($request->password);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = $this->UploadImage('image_admin', $request->file('image'));
            }
            $store = $this->admins->create($param);
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.admin.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.admin.store');
            }
        }
        return view('admin.page.admin.store', compact('department', 'role'));
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $department = $this->department::all();
            $role = $this->role::all();
            $dep = $this->admins->find($id);
            if ($request->isMethod('post')) {
                $param = $request->except('_token');
                $param['image'] = $dep->image;
                $param['password'] = Hash::make($request->password);
                if ($request->hasFile('image') && $request->file('image')) {
                    $deleteImage = $this->DeleteImage($dep->image);
                    if ($deleteImage) {
                        $param['image'] = $this->UploadImage('image_admin', $request->file('image'));
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
            $delete = Admin::find($id)->delete();
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
        $department = $this->department::all();
        $role = $this->role::all();
        $admins = Admin::onlyTrashed();
        if ($request->search != '') {
            $admins = Admin::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $admins = $admins->get();
        if (empty($admins)) {
            $admins = $admins->toQuery()->paginate(6);
        }
        return view('admin.page.admin.trash', compact('admins', 'role', 'department'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Admin::withTrashed()->where('id', $id)->restore();
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
            $image = Admin::withTrashed()->where('id', $id)->first()->image;
            $deleteImage = $this->DeleteImage($image);
            $delete = Admin::withTrashed()->where('id', $id)->forceDelete();
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
