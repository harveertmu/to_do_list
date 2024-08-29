
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