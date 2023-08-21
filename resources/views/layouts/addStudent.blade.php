<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $stu)
            <tr>
                <td>{{$stu->name}}</td>
                <td>{{$stu->email}}</td>
                <td>{{$stu->semester}}</td>
                <td>
                    @if ($stu->status == 'active')
                        <button type="button" class="btn btn-danger" onclick="studentDenied({{$stu->id}})">Denied</button>
                    @else
                        <button type="button" class="btn btn-success" onclick="studentGranted({{$stu->id}})">Granted</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>