@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <x-alert/>
                    <br>
                    <div>
                    <h2 class="text-2xl pb-4"> User Records</h2>
                    <div class="flex justify-end">
                    <input type="button" value="Add New" class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 border rounded" data-toggle="modal" data-target="#addModal"/>
                    </div>
                    </div>

                    <div>
                        <table class="table" id="table_format">
                            <thead>
                                <tr> 
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th> Email</th>
                                    <th>Experience</th>

                                    <th data-orderable="false">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)

                                <tr>
                                    <td><img src="{{asset('storage/user_images/'.$user->avatar)}}" height="24px" width="24px" alt="Noimage"> </td>
                                    <td>{{$user->name}} </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->experience}} Months</td>
                                    <td> <span class="fas fa-times px-2 py-1  cursor-pointer" onClick="event.preventDefault();
                                                                                                            if(confirm('Are you sure you want to delete')){
                                                                                                                document.getElementById('fm-delete-{{$user->id}}').submit();
                                                                                                            }"> Remove </span>

                                        <form method="POST" id="{{'fm-delete-'.$user->id}}" action="{{route('user.destroy',$user->id)}}"
                                            style="display:none">
                                            @csrf
                                            @method('delete')

                                        </form>
                                    </td>
                                   


                                </tr>



                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- BEGIN MODAL -->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                        aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h1 class="modal-title w-100" id="addModalLabel">Add New Record</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                @csrf
                                <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputEmail3">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputName">Full Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputPassword3">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputDateJoining">Date of Joining</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="date_joining" id="inputDateJoining" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputDateLeaving">Date of Leaving</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="date_leaving" id="inputDateLeaving" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="inputFile">Upload Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="avatar" id="inputFile" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="still_working"  value="1"/> Still Working
                                                </label>
                                            </div>
                                        </div>
                                    </div>
               
                
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="submit" class="btn btn-primary">Save </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function () {
        var dataTable = $('#table_format').DataTable({
            "ordering": true,
            "info": true,
            "lengthChange": false,
            "sDom": 'ltipr'
        });

        $("#filterbox").keyup(function () {
            dataTable.search(this.value).draw();
        });

    });


</script>
