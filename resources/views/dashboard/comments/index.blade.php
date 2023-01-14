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

                <a href="{{ route('dashboard.comments.create') }}" class="btn btn-primary add-new">
                    <i class="fa-solid fa-plus"></i> @lang('crud.add') @lang('translation.comment')
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 250px">@lang('translation.comment')</th>
                            <th nowrap>@lang('translation.post')</th>
                            <th nowrap>@lang('translation.user')</th>
                            <th nowrap>@lang('crud.created_at')</th>
                            <th nowrap>@lang('crud.actions')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($comments as $get)
                            <tr>
                                <td>{{ $get->id }}</td>

                                <td nowrap>{{ str_limit($get->comment, 30) }}</td>

                                <td nowrap>
                                    <span style="border-width: 2px !important;" class="rounded border-bottom border-success {{ $get->post?->trashed ? 'border-danger' : '' }} d-inline-block">
                                        [{{ str_limit($get->post?->title, 20) }}]
                                    </span>
                                </td>

                                <td nowrap>{{ str_limit($get->user->username ?? '', 25) }}</td>

                                <td nowrap>{{ $get->date_for_web }}</td>

                                <td nowrap>
                                    <a href="{{ route('dashboard.comments.edit', $get->id) }}" title="@lang('crud.edit')" class="btn mr-2 btn-icon btn-sm btn-outline-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button title="@lang('crud.delete')" data-url="{{ route('dashboard.comments.delete', $get->id) }}" class="btn btn-icon btn-sm btn-outline-danger confirmActionItem">
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

                {{ $comments->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
    <!-- End Content Body -->

    <!-- Form Action JS -->
    <form id="action-form" style="display:none;" method="post">@csrf</form>
@endsection
