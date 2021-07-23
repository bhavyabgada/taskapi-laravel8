@extends('app')

@section('body')





<div class="container py-4">
	<header class="pb-3 mb-4 border-bottom">
		<a href="/" class="d-flex align-items-center text-dark text-decoration-none">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2 mr-3" viewBox="0 0 118 94" role="img"><title>Dashboard</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
			<span class="fs-4">Dashboard</span>
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
		</a>
	</header>

	<div class="p-5 mb-4 bg-light rounded-3">
		<div class="container-fluid py-5">
			<h3 class="display-5 fw-bold">Add New Task</h3>
			<form id="create-task">
				<div class="row">
					<div class="col">
						<label class="form-check-label" for="task">Task</label>
						<input type="text" class="form-control" placeholder="Task" id="task" name="task">
					</div>
					<div class="col">
						<label class="form-check-label" for="status">Status:</label>							

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
							<label class="form-check-label" for="inlineRadio1">Pending</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
							<label class="form-check-label" for="inlineRadio2">Done</label>
						</div>
					</div>
					<div class="col">
						<button type="submit" class="btn btn-primary">Add</button>								
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="p-5 mb-4 bg-light rounded-3">
		<div class="container-fluid py-5">
			<h3 class="display-5 fw-bold">Task List</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Task</th>
						<th scope="col">Status</th>
						<th scope="col">Update</th>

					</tr>
				</thead>
				<tbody>

					@foreach ($tasks as $task)
					<tr>
						<th scope="row">{{ $task->id }}</th>
						<td>{{ $task->task }}</td>
						<td>{{ $task->status }}</td>
						<td>
							<form id="{{ $task->id }}">
								<div class="row">
									<div class="form-check form-check-inline">
										<input type="hidden" class="form-check-input" name="taskid" id="taskid{{ $task->id }}" value="{{ $task->id }}">
										<input type="hidden" class="form-check-input" name="status" id="status{{ $task->id }}" value="{{ $task->status }}">
									</div>
									<div class="col">
										<button type="submit" class="btn btn-success">Change</button>								
									</div>
								</div>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>




	
	<footer class="pt-3 mt-4 text-muted border-top">
		&copy; 2021
	</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

	function create_task(){
		let task = $('#task').val();
		let status = '';
		if($("#inlineRadio2").prop("checked") == true)
			status = 'Done';
		else if ($("#inlineRadio1").prop("checked") == true)
			status = 'Pending';

		$.ajax({
			url: "/api/task/add",
			type:"POST",
			headers:{
				"Accept":"application/json",
				"Authorization":"Bearer {{ $token }}",
				"Content-Type":"application/x-www-form-urlencoded",
			},
			data:{
				task:task,
				status:status,
			},
			success:function(response){
				console.log(response);
				// window.location = "{{ route('dashboard') }}";
			},
		});
	}

	function update_task(id) {
		let status = $("#status"+id).val();

		if(status!='Done')
			status = 'Done'
		else
			status = 'Pending'
		

		$.ajax({
			url: "/api/task/status/"+id,
			type:"POST",
			headers:{
				"Accept":"application/json",
				"Authorization":"Bearer {{ $token }}",
				"Content-Type":"application/x-www-form-urlencoded",
			},
			data:{
				status:status,
			},
			success:function(response){
				console.log(response);
				window.location = "{{ route('dashboard') }}";
			},
		});
	}

	$('form').submit(function(e) {
		e.preventDefault();
		var id = $(this).prop('id');

		if (id = 'create-task')
			create_task()
		else
			update_task(id)
	});

</script>
@endsection