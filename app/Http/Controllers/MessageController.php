<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $query = Message::query();
        
        if ($request->has('type')) {
            if ($request->type == 'voice') {
                $query->where('subject', 'LIKE', '%Voice Complaint%');
            } elseif ($request->type == 'text') {
                $query->where('subject', 'NOT LIKE', '%Voice Complaint%');
            }
        }
        
        $messages = $query->orderBy('id', 'DESC')->paginate(20);
        return view('backend.message.index')->with('messages',$messages);
    }

    public function messageFive()
    {
        $message=Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'email|required',
            'message'=>'required|min:20|max:200',
            'subject'=>'string|required',
            'phone'=>'numeric|required'
        ]);
        // return $request->all();

        $message=Message::create($request->all());
            // return $message;
        $data=array();
        $data['url']=route('message.show',$message->id);
        $data['date']=$message->created_at->format('F d, Y h:i A');
        $data['name']=$message->name;
        $data['email']=$message->email;
        $data['phone']=$message->phone;
        $data['message']=$message->message;
        $data['subject']=$message->subject;
        $data['photo']=Auth()->check() ? Auth()->user()->photo : null;
        // return $data;    
        event(new MessageSent($data));
        return response()->json(["status"=>"success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $message=Message::find($id);
        if($message){
            $message->read_at=\Carbon\Carbon::now();
            $message->save();
            return view('backend.message.show')->with('message',$message);
        }
        else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message=Message::find($id);
        $status=$message->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted message');
        }
        else{
            request()->session()->flash('error','Error occurred please try again');
        }
        return back();
    }

    public function submitComplain(Request $request)
    {
        $message = new Message();
        $message->name = $request->name ?? 'Unknown';
        $message->phone = $request->phone ?? 'Unknown';
        $message->email = $request->email ?? 'no-email@example.com';
        
        $type = $request->feedback_type; // 'voice' or 'text'
        if ($type == 'voice') {
            $message->subject = "Voice Complaint - Branch: " . ($request->branch ?? 'N/A');
            
            if ($request->hasFile('audio')) {
                $file = $request->file('audio');
                $filename = time() . '_' . uniqid() . '.webm';
                // Move to public/storage/complaints (make sure this works, or just public/complaints)
                $file->move(public_path('storage/complaints'), $filename);
                $url = asset('storage/complaints/' . $filename);
                $message->message = "Voice Complaint: <br><audio controls><source src='{$url}' type='audio/webm'></audio>";
            } else {
                $message->message = "Voice Complaint (No Audio File Attached)";
            }
        } else {
            $message->subject = "Text Complaint - Branch: " . ($request->branch ?? 'N/A') . " - Channel: " . ($request->channel ?? 'N/A');
            $message->message = $request->message ?? 'No Message';
            
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/complaints'), $filename);
                $message->photo = asset('storage/complaints/'.$filename);
            }
        }
        
        $message->save();
        
        return response()->json(['status' => 'success', 'message' => 'Feedback submitted successfully.']);
    }

}
