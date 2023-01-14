@extends('dashboard.layouts.master')

@section('title', $titlePage)

@section('content')
    <!-- Start Flash Message -->
    @include('dashboard.components.flash_msg')
    <!-- End Flash Message -->

    <!-- Start Content Body -->
    <section class="content-body mb-5">
        <div class="card">
            <div class="card-header">
                <h2>{{ $titlePage }}</h2>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('dashboard.posts.update', $post->id) }}" enctype="multipart/form-data">
                    @include('dashboard.posts.components.form')
                </form>
            </div>
        </div>
    </section>
    <!-- End Content Body -->

@endsection
