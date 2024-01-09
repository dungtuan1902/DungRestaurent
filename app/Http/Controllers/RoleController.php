<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest\StoreRequest;
use App\Http\Requests\RoleRequest\UpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->role = new Role();
    }
    public function index(Request $request)
    {
        $roles = $this->role;
        if ($request->search != '') {
            $roles = $this->role->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $roles = $roles->paginate(6);
        return view('admin.page.role.index', compact('roles'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $store = $this->role->create($request->except('_token'));
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.role.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.role.store');
            }
        }
        return view('admin.page.role.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $dep = $this->role->find($id);
            if ($request->isMethod('post')) {
                $update = $this->role->find($id)->update($request->except('_token'));
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.role.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.role.update', ['id' => $id]);
                }
            }
            return view('admin.page.role.update', compact('dep'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Role::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.role.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.role.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $roles = Role::onlyTrashed();
        if ($request->search != '') {
            $roles = Role::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $roles = $roles->get();
        if (empty($roles)) {
            $roles = $roles->toQuery()->paginate(6);
        }
        return view('admin.page.role.trash', compact('roles'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Role::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.role.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.role.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = Role::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.role.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.role.trash');
            }
        }
    }
}
