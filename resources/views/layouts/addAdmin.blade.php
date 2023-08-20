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
            @foreach ($admins as $admin)
            <tr>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->gender}}</td>
                <td>{{$admin->semester}}</td>
                <td><button type="button" class="btn btn-success">Granted</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>