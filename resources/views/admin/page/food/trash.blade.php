@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                method="POST" action="{{ route('admin.admin.trash') }}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="justify-content-md-end">
                <a class="btn btn-primary" href="{{ route('admin.admin.index') }}"><i class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-success" href="{{ route('admin.admin.store') }}"><i
                        class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            @empty($admins)
                {{ $admins->links() }}
            @endempty
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($admins as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>{{ asset(Storage::url($item->image)) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    @foreach ($role as $r)
                                        @if ($r->id == $item->role_id)
                                            {{ $r->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($department as $d)
                                        @if ($d->id == $item->department_id)
                                            {{ $d->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-outline-warning  mx-1"
                                            href="{{ route('admin.admin.restore', ['id' => $item->id]) }}"
                                            role="button"><i class="fa-solid fa-reply"></i></a>
                                        <a class="btn btn-outline-danger  mx-1" href="#" role="button"
                                            data-target="#deleteModal{{ $item->id }}" data-toggle="modal"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Delete <strong
                                                            class="text-danger">{{ $item->name }}</strong> ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">If you press delete it will be permanently deleted
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('admin.admin.force', ['id' => $item->id]) }}">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <a class="btn btn-outline-warning" href="#" role="button">Link</a> --}}
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
            @empty($admins)
                {{ $admins->links() }}
            @endempty


        </div>


    </div>
@endsection
