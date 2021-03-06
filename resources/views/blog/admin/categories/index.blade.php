@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-togglable-md navbar-light bg-faded">
                    <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-primary">+Add</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Parent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paginator as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <a href="{{ route('blog.admin.categories.edit', $category->id) }}">
                                                {{ $category->title }}
                                            </a>
                                        </td>
                                        <td @if(in_array($category->parent_id, [0, 1])) style="color: #ccc" @endif>
                                            {{ $category->parent_id }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
