@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>

    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <div class="justify-content-md-start">
                <a class="btn btn-outline-success" href="{{ route('admin.food.index') }}"><i class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-primary" href="{{ route('admin.food.trash') }}">Trash</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.food.update', ['id' => $fd->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="inputName" value="{{ $fd->name }}">
                    @if ($errors->has('name'))
                        <div class="form-text text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputPrice" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="inputPrice" value="{{ $fd->price }}">
                    @if ($errors->has('price'))
                        <div class="form-text text-danger">{{ $errors->first('price') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputFoodType" class="form-label">FoodType</label>
                    <select class="form-select" id="inputFoodType" name="food_type_id" aria-label="Default select example">
                        @foreach ($foodtype as $d)
                            <option value="{{ $d->id }}" {{ $fd->food_type_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="inputIngredient" class="form-label">Ingredient </label>
                    <input type="text" class="form-control" name="ingredient" id="inputIngredient"
                        value="{{ $fd->ingredient }}">
                    @if ($errors->has('ingredient'))
                        <div class="form-text text-danger">{{ $errors->first('ingredient') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="image" class="form-label">File Image</label>
                    <input type="file" class="@error('image') is-invalid @enderror form-control" name="image"
                        id="image" accept="image/*">
                </div>
                <div class="col-md-6">
                    <img id="image_preview" style="width: 350px ; height:200px" src="{{ Storage::url($fd->image) }}"
                        alt="Loading....">
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
                        @foreach ($list_images as $key => $img)
                            <div class="box-image">
                                <input type="hidden" name="images_uploaded[]" value="{{ $img->image }}"
                                    id="img-{{ $key }}">
                                <img src="{{ Storage::url($img->image) }}" class="picture-box">
                                <div class="wrap-btn-delete"><span data-id="img-{{ $key }}"
                                        class="btn-delete-image"><i class="fa-solid fa-xmark"></i></span></div>
                            </div>
                        @endforeach
                        <input type="hidden" name="images_uploaded_origin" value="{{ $list_images }}">
                        {{-- <input type="hidden" name="id" value="{{ $fd->id }}"> --}}
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea">{{ $fd->description }}</textarea>
                        <label for="floatingTextarea">Description</label>
                        @if ($errors->has('description'))
                            <div class="form-text text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
