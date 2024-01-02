@extends('client.index')
@section('content')
    @include('client.page.page-main.home')

    <main id="main">

        <!-- ======= About Section ======= -->
        @include('client.page.page-main.about')

        <!-- ======= Whu Us Section ======= -->
        @include('client.page.page-main.why_us')


        <!-- ======= Menu Section ======= -->
        @include('client.page.page-main.menu')


        <!-- ======= Specials Section ======= -->
        @include('client.page.page-main.specials')


        <!-- ======= Events Section ======= -->
        @include('client.page.page-main.events')


        <!-- ======= Book A Table Section ======= -->
        @include('client.page.page-main.book-a-table')


        <!-- ======= Gallery Section ======= -->
        @include('client.page.page-main.gallery')


        <!-- ======= Chefs Section ======= -->
        @include('client.page.page-main.chef')


        <!-- ======= Testimonials Section ======= -->
        @include('client.page.page-main.testimonials')


        <!-- ======= Contact Section ======= -->
        @include('client.page.page-main.contact')


    </main>
@endsection
