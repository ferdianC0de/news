@extends('admin.layout.app')
@section('content')
<div class="py-12 px-20">
    @if(Session::has('message'))
        <div class="bg-green-300 text-green-700 rounded px-2 py-3">
            {{Session::get('message')}}
        </div>
    @endif
    <div class="grid justify-items-stretch my-3">
        <a href="{{route('category.create')}}" class="btn btn-success inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 justify-self-end">
            <span class="fas fa-plus"></span>
            Create Category
        </a>
    </div>
    <table id="myTable" class="display table shadow sm:rounded-md sm:overflow-hidden bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$category->title}}</td>
                    <td>
                        <div class="row">
                            <form method="post" action="{{route('category.destroy', [$category->id])}}" id="deleteForm{{$category->id}}" class="flex">
                                <a href="{{route('category.edit', [$category->id])}}" class="btn btn-warning" style="color: black !important"><span class="fas fa-edit"></span> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete?')) {document.getElementById('deleteForm{{$category->id}}').submit();} else {return false;} "><span class="fas fa-trash-alt"></span> Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No categories to display</td></tr>
            @endforelse
        </tbody>
    </table>
        <div class="my-3">
            {{$categories->links()}}
        </div>
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
