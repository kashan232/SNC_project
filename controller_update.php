<?php
$f = 'app/Http/Controllers/MessageController.php';
$c = file_get_contents($f);

// Update index method
$indexMethod = '
    public function index(Request $request){
        $query = Message::query();
        
        if ($request->has(\'type\')) {
            if ($request->type == \'voice\') {
                $query->where(\'subject\', \'LIKE\', \'%Voice Complaint%\');
            } elseif ($request->type == \'text\') {
                $query->where(\'subject\', \'NOT LIKE\', \'%Voice Complaint%\');
            }
        }
        
        $messages = $query->orderBy(\'id\', \'DESC\')->paginate(20);
        return view(\'backend.message.index\')->with(\'messages\',$messages);
    }
';

$c = preg_replace('/public function index\(\)\{.*?\}/s', ltrim($indexMethod), $c);
file_put_contents($f, $c);
echo "MessageController updated.\n";
?>
