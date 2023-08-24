<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <h5><strong>Class List</strong></h5>
    <table class="table">
        <thead>
            @php
                $number = 1;
            @endphp
            <tr>
                <th>Sl No</th>
                <th>Semester Name</th>
                <th>Semester Year</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semester as $sem)
                <tr>
                    <td>{{ $number}}</td>
                    <td>{{ $sem->subject }}</td>
                    <td>{{ $sem->semestername }}</td>
                    <td>{{ $sem->semesteryear }}</td>
                    {{-- <td>{{$sem->status}}</td> --}}
                    <td>
                        @if ($sem->status == 'Active')
                            <button type="button" class="btn btn-danger"
                                onclick="classInactive({{ $sem->id }})">Inactive</button>
                        @else
                            <button type="button" class="btn btn-success"
                                onclick="classActive({{ $sem->id }})">Active</button>
                        @endif
                        {{-- <button type="button" class="btn btn-warning" onclick="studentUpdate({{$stu->id}})">Update</button> --}}
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
