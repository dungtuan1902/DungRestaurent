@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                method="POST" action="{{ route('admin.room.index') }}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2" name="search">
                    <select class="form-select bg-white border-0 small" name="roomtype" aria-label="Default select example"
                        aria-describedby="basic-addon2">
                        <option>
                        </option>
                        @foreach ($roomtype as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>

                </div>
            </form>
            <div class="justify-content-md-end">
                <a class="btn btn-primary" href="{{ route('admin.room.trash') }}">Trash</a>
                <a class="btn btn-outline-success" href="{{ route('admin.room.store') }}"><i
                        class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            {{ $room->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity Table</th>
                            <th>Floor</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity Table</th>
                            <th>Floor</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($room as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><img width="150px" height="100px" class="img-fluid"
                                        src="{{ asset(Storage::url($item->image)) }}" alt="Uploading "></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity_table }}</td>
                                <td>{{ $item->number_floor }}</td>
                                <td>
                                    @foreach ($roomtype as $ft)
                                        @if ($ft->id == $item->room_type_id)
                                            {{ $ft->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-outline-warning  mx-1"
                                            href="{{ route('admin.room.update', ['id' => $item->id]) }}" role="button"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                        <a class="btn btn-outline-danger  mx-1" href="#" role="button"
                                            data-target="#deleteModal{{ $item->id }}" data-toggle="modal"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                        <a class="btn btn-outline-success mx-1" href="#" role="button"
                                            data-target="#viewModal{{ $item->id }}" data-toggle="modal"><i
                                                class="fa-solid fa-info"></i></a>
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
                                                        href="{{ route('admin.room.delete', ['id' => $item->id]) }}">Trash
                                                        to move </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Food <strong
                                                            class="text-success">{{ $item->name }}</strong> ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="row g-0">
                                                            <div class="col-md-6">
                                                                <img src="{{ Storage::url($item->image) }}"
                                                                    class="img-fluid rounded-start" alt="Loading">
                                                                <div class="d-flex">
                                                                    @foreach ($image_room as $if)
                                                                        @if ($item->id == $if->room_id)
                                                                            <div>
                                                                                <a href="{{ Storage::url($if->image) }}"
                                                                                    target="_blank"
                                                                                    rel="noopener noreferrer"><img
                                                                                        src="{{ Storage::url($if->image) }}"
                                                                                        class="w-100 h-100"
                                                                                        alt=""></a>

                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card-body">
                                                                    <h1 class="card-title uppercase">
                                                                        <strong>{{ $item->name }}</strong>
                                                                    </h1>
                                                                    </p>
                                                                    <p class="card-text">RoomType :
                                                                        @foreach ($roomtype as $ft)
                                                                            @if ($ft->id == $item->room_type_id)
                                                                                {{ $ft->name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                    <p class="card-text">Number Floor :
                                                                        {{ $item->number_floor }}</p>
                                                                    <p class="card-text">Description :
                                                                        {{ $item->description }}</p>
                                                                    <p class="card-text "> Status :
                                                                        <strong
                                                                            class="px-2 py-1 rounded-pill text-white {{ $item->status == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $item->status == 1 ? 'Is Active' : 'Is maintained' }}</strong>
                                                                    </p>
                                                                    <div class="row" id="table_room">
                                                                        <label for="table_room">Table :</label>
                                                                        @foreach ($table_room as $table)
                                                                            <div class="col">
                                                                                @if ((int) $table->room_id == $item->id)
                                                                                    <p
                                                                                        class="px-2 py-1 rounded-pill bg-success text-center text-white">
                                                                                        {{ $table->number_table }}</p>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
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

            {{ $room->links() }}

        </div>


    </div>
@endsection
