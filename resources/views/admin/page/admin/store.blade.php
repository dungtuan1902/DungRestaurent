@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>

    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <div class="justify-content-md-start">
                <a class="btn btn-outline-success" href="{{ route('admin.admin.index') }}"><i class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-primary" href="{{ route('admin.admin.trash') }}">Trash</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.admin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <div class="form-text text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="inputPhone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <div class="form-text text-danger">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputDepartment" class="form-label">Department</label>
                    <select class="form-select" id="inputDepartment" name="department_id"
                        aria-label="Default select example">
                        @foreach ($department as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="inputAddress"
                        value="{{ old('address') }}">
                    @if ($errors->has('address'))
                        <div class="form-text text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="inputUsername"
                        value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <div class="form-text text-danger">{{ $errors->first('username') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="inputPassword"
                        value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <div class="form-text text-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <div class="form-text text-danger">{{ $errors->first('email') }}</div>
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
                <div class="col-md-6">
                    <label for="inputRole" class="form-label">Role</label>
                    <div id="inputRole" class=" d-flex">
                        @foreach ($role as $r)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role_id"
                                    id="inlineRadio{{ $r->id }}" value="{{$r->id}}">
                                <label class="form-check-label"
                                    for="inlineRadio{{ $r->id }}">{{ $r->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </form>
        </div>
    </div>
@endsection
