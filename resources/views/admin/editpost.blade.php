<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::check() && Auth::user()->usertype == 'admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('Dashboard') }}
            @endif
        </h2>

        @section('content')
            <div class="container mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-header">
                                Edit Post
                                <a href="{{ route('admin.allpost') }}" class="btn btn-sm btn-secondary float-end">Back</a>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.updatepost', ['id' => $blog->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $blog->title) }}" placeholder="Enter title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="published-at" class="form-label">Published At <span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" name="published_at" id="published-at"
                                            class="form-control @error('published_at') is-invalid @enderror"
                                            value="{{ old('published_at', $blog->published_at) }}">
                                        @error('published_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content <span
                                                class="text-danger">*</span></label>
                                        <textarea name="content" id="content" rows="4"
                                            class="form-control summernote @error('content') is-invalid @enderror">{{ old('content', $blog->content) }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
            <script>
                $(function() {
                    $('#content').summernote({
                        placeholder: 'Write your content here...',
                        tabsize: 2,
                        height: 200,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview']]
                        ]
                    });
                });
            </script>
        @endsection
    </x-slot>

</x-app-layout>
