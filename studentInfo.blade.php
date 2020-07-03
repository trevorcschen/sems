<table class="table table-bordered table-hover table-striped  table-condesed">
    <caption>{{$classes[0]->program }}</caption>
    <thread>
        <tr>
            <th>#</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Birth Date</th>
        </tr>
    </thread>
    <tbody>
    @foreach($classes as $key => $c)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ sprintf("%05d",$c->student_id}}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->sex }}</td>
            <td>{{ $c->dob }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
