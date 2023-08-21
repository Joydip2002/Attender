@foreach ($semesterStudent as $student)
<tr>
    <th>{{ $student->name }}</th>
    <td>{{ $student->email }}</td>
    <td>{{ $student->semester }}</td>
    <td class="p"><input type="checkbox" name="" id=""></td>
    <td class="bsc hidden"><input type="checkbox" name="" id=""></td>
</tr>
@endforeach