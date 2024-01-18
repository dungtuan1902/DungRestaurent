@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>

    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <div class="justify-content-md-start">
                <a class="btn btn-outline-success" href="{{ route('admin.roomtype.index') }}"><i
                        class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-primary" href="{{ route('admin.roomtype.trash') }}">Trash</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.roomtype.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <div class="form-text text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Price </label>
                    <input type="text" class="form-control" name="price" id="inputPrice" value="{{ old('price') }}">
                    @if ($errors->has('price'))
                        <div class="form-text text-danger">{{ $errors->first('price') }}</div>
                    @endif
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
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label for="inputDrinkType" class="form-label">Ulitity</label>
                        @foreach ($ulitity as $ul)
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="ulitity[]" value="{{$ul['id']}}" id="flexSwitchCheckDefault{{$ul['id']}}">
                                <label class="form-check-label" for="flexSwitchCheckDefault{{$ul['id']}}">{{$ul['name']}}</label>
                            </div>
                        @endforeach

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
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </form>
        </div>
    </div>
@endsection
