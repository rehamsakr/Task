@csrf
<div class="row">
    <div class="col-md-12">
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label for="post_id" class="form-label">@lang('translation.post') <span class="text-danger">*</span></label>
                    <select id="post_id" class="form-control" name="post_id">
                        <option value="">@lang('crud.choose') @lang('translation.post')</option>
                        @foreach($posts as $post)
                            <option {{ old('post_id', $comment->post_id ?? '') == $post->id ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="user_id" class="form-label">@lang('translation.user') <span class="text-danger">*</span></label>
                    <select id="user_id" class="form-control" name="user_id">
                        <option value="">@lang('crud.choose') @lang('translation.user')</option>
                        @foreach($users as $user)
                            <option {{ old('user_id', $comment->user_id ?? '') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="comment" class="form-label">@lang('translation.comment') <span class="text-danger">*</span></label>
                    <textarea required
                           rows="6"
                           type="text"
                           class="form-control @error('comment') is-invalid @enderror"
                           id="comment"
                           name="comment"
                           placeholder="@lang('crud.enter') @lang('translation.comment')"
                    >{{ old('comment', $comment->comment ?? '') }}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row search-actions">
    <div class="col-md-12">
        <button type="submit" id="submit" class="btn btn-primary">
            <i class="fa-regular fa-floppy-disk"></i>
            @lang('crud.submit')
        </button>
        &nbsp;&nbsp;

        <a href="{{ route('dashboard.comments.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-xmark"></i>
            @lang('crud.cancel')
        </a>
    </div>
</div>
