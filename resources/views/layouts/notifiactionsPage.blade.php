<div class="container">
    <h5><strong>Teacher Registration Records</strong></h5>
    <table class="table">
        <thead>
            @php
                $number = 1;
            @endphp
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notifiaction)
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $notifiaction->name }}</td>
                    <td>{{ $notifiaction->email }}</td>
                    <td>{{ $notifiaction->gender }}</td>
                    <td><button>Read</button></td>
                </tr>
                @php
                    $number++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>
