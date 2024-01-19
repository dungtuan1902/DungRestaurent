@extends('admin.index')
@section('content_fluid')
    <h1 class="h3 mb-2 text-gray-800">
        Tables</h1>

    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-grid gap-2 d-md-flex">
            <div class="justify-content-md-start">
                <a class="btn btn-outline-success" href="{{ route('admin.cancellation.index') }}"><i
                        class="fa-solid fa-list"></i></a>
                <a class="btn btn-outline-primary" href="{{ route('admin.cancellation.trash') }}">Trash</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.cancellation.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="inputTitle" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="form-text text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="content" id="floatingTextarea">{{ old('content') }}</textarea>
                        <label for="floatingTextarea">Description</label>
                        @if ($errors->has('content'))
                            <div class="form-text text-danger">{{ $errors->first('content') }}</div>
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
