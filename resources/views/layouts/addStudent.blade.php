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
                <td><button type="button" class="btn btn-success">Granted</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>