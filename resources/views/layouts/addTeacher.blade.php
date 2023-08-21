<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->gender }}</td>
                    <td>{{ $teacher->address}}</td>
                    <td>
                        @if ($teacher->status == 'active')
                            <button type="button" class="btn btn-danger"
                                onclick="deniedTeacher({{ $teacher->id }})">Denied</button>
                        @else
                            <button type="button" class="btn btn-success"
                                onclick="grantedTeacher({{ $teacher->id }})">Granted</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
