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
                <td>{{$teacher->name}}</td>
                <td>{{$teacher->email}}</td>
                <td>{{$teacher->gender}}</td>
                <td>{{$teacher->semester}}</td>
                <td><button type="button" class="btn btn-success">Granted</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>