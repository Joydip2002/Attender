@foreach ($semesterStudent as $student)
<tr>
    {{-- <th>{{$student->id}}</th> --}}
    <th>{{ $student->name }}</th>
    <td>{{ $student->email }}</td>
    <td>{{ $student->semester }}</td>
    <td class="p"><input type="checkbox" name="id" id="" value="{{$student->id}}" class="scheckbox"></td>
    {{-- <td class="bsc hidden"><input type="checkbox" name="" ></td> --}}
</tr>
@endforeach