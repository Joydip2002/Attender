{{-- Modal --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="uname" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="uemail" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="uphone" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Gender</label>
                            <input type="radio" name="gender" id="ugender1" value="M">Male
                            <input type="radio" name="gender" id="ugender2" value="F">Female
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        <input type="hidden" id="hiddenid">
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChangesStudent()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<div class="container">
    <h5><strong>Student Registration Records</strong></h5>
    <table class="table">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Semester</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $number = 1;
            @endphp
            @foreach ($students as $stu)
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $stu->name }}</td>
                    <td>{{ $stu->email }}</td>
                    <td>{{ $stu->semester }}</td>
                    <td>{{ $stu->address }}</td>
                    <td>
                        @if ($stu->status == 'active')
                            <button type="button" class="btn btn-danger"
                                onclick="studentDenied({{ $stu->id }})">Denied</button>
                        @else
                            <button type="button" class="btn btn-success"
                                onclick="studentGranted({{ $stu->id }})">Granted</button>
                        @endif
                        <button type="button" class="btn btn-warning"
                            onclick="studentUpdate({{ $stu->id }})">Update</button>
                    </td>
                </tr>
                @php
                    $number++;
                @endphp
            @endforeach
        </tbody>
    </table>
    {{-- <div class="container text-center">
        {{ $students->links('pagination::bootstrap-5') }}
    </div> --}}
</div>
