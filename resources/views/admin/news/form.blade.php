@extends('admin.layout.app')
@section('content')
<div class="py-12 px-20">
    @if(Session::has('message'))
        <div class="bg-green-300 text-green-700 rounded px-2 py-3">
            {{Session::get('message')}}
        </div>
    @endif
    <form method="post" action="{{route('news.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2 py-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Title
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="title" class="form-control p-0 border-0 @error('title') border-red-500 @enderror" placeholder="Title" value="{{old('title')}}">
                        </div>
                        @error('title')
                            <div class="text-red-600">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col-sm-12 border-bottom py-2">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Category') }}
                        </label>
                        <select name="category_id" class="form-select shadow-none p-0 border-0">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id')==$category->id ? 'selected':''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 py-2">
                        <label for="formFile" class="form-label inline-block mb-2 text-gray-700">{{ __('Image') }}</label>
                    <input class="form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile" name="image">
                    @error('image')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
                    </div>



                    <div class="col-span-3 sm:col-span-2 py-2">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Content') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <textarea name="content" id="content" class="form-control" rows="8">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <div class="text-red-600">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="btn btn-success inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create News
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.3/tinymce.min.js" integrity="sha512-DB4Mu+YChAdaLiuKCybPULuNSoFBZ2flD9vURt7PgU/7pUDnwgZEO+M89GjBLvK9v/NaixpswQtQRPSMRQwYIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw',
        });
    </script>
@endpush
