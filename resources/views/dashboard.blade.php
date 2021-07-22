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
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					<h5 class="card-title text-center">Task List</h5>
					@foreach (Session::get('tasks') as $task)
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