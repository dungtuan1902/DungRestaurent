<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest\StoreRequest;
use App\Http\Requests\DepartmentRequest\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Department;
use Session;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->department = new Department();
    }
    public function index(Request $request)
    {
        $dep = $this->department;
        if ($request->search != '') {
            $dep = $this->department->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $dep = $dep->paginate(6);
        return view('admin.page.department.index', compact('dep'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $store = $this->department->create($request->except('_token'));
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.department.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.department.store');
            }
        }
        return view('admin.page.department.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $dep = $this->department->find($id);
            if ($request->isMethod('post')) {
                $update = $this->department->find($id)->update($request->except('_token'));
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.department.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.department.update',['id'=>$id]);
                }
            }
            return view('admin.page.department.update',compact('dep'));
        }
      
    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Department::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.department.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.department.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $dep = Department::onlyTrashed();
        if ($request->search != '') {
            $dep = Department::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $dep = $dep->get();
        if (empty($dep)) {
            $dep = $dep->toQuery()->paginate(6);
        }
        return view('admin.page.department.trash', compact('dep'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Department::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.department.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.department.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = Department::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.department.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.department.trash');
            }
        }
    }
}
