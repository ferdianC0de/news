@extends('admin.layout.app')
@section('content')
<table id="myTable" class="display table shadow sm:rounded-md sm:overflow-hidden bg-white">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Activity</th>
        </tr>
    </thead>
    <tbody>
        @forelse($logs as $log)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$log->user_id.' - '.$log->user->name}}</td>
                <td>{{$log->activity}}</td>
            </tr>
        @empty
            <tr><td colspan="5">No categories to display</td></tr>
        @endforelse
    </tbody>
</table>
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
