@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>

    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <div class="justify-content-md-start">
                <a class="btn btn-outline-success" href="{{ route('admin.room.index') }}"><i class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-primary" href="{{ route('admin.room.trash') }}">Trash</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.room.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <div class="form-text text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <label for="inputRoomType" class="form-label">RoomType</label>
                    <select class="form-select" id="inputRoomType" name="room_type_id" aria-label="Default select example">
                        @foreach ($roomtype as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputNumberFloor" class="form-label">NumberFloor</label>
                    <select class="form-select" id="inputNumberFloor" name="number_floor"
                        aria-label="Default select example">
                        <option value="1">Floor 1</option>
                        <option value="2">Floor 2</option>
                        <option value="3">Floor 3</option>
                        <option value="4">Floor 4</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">File Image</label>
                    <input type="file" class="@error('image') is-invalid @enderror form-control" name="image"
                        id="image" accept="image/*">
                </div>
                <div class="col-md-6">
                    <img id="image_preview" style="width: 350px ; height:200px"
                        src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                        alt="User">
                </div>
                <div class="col-md-6">
                    <label for="image" class="form-label">Image Description</label>
                    <div class="list-input-hidden-upload hidden">
                        <input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden">
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-success btn-add-image" type="button"><i
                                class="fa-solid fa-plus mx-2"></i>Add image</button>
                    </div>
                </div>
                <div class="list-images">
                    @if (isset($list_images) && !empty($list_images))
                        @foreach (json_decode($list_images) as $key => $img)
                            <div class="box-image">
                                <input type="hidden" name="images_uploaded[]" value="{{ $img }}"
                                    id="img-{{ $key }}">
                                <img src="{{ asset('files/' . $img) }}" class="picture-box">
                                <div class="wrap-btn-delete"><span data-id="img-{{ $key }}"
                                        class="btn-delete-image"><i class="fa-solid fa-xmark"></i></span></div>
                            </div>
                        @endforeach
                        <input type="hidden" name="images_uploaded_origin" value="{{ $list_images }}">
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif
                </div>
                <div class="col-md-12">
                    <div id="table" class="row ">
                        <label for="table">
                            <h1>
                                <strong class="bg-light rounded-end my-2 pl-1 pr-5">Table</strong>
                            </h1>
                        </label>
                        <div class="col-md-4">
                            <label for="inputQuantityTable" class="form-label">Quantity Table</label>
                            <input type="text" class="form-control" name="quantity_table" id="inputQuantityTable"
                                value="{{ old('quantity_table') }}">
                            @if ($errors->has('quantity_table'))
                                <div class="form-text text-danger">{{ $errors->first('quantity_table') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="inputQuantityPeople" class="form-label">Quantity People / Table</label>
                            <input type="text" class="form-control" name="quantity_people" id="inputQuantityPeople"
                                value="{{ old('quantity_people') }}">
                            @if ($errors->has('quantity_people'))
                                <div class="form-text text-danger">{{ $errors->first('quantity_people') }}</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea">{{ old('description') }}</textarea>
                        <label for="floatingTextarea">Description</label>
                        @if ($errors->has('description'))
                            <div class="form-text text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="statusRoom">Status</label>
                    <div id="statusRoom">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                value="1" checked>
                            <label class="form-check-label" for="inlineRadio1">Is active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="2">
                            <label class="form-check-label" for="inlineRadio2">Is maintained</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </form>
        </div>
    </div>
@endsection
