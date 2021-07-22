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
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
					<label class="form-check-label" for="inlineRadio1">Pending</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">Done</label>
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
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

	$('#create-task').on('submit',function(e){
		e.preventDefault();

		let task = $('#task').val();
		let status = ($("#inlineRadio1").prop("checked") == true ? 'Done' : 'Pending');

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
				window.location = "{{ route('dashboard') }}";
			},
		});
	});

	$('form').submit(function(e) {
		var id = $(this).prop('id');
		
		e.preventDefault();

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
	});

</script>
@endsection