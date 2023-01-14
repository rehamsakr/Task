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

                @if(!request()->routeIs('dashboard.posts.trashed'))
                    <div class="add-new">
                        <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> @lang('crud.add') @lang('translation.post')
                        </a>

                        <a href="{{ route('dashboard.posts.trashed') }}" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> @lang('translation.trashed')
                        </a>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 250px">@lang('translation.title')</th>
                            @if(auth()->user()->isAdmin())
                            <th nowrap>@lang('translation.author')</th>
                            @endif
                            <th nowrap>@lang('crud.created_at')</th>
                            <th nowrap>@lang('crud.actions')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($posts as $get)
                            <tr>
                                <td>{{ $get->id }}</td>

                                <td nowrap>
                                    <img width="40" height="40" class="img-thumbnail" loading="lazy" onerror="imgError(this);" src="{{ $get->image_for_web }}">
                                    {{ str_limit($get->title, 25) }}
                                </td>

                                @if(auth()->user()->isAdmin())
                                    <td nowrap>{{ str_limit($get->author->username ?? '', 25) }}</td>
                                @endif

                                <td nowrap>{{ $get->date_for_web }}</td>

                                <td nowrap>
                                    <a href="{{ route('dashboard.comments.index') }}?post_id={{ $get->id }}" title="@lang('translation.comments_count')" class="btn mr-2 btn-icon btn-sm btn-outline-warning position-relative">
                                        <i class="fa-regular fa-comment"></i>
                                        @if($get->comments_count)
                                            <span class="badge-count">{{ $get->comments_count }}</span>
                                        @endif
                                    </a>

                                    @if(!$get->trashed)
                                        <a href="{{ route('dashboard.posts.edit', $get->id) }}" title="@lang('crud.edit')" class="btn mr-2 btn-icon btn-sm btn-outline-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    <button title="@lang('crud.delete')" data-url="{{ route('dashboard.posts.delete', $get->id) }}" class="btn btn-icon btn-sm btn-outline-danger confirmActionItem">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="10">{{ __('translation.no_data') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
    <!-- End Content Body -->

    <!-- Form Action JS -->
    <form id="action-form" style="display:none;" method="post">@csrf</form>
@endsection
