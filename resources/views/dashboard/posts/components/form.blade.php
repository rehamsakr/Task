@csrf
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="title" class="form-label">@lang('translation.title') <span class="text-danger">*</span></label>
                    <input required
                           type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title', $post->title ?? '') }}"
                           placeholder="@lang('crud.enter') @lang('translation.title')">
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('translation.content') <span class="text-danger">*</span></label>
                    <textarea required
                           rows="6"
                           type="text"
                           class="form-control @error('content') is-invalid @enderror"
                           id="content"
                           name="content"
                           placeholder="@lang('crud.enter') @lang('translation.content')"
                    >{{ old('content', $post->content ?? '') }}</textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image" class="form-label">
                                @lang('translation.image')
                                @if(!isset($post)) <span class="text-danger">*</span> @endif
                            </label>
                            <input
                                {{ !isset($post) ? 'required' : '' }}
                                type="file"
                                accept="image/png, image/jpeg, image/gif, image/webp"
                                class="filepond @error('image') is-invalid @enderror"
                                id="image"
                                name="image"
                                placeholder="@lang('crud.choose') @lang('translation.image') "
                            >
                        </div>
                    </div>
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

        <a href="{{ route('dashboard.posts.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-xmark"></i>
            @lang('crud.cancel')
        </a>
    </div>
</div>


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/filepond.min.css') }}">
@endsection

@section('js')
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="{{ asset('assets/js/filepond.min.js') }}"></script>



    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginImageValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        // get a reference to the input element
        const inputElement = document.querySelector('.filepond');

        // create a FilePond instance at the input element location
        const pond = FilePond.create(inputElement, {
            // maxFiles: 10,
            allowImageValidateSize: true,
            checkValidity: true,
            allowFileTypeValidation: true,
            storeAsFile: true,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/webp'],
        });
    </script>
@endsection
