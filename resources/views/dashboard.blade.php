@extends('app')

@section('body')
<div class="container">
	@if (Route::has('login'))
	<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
		@auth
		<a href="{{ route('logout') }}" class="text-sm text-gray-700 underline">Log out</a>
		@else
		<a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
		<a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Log in </a>
		@if (Route::has('register'))
		<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
		@endif
		@endauth
	</div>
	@endif
	<div class="row">
		<h5 class=" text-center">Add New Task</h5>

		<form id="create-task">
			<div class="row">
				<div class="col">
					<label class="form-check-label" for="task">Task</label>
					<input type="text" class="form-control" placeholder="Task" id="task" name="task">
				</div>
				<div class="col">
					<label class="form-check-label" for="status">Status:</label>							
				</div>
				<div class="col form-control form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pending" id="pending" value="Pending">
					<label class="form-check-label" for="pending">Pending</label>
				</div>
				<div class="col form-control form-check form-check-inline">
					<input class="form-check-input" type="radio" name="done" id="done" value="Done">
					<label class="form-check-label" for="done">Done</label>
				</div>
				<div class="col">
					<button type="submit" class="btn btn-primary">Add</button>								
				</div>
			</div>
		</form>
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					
					<h5 class="card-title text-center">Task List</h5>

					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Task</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($tasks as $task)
							<tr>
								<th scope="row">{{ $task->id }}</th>
								<td>{{ $task->task }}</td>
								<td>{{ $task->status }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

	$('#create-task').on('submit',function(e){
		e.preventDefault();

		let task = $('#task').val();
		let status = ($("#done").prop("checked") == true ? 'Done' : 'Pending');

		$.ajax({
			url: "/api/task/add",
			type:"POST",
			headers:{
				"Accept":"application/json",
				"Authorization": "Bearer {{ $token }}"
			},
			data:{
				// "_token": "{{ csrf_token() }}",
				task:task,
				status:status,
			},
			success:function(response){
				console.log(response);
				window.location = {{ route('dashboard') }}
			},
		});
		// var url = "http://laravel8-auth.herokuapp.com/api/task/add";

		// var xhr = new XMLHttpRequest();
		// xhr.open("POST", url);

		// xhr.setRequestHeader("Accept", "application/json");
		// xhr.setRequestHeader("Authorization", "Bearer {{ $token }}");
		// xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// xhr.onreadystatechange = function () {
		// 	if (xhr.readyState === 4) {
		// 		console.log(xhr.status);
		// 		console.log(xhr.responseText);
		// 	}};

		// 	var data = "task="+task+"&status="+status;

		// 	xhr.send(data);
		// });
		// window.location.reload();
	</script>
	@endsection