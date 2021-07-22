@extends('app')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					<h5 class="card-title text-center">Task List</h5>
					{{ $tasks = Session::get('tasks') }}
					@foreach ($tasks as $task)
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Task</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">{{ $task->id }}</th>
								<td>{{ $task->task }}</td>
								<td>{{ $task->status }}</td>
							</tr>
						</tbody>
					</table>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection