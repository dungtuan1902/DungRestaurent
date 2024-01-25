@extends('client.index')
@section('content')
    {{-- @include('client.page.page-main.home') --}}
    <main id="main">
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center bg-light rounded-pill py-2 border">{{ Auth::guard('web')->user()->name }}</h1>
                    </div>
                </div>
                <form action="{{route('client.update_profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">

                                    <img id="image_preview"
                                        src="{{ Auth::guard('web')->user()->image ? Storage::url(Auth::guard('web')->user()->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    <div class="my-2">
                                        <input type="file" class="@error('image') is-invalid @enderror form-control"
                                            name="image" id="image" accept="image/*">
                                    </div>
                                    <h5 class="my-3">{{ Auth::guard('web')->user()->username }}</h5>
                                    <p class="text-muted mb-4">{{ Auth::guard('web')->user()->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="border-0 w-100"
                                                value="{{ Auth::guard('web')->user()->name }}">
                                            {{-- <p class="text-muted mb-0">{{ Auth::guard('web')->user()->name }}</p> --}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="email"class="border-0 w-100"
                                                value="{{ Auth::guard('web')->user()->email }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone"class="border-0 w-100"
                                                value="{{ Auth::guard('web')->user()->phone }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="address"class="border-0 w-100"
                                                value="{{ Auth::guard('web')->user()->address }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
