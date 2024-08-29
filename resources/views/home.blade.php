@extends('layouts.app')

@section('content')

<div class="container">
<div id="responseMessage"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 card-header">
                        <p class="text-primary">PHP Simple TO Do List APP</p>
                    </div>

                    <div class="col-md-6 card-header">

                        <form id="taskForm" class="row row-cols-lg-auto g-3">
                            @csrf
                            <div class="col">
                                <input
                                    type="text" class="form-control" id="inline-form-name" name="title"
                                    placeholder="Task">
                            </div>



                            <div class="col">
                                <button type="submit" class="btn btn-primary" id="add_task">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
              
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($tasks as $key =>$task )

                          
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $task->title }}</td>
                                    <td> <span class="badge rounded-pill {{ $task->completed == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $task->completed == 1 ? 'completed' : 'Non completed' }}
                                        </span></td>
                                    <td>
                                    <form action="{{ route('tasks.change',$task->id) }}" method="POST" style="display:inline;"  onsubmit="return confirm('Are you sure you want to change the status?');">
                                            @csrf
                                            @method('post')
                                            <button type="submit" style="border:1px solid #fff;background-color:green;color:#fff;"><i class="fa fa-check" aria-hidden="true"></i>                                            </button>
                                        </form>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;"  onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color:red;color:#fff; border:1px solid #fff" ><i  class="fa fa-trash" aria-hidden="true"></i></button>
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
</div>
<script>
    $(document).ready(function() {

        $('#taskForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            // Collect form data
            var formData = $(this).serialize();
            var url = "{{ route('tasks.store') }}";

            // Perform AJAX request
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#responseMessage').html('<p style="color:green">' + response.message + '</p>');
                        // Optionally clear the form or redirect
                        $('#taskForm')[0].reset();
                        $('#tbody').html(response.body);

                    } else {
                        con
                        $('#responseMessage').html(response.message);
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += '<p>' + value[0] + '</p>';
                    });
                    $('#responseMessage').html(errorMessages);
                }
            });
        });
    });

 
</script>
@endsection