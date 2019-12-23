@foreach ($exams as $exam)
	<a href="{{$exam->path()}}">{{$exam->name}}</a> br
@endforeach