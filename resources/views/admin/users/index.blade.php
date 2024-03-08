@extends('admin.app')

@section('title')
    List Siswa
@endsection

@section('content')
    <h1 class="mt-4">List Siswa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">List Siswa</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Siswa
            <a href="{{ route('student.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('student.destroy', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('student.edit', ['id' => $user->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
