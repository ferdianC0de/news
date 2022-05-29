@extends('admin.layout.app')
@section('content')
<div class="py-12 px-20">
    @if(Session::has('message'))
        <div class="bg-green-300 text-green-700 rounded px-2 py-3">
            {{Session::get('message')}}
        </div>
    @endif
    <form method="post" action="{{route('category.store')}}">
        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Title
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="title" class="form-control p-0 border-0 @error('title') border-red-500 @enderror" placeholder="Title" value="{{old('title', $category->title ?? '')}}">
                        </div>
                        @error('title')
                            <div class="text-red-600">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="btn btn-success inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Category
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush
