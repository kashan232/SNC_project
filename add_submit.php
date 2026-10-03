<?php
$f = 'app/Http/Controllers/MessageController.php';
$c = file_get_contents($f);

$method = '
    public function submitComplain(Request $request)
    {
        $message = new Message();
        $message->name = $request->name ?? \'Unknown\';
        $message->phone = $request->phone ?? \'Unknown\';
        $message->email = $request->email ?? \'no-email@example.com\';
        
        $type = $request->feedback_type; // \'voice\' or \'text\'
        if ($type == \'voice\') {
            $message->subject = "Voice Complaint - Branch: " . ($request->branch ?? \'N/A\');
            
            if ($request->hasFile(\'audio\')) {
                $file = $request->file(\'audio\');
                $filename = time() . \'_\' . uniqid() . \'.webm\';
                // Move to public/storage/complaints (make sure this works, or just public/complaints)
                $file->move(public_path(\'storage/complaints\'), $filename);
                $url = asset(\'storage/complaints/\' . $filename);
                $message->message = "Voice Complaint: <br><audio controls><source src=\'{$url}\' type=\'audio/webm\'></audio>";
            } else {
                $message->message = "Voice Complaint (No Audio File Attached)";
            }
        } else {
            $message->subject = "Text Complaint - Branch: " . ($request->branch ?? \'N/A\') . " - Channel: " . ($request->channel ?? \'N/A\');
            $message->message = $request->message ?? \'No Message\';
            
            if ($request->hasFile(\'attachment\')) {
                $file = $request->file(\'attachment\');
                $filename = time() . \'_\' . uniqid() . \'.\' . $file->getClientOriginalExtension();
                $file->move(public_path(\'storage/complaints\'), $filename);
                $message->photo = asset(\'storage/complaints/\'.$filename);
            }
        }
        
        $message->save();
        
        return response()->json([\'status\' => \'success\', \'message\' => \'Feedback submitted successfully.\']);
    }
';

// Insert before the last closing brace
$c = preg_replace('/}(?!.*})/s', $method . "\n}", $c);
file_put_contents($f, $c);
echo "MessageController updated.\n";
?>
