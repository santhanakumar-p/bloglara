<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::check() && Auth::user()->usertype == 'admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('User Dashboard') }}
            @endif
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!--  all post   -->
                        <h1 style="color: #333; text-align: center; margin-bottom: 30px;">Posts Management</h1>

                        <div style="overflow-x: auto;">
                            <table
                                style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                                <thead>
                                    <tr style="background-color: #4CAF50; color: white;">
                                        <th style="padding: 12px 15px; text-align: left;">ID</th>
                                        <th style="padding: 12px 15px; text-align: left;">Title</th>
                                        <th style="padding: 12px 15px; text-align: left;">Content</th>
                                        <th style="padding: 12px 15px; text-align: left;">Image</th>
                                        <th style="padding: 12px 15px; text-align: left;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $posts)
                                        <tr style="border-bottom: 1px solid #ddd;">
                                            <td style="padding: 12px 15px;">{{ $posts->id }}</td>
                                            <td style="padding: 12px 15px;">{{ $posts->title }}</td>
                                            <td style="padding: 12px 15px;">{{ Str::limit($posts->content, 50) }}...</td>
                                            <td style="padding: 12px 15px;"><img style="width: 100px; height: 100px;"
                                                    src="{{ asset('uploads/' . $posts->image) }}" alt="{{ $posts->image }}">
                                            <td>
                                                <a href="{{ route('admin.editpost', ['id' => $posts->id]) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>

                                                <form action="{{ route('admin.destroypost', ['id' => $posts->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this blog?');"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
