<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest\StoreRequest;
use App\Http\Requests\ServiceRequest\UpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->service = new Service();
    }
    public function index(Request $request)
    {
        $services = $this->service;
        if ($request->search != '') {
            $services = $this->service->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $services = $services->paginate(6);
        return view('admin.page.service.index', compact('services'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $store = $this->service->create($request->except('_token'));
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.service.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.service.store');
            }
        }
        return view('admin.page.service.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $dep = $this->service->find($id);
            if ($request->isMethod('post')) {
                $update = $this->service->find($id)->update($request->except('_token'));
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.service.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.service.update', ['id' => $id]);
                }
            }
            return view('admin.page.service.update', compact('dep'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = Service::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.service.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.service.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $services = Service::onlyTrashed();
        if ($request->search != '') {
            $services = Service::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $services = $services->get();
        if (empty($services)) {
            $services = $services->toQuery()->paginate(6);
        }
        return view('admin.page.service.trash', compact('services'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = Service::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.service.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.service.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = Service::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.service.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.service.trash');
            }
        }
    }
}
