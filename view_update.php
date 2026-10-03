<?php
$f = 'resources/views/backend/message/index.blade.php';
$c = file_get_contents($f);

$filterButtons = '
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="m-0 font-weight-bold text-primary">Complaints & Messages</h5>
    <div>
      <a href="{{ route(\'message.index\') }}" class="btn btn-outline-secondary btn-sm">All</a>
      <a href="{{ route(\'message.index\', [\'type\' => \'text\']) }}" class="btn btn-outline-info btn-sm">Text Complaints</a>
      <a href="{{ route(\'message.index\', [\'type\' => \'voice\']) }}" class="btn btn-outline-warning btn-sm">Voice Complaints</a>
    </div>
  </div>
';

// Replace <h5 class="card-header">Messages</h5>
$c = preg_replace('/<h5 class="card-header">Messages<\/h5>/', $filterButtons, $c);

// Add Content/Message column
$c = preg_replace('/<th scope="col">Subject<\/th>/', '<th scope="col">Subject</th><th scope="col">Content</th>', $c);

// Add row content for Content/Message
$rowContent = '
          <td>
            @if(str_contains($message->subject, \'Voice Complaint\'))
                {!! str_replace(\'<br>\', \'\', $message->message) !!}
            @else
                {{ \Illuminate\Support\Str::limit($message->message, 50) }}
            @endif
          </td>
';

$c = preg_replace('/<td>\{\{\$message->subject\}\}<\/td>/', '<td>{{$message->subject}}</td>' . $rowContent, $c);

file_put_contents($f, $c);
echo "Message index updated.\n";
?>
