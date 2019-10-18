@extends('layouts.app')

@section('content')
<div class="row">
    <table class="table table-light manage-photo">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Checkbox</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Belong User</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($photos as $index => $photo)
                <tr>
                    <td>{{ $index }}</td>
                    <td><input type="checkbox" aria-label="Checkbox for each photo" name="photo_{{ $photo->user_id }}"></td>
                    <td>
                        <a href=""><img class="img-thumbnail" src="uploads/photos/{{ $photo->user_id }}/{{ $photo->image }}" alt="photo"></a>
                    </td>
                    <td>{{ $photo->description }}</td>
                    <td><a href="{{ route('users.show', $photo->user_id) }}">{{ $photo->user->name }}</a></td>
                    <td>
                        <a href="" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection