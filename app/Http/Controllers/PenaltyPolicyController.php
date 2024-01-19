<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyPolicyRequest\StoreRequest;
use App\Http\Requests\PenaltyPolicyRequest\UpdateRequest;
use App\Models\PenaltyPolicy;
use Illuminate\Http\Request;

class PenaltyPolicyController extends Controller
{
    public function __construct()
    {
        $this->penalty = new PenaltyPolicy();
    }
    public function index(Request $request)
    {
        $penaltys = $this->penalty;
        if ($request->search != '') {
            $penaltys = $this->penalty->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $penaltys = $penaltys->paginate(6);
        return view('admin.page.penalty.index', compact('penaltys'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $store = $this->penalty->create($request->except('_token'));
            if ($store) {
                notify()->success('Store success');
                return redirect()->route('admin.penalty.store');
            } else {
                notify()->error('Store error');
                return redirect()->route('admin.penalty.store');
            }
        }
        return view('admin.page.penalty.store');
    }
    public function update(UpdateRequest $request, $id)
    {
        if ($id) {
            $dep = $this->penalty->find($id);
            if ($request->isMethod('post')) {
                $update = $this->penalty->find($id)->update($request->except('_token'));
                if ($update) {
                    notify()->success('Update success');
                    return redirect()->route('admin.penalty.index');
                } else {
                    notify()->error('Update error');
                    return redirect()->route('admin.penalty.update', ['id' => $id]);
                }
            }
            return view('admin.page.penalty.update', compact('dep'));
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $delete = PenaltyPolicy::find($id)->delete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.penalty.index');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.penalty.index');
            }
        }
    }
    public function trash(Request $request)
    {
        $penaltys = PenaltyPolicy::onlyTrashed();
        if ($request->search != '') {
            $penaltys = PenaltyPolicy::onlyTrashed()->where('name', 'Like', "%{$request->search}%")->orWhere('description', 'Like', "%{$request->search}%");
        }
        $penaltys = $penaltys->get();
        if (empty($penaltys)) {
            $penaltys = $penaltys->toQuery()->paginate(6);
        }
        return view('admin.page.penalty.trash', compact('penaltys'));
    }
    public function restore($id)
    {
        if ($id) {
            $delete = PenaltyPolicy::withTrashed()->where('id', $id)->restore();
            if ($delete) {
                notify()->success('Restore success');
                return redirect()->route('admin.penalty.index');
            } else {
                notify()->error('Restore error');
                return redirect()->route('admin.penalty.index');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = PenaltyPolicy::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                notify()->success('Delete success');
                return redirect()->route('admin.penalty.trash');
            } else {
                notify()->error('Delete error');
                return redirect()->route('admin.penalty.trash');
            }
        }
    }
}
