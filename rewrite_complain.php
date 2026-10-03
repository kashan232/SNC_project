<?php
$f = 'resources/views/frontend/pages/complain.blade.php';
$c = file_get_contents($f);

// Add CSRF token just inside head if not present
if (strpos($c, '<meta name="csrf-token"') === false) {
    $c = str_replace('<head>', "<head>\n    <meta name=\"csrf-token\" content=\"{{ csrf_token() }}\">", $c);
}

// Rename inputs for voiceForm
$c = str_replace('<form id="voiceForm">', '<form id="voiceForm" onsubmit="event.preventDefault(); submitVoiceForm();">', $c);
$c = preg_replace('/<input type="text" placeholder="Enter your full name"(.*?)>/', '<input type="text" name="name" placeholder="Enter your full name"$1>', $c);
$c = preg_replace('/<input type="text" placeholder="03xx-xxxxxxx"(.*?)>/', '<input type="text" name="phone" placeholder="03xx-xxxxxxx"$1>', $c);
// Rename inputs for messageForm
$c = str_replace('<form id="messageForm">', '<form id="messageForm" onsubmit="event.preventDefault(); submitMessageForm();">', $c);
$c = preg_replace('/<input type="email" placeholder="Enter your email"(.*?)>/', '<input type="email" name="email" placeholder="Enter your email"$1>', $c);
$c = preg_replace('/<textarea rows="4" placeholder="Enter your feedback"(.*?)><\/textarea>/', '<textarea rows="4" name="message" placeholder="Enter your feedback"$1></textarea>', $c);
$c = preg_replace('/<input type="file" style="border: none; padding: 0; background: transparent;">/', '<input type="file" name="attachment" style="border: none; padding: 0; background: transparent;">', $c);

// Selects are trickier, let's add names based on their options
$c = str_replace('<select required>', '<select name="branch" required>', $c);
// Wait, both forms have branch selects! That works (both get name="branch").
$c = str_replace('<option value="Quality">Food Quality</option>', '<select name="channel" required><option value="Quality">Food Quality</option>', $c);
// That breaks the previous select, let's fix it better.
$c = preg_replace('/<label>Feedback Channel <span>\*<\/span><\/label>\s*<select name="branch" required>/', '<label>Feedback Channel <span>*</span></label><select name="channel" required>', $c);

// Remove the inline alerts on buttons
$c = preg_replace('/onclick="alert\(\'Voice feedback submit ready for backend!\'\)"/', 'onclick="submitVoiceForm()"', $c);
$c = preg_replace('/onclick="alert\(\'Message feedback submit ready for backend!\'\)"/', 'onclick="submitMessageForm()"', $c);

// Add the JS functions
$js = '
        let currentAudioBlob = null;
        
        // Let\'s hook into the mediaRecorder stop to save the blob globally
        // Search for: const audioBlob = new Blob(audioChunks, { type: \'audio/webm\' });
        // And we will append: currentAudioBlob = audioBlob;
';
$c = str_replace("const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });", "const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });\n                    currentAudioBlob = audioBlob;", $c);

$jsFuncs = '
        function submitVoiceForm() {
            let form = document.getElementById("voiceForm");
            if(!form.checkValidity()) { form.reportValidity(); return; }
            if(!currentAudioBlob) { alert("Please record an audio message first!"); return; }
            
            let formData = new FormData(form);
            formData.append("feedback_type", "voice");
            formData.append("audio", currentAudioBlob, "voice_record.webm");
            
            let btn = form.querySelector("button[onclick]");
            btn.innerText = "Submitting...";
            btn.disabled = true;
            
            fetch("{{ route(\'complain.submit\') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": document.querySelector(\'meta[name="csrf-token"]\').content },
                body: formData
            }).then(res => res.json()).then(data => {
                alert(data.message);
                window.location.reload();
            }).catch(err => {
                alert("An error occurred");
                btn.innerText = "Submit Voice Feedback";
                btn.disabled = false;
            });
        }
        
        function submitMessageForm() {
            let form = document.getElementById("messageForm");
            if(!form.checkValidity()) { form.reportValidity(); return; }
            
            let formData = new FormData(form);
            formData.append("feedback_type", "text");
            
            let btn = form.querySelector("button[onclick]");
            btn.innerText = "Submitting...";
            btn.disabled = true;
            
            fetch("{{ route(\'complain.submit\') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": document.querySelector(\'meta[name="csrf-token"]\').content },
                body: formData
            }).then(res => res.json()).then(data => {
                alert(data.message);
                window.location.reload();
            }).catch(err => {
                alert("An error occurred");
                btn.innerText = "Submit Feedback";
                btn.disabled = false;
            });
        }
    </script>
';
$c = str_replace('</script>', $jsFuncs, $c);

file_put_contents($f, $c);
echo "Complain blade updated.\n";
?>
