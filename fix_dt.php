<?php
$f = 'resources/views/backend/message/index.blade.php';
$c = file_get_contents($f);

// Update targets:[4] to targets:[5]
$c = str_replace('"targets":[4]', '"targets":[5]', $c);

// Design enhancement for show.blade.php
$f2 = 'resources/views/backend/message/show.blade.php';
$c2 = file_get_contents($f2);

$betterShow = '
@extends(\'backend.layouts.master\')
@section(\'main-content\')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Complaint Details</h6>
  </div>
  <div class="card-body">
    @if($message)
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Name:</th>
                        <td>{{$message->name}}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{$message->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{$message->phone}}</td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td>{{$message->created_at->format(\'F d, Y h:i A\')}}</td>
                    </tr>
                    <tr>
                        <th>Subject:</th>
                        <td><span class="badge badge-primary" style="font-size:14px;">{{$message->subject}}</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 text-center">
                @if($message->photo && !str_contains($message->photo, \'webm\'))
                <a href="{{$message->photo}}" target="_blank">
                    <img src="{{$message->photo}}" class="img-fluid rounded border" style="max-height: 200px;">
                    <br><small>View Attachment</small>
                </a>
                @endif
            </div>
        </div>
        
        <hr/>
        
        <div class="p-3 bg-light rounded border">
            <h5 class="font-weight-bold">Message Content:</h5>
            <div class="mt-3" style="font-size: 16px; line-height: 1.6;">
                {!! $message->message !!}
            </div>
        </div>

    @endif
  </div>
</div>
@endsection
';

file_put_contents($f2, $betterShow);
echo "Done.\n";
?>
