@extends('layouts.admin')

@section('main-content')
<div class="container mt-4">
    <div class="head d-flex justify-content-between align-items-center">
        <h2 class="mb-1">Your Leave</h2>
    <a href="#" data-toggle="modal" data-target="#addModal" class="d-flex btn btn-md btn-primary shadow-sm">
        Apply For Leave</a>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Apply for Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave.apply') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="reason">Reason for leave:</label>
                            <textarea class="form-control" id="reason" name="reason" required>{{ old('reason') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="from">From:</label>
                            <input type="date" class="form-control" id="from" name="from" required>
                        </div>
                        <div class="form-group">
                            <label for="till">Till:</label>
                            <input type="date" class="form-control" id="till" name="till" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<hr class="mt-4">
        <table class="table">
            <div class="table-responsive">
            <thead style="background-color: #4e73df; color: white;">
                <tr>
                    <th>Name</th>
                    <th>Reason for Leave</th>
                    <th>From:</th>
                    <th>Till:</th>
                    <div>
                        @error('from')
                            <span style="color: red; font-weight: bold;"> {{ $message }} </span><br />
                        @enderror
                    </div>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests->sortByDesc('created_at') as $leave)
                    @if($leave->user_id === auth()->id())

                        <tr>
                            <td>{{$leave->user->name }}</td>
                            <td>{{$leave->reason}}</td>
                            <td>{{$leave->from}}</td>
                            <td>{{$leave->till}}</td>
                            <td>{{$leave->status}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
 
        </table>
    </div>
        
    </div>
</div>
@endsection