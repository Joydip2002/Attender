<div>
    &nbsp;
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container d-flex justify-content-center flex-column flex-wrap shadow-lg rounded-1 py-3 my-2">
    <div class="container d-flex justify-content-center flex-column col-10">
        <h4>Add ClassRoom</h4>
    </div>
    <form class="container d-flex justify-content-center flex-column col-10" id="classform">
        {{-- @csrf --}}
        <label for="">Subject Name</label>
        <input type="text" name="subjectname" id="subjectname" class="form-control" placeholder="Enter Your Name">
        <label for="">Add Semester</label>
        <select name="semester" id="semester" class="form-control">
            <option value="">Select Semester</option>
            <option value="S-I">S-I</option>
            <option value="S-II">S-II</option>
            <option value="S-III">S-III</option>
            <option value="S-IV">S-IV</option>
            <option value="S-V">S-V</option>
            <option value="S-VI">S-VI</option>
        </select>
        <label for="">Add Year</label>
         <input type="number" name="year" id="year" class="form-control" placeholder="Add Year">

        <button type="button" class="btn btn-primary w-100 mt-3" onclick="addSem()">Add</button>
    </form>
</div>
