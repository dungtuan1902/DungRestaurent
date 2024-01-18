@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                method="POST" action="{{ route('admin.roomtype.index') }}">
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
                <a class="btn btn-primary" href="{{ route('admin.roomtype.trash') }}">Trash</a>
                <a class="btn btn-outline-success" href="{{ route('admin.roomtype.store') }}"><i
                        class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            {{ $roomtype->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Ulitity</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Ulitity</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roomtype as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><img width="150px" height="100px" class="img-fluid"
                                        src="{{ asset(Storage::url($item->image)) }}" alt="Uploading "></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @foreach ($ulitity as $ul)
                                        @if ($ul->room_type_id == $item->id)
                                            @foreach ($configUlitity as $config)
                                                @if ($config['id'] == (int) $ul->name)
                                                    <li>{{ $config['name'] }}</li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-outline-warning  mx-1"
                                            href="{{ route('admin.roomtype.update', ['id' => $item->id]) }}"
                                            role="button"><i class="fa-regular fa-pen-to-square"></i></a>
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
                                                <div class="modal-body">If you press the delete button it will go to the
                                                    junk folder</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('admin.roomtype.delete', ['id' => $item->id]) }}">Trash
                                                        to move </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>

            {{ $roomtype->links() }}

        </div>


    </div>
@endsection
