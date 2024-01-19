<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancellationPolicyRequest\StoreRequest;
use App\Http\Requests\CancellationPolicyRequest\UpdateRequest;
use App\Models\CancellationPolicy;
use Illuminate\Http\Request;

class CancellationPolicyController extends Controller
{
    public function __construct()
    {
        $this->cancellation = new CancellationPolicy();
    }
    public function index(Request $request)
    {
        $cancellations = $this->cancellation;
        if ($request->search != '') {
            $cancellations = $this->cancellation->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $cancellations = $cancellations->paginate(6);
        return view('admin.page.cancellation.index', compact('cancellations'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $store = $this->cancellation->create($request->except('_token'));
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.cancellation.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.cancellation.store');
            }
        }
        return view('admin.page.cancellation.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $dep = $this->cancellation->find($id);
            if ($request->isMethod('post')) {
                $update = $this->cancellation->find($id)->update($request->except('_token'));
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.cancellation.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.cancellation.update', ['id' => $id]);
                }
            }
            return view('admin.page.cancellation.update', compact('dep'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = CancellationPolicy::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.cancellation.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.cancellation.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $cancellations = CancellationPolicy::onlyTrashed();
        if ($request->search != '') {
            $cancellations = CancellationPolicy::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $cancellations = $cancellations->get();
        if (empty($cancellations)) {
            $cancellations = $cancellations->toQuery()->paginate(6);
        }
        return view('admin.page.cancellation.trash', compact('cancellations'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = CancellationPolicy::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.cancellation.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.cancellation.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = CancellationPolicy::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.cancellation.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.cancellation.trash');
            }
        }
    }
}
