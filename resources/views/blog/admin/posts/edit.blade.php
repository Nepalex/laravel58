@extends('layouts.app')

@section('content')
    @php  /* @var \App\Models\BlogPost $item  */ @endphp

    <div class="container">

        @include('blog.admin.posts.includes.result_messages')

    @if($item->exists)
            <form method="POST" action="{{route('blog.admin.posts.update', $item->id )}}">
            @method('PATCH')
    @else
            <form method="POST" action="{{route('blog.admin.posts.store')}}">
    @endif
        @csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.posts.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.posts.includes.item_edit_add_col')
                </div>
            </div>

        </form>
         @if($item->exists)

            <form method="POST" action="{{route('blog.admin.posts.destroy', $item->id )}}">
            @method('DELETE')
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Удалить</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
            @endif

    </div>
@endsection
