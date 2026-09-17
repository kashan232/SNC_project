<?php
$c = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNC || Submit Your Complaint</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
    
    @php
        $settings = \App\Models\Settings::first();
        $themeColor = $settings->theme_color ?? '#036b41';
        $hoverColor = $settings->hover_color ?? '#024a2d';
    @endphp
    <style>
        :root {
            --primary-color: {{ $themeColor }};
            --hover-color: {{ $hoverColor }};
        }
        
        body, html {
            margin: 0; padding: 0; height: 100%;
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
        }

        .feedback-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{asset('images/home_banner.jpg')}}') no-repeat center center / cover;
            background-attachment: fixed;
            position: relative;
            padding: 40px 0;
        }

        .feedback-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.75);
            z-index: 1;
        }

        .feedback-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            padding: 40px 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            text-align: center;
            position: relative;
            z-index: 10;
            max-width: 600px;
            margin: 0 auto;
            border-top: 5px solid var(--primary-color);
        }

        .feedback-card-wide {
            max-width: 700px;
        }

        .brand-logo-container {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            padding: 5px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .brand-logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .welcome-title {
            font-weight: 700;
            color: #222;
            font-size: 28px;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .welcome-title span {
            color: var(--primary-color);
        }

        .welcome-text {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            color: #fff;
            padding: 14px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            box-shadow: 0 10px 20px var(--primary-color);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary-custom:hover {
            background: var(--hover-color);
            transform: translateY(-3px);
            box-shadow: 0 15px 25px var(--primary-color);
            color: #fff;
            text-decoration: none;
        }

        .btn-outline-custom {
            background: transparent;
            color: #555;
            border: 2px solid #ddd;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .copyright-text {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }

        /* Navigation Buttons */
        .back-btn {
            background: rgba(0,0,0,0.05);
            border: none;
            color: #555;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: absolute;
            left: 20px;
            top: 20px;
            padding: 8px 15px;
            border-radius: 20px;
            z-index: 5;
        }
        .back-btn:hover {
            background: var(--primary-color);
            color: #fff;
        }

        .home-btn {
            background: rgba(0,0,0,0.05);
            border: none;
            color: #555;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: absolute;
            right: 20px;
            top: 20px;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            z-index: 5;
        }
        .home-btn:hover {
            background: var(--primary-color);
            color: #fff;
            text-decoration: none;
        }

        /* Step 2 & 3 Boxes */
        .selection-box {
            background: #fff;
            border: 2px solid #eaeaea;
            border-radius: 20px;
            padding: 30px 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .selection-box:hover {
            border-color: var(--primary-color);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            transform: translateY(-5px);
        }

        .selection-box .icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f4fdf9;
            color: var(--primary-color);
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }

        .selection-box:hover .icon-circle {
            background: var(--primary-color);
            color: #fff;
        }

        .selection-box h4 {
            font-size: 16px;
            font-weight: 700;
            color: #222;
            margin-bottom: 5px;
        }

        .selection-box p {
            font-size: 12px;
            color: #777;
            margin: 0;
        }

        /* Forms Styling */
        .custom-form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        
        .custom-form-group label {
            font-weight: 600;
            font-size: 13px;
            color: #444;
            margin-bottom: 8px;
            display: block;
        }
        .custom-form-group label span { color: red; }

        .custom-form-group input, .custom-form-group select, .custom-form-group textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            background: #fafafa;
            transition: all 0.3s;
        }
        
        .custom-form-group input:focus, .custom-form-group select:focus, .custom-form-group textarea:focus {
            border-color: var(--primary-color);
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(3, 107, 65, 0.1);
        }

        .section-title {
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 30px 0 20px;
            position: relative;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            margin: 10px auto 0;
            border-radius: 5px;
        }

        /* Voice Recorder */
        .recorder-container {
            background: #f9f9f9;
            border: 1px dashed #ccc;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin-top: 20px;
            transition: all 0.3s;
        }
        
        .record-btn {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #ea4335;
            color: #fff;
            border: none;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(234, 67, 53, 0.4);
            transition: all 0.3s;
            outline: none;
        }
        
        .record-btn.recording {
            animation: pulse-red 1.5s infinite;
            background: #c5221f;
        }

        .timer {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            font-family: monospace;
        }

        .audio-playback {
            width: 100%;
            margin-top: 20px;
            display: none;
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(234, 67, 53, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(234, 67, 53, 0); }
            100% { box-shadow: 0 0 0 0 rgba(234, 67, 53, 0); }
        }

        /* Transition Animation */
        .fade-in { animation: fadeIn 0.4s ease forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.98); }
            to { opacity: 1; transform: scale(1); }
        }

        .step-container { display: none; }
        .step-container.active { display: block; }
        
        @media (max-width: 576px) {
            .feedback-card { padding: 40px 20px; margin: 0 15px; }
            .welcome-title { font-size: 24px; }
            .selection-box { margin-bottom: 20px; padding: 20px 10px; }
        }
    </style>
</head>
<body>

	<section class="feedback-section">
        <div class="feedback-overlay"></div>
        <div class="container" style="position: relative; z-index: 10;">
            <div class="row justify-content-center">
                <div class="col-12">
                    
                    <!-- STEP 1: Welcome Screen -->
                    <div id="step-1" class="feedback-card step-container active">
                        <a href="{{route('home')}}" class="home-btn"><i class="fa fa-home"></i> Home</a>
                        
                        <div class="brand-logo-container mt-4">
                            <img src="{{asset('images/footer_logo.jpg')}}" alt="SNC Logo">
                        </div>
                        
                        <h2 class="welcome-title">Welcome to <span>SNC!</span></h2>
                        <p class="welcome-text">Your feedback helps us serve you better and continue our tradition of excellence. We value your thoughts!</p>
                        
                        <div class="mt-4 mb-2">
                            <button class="btn-primary-custom" onclick="goToStep('step-2')">
                                <i class="fa fa-comments-o" style="margin-right: 8px;"></i> Share Your Experience
                            </button>
                        </div>
                        
                        <p class="copyright-text">&copy; {{date('Y')}} Shoukat Nimco Center.</p>
                    </div>

                    <!-- STEP 2: Choose Feedback Type -->
                    <div id="step-2" class="feedback-card step-container">
                        <button class="back-btn" onclick="goToStep('step-1')"><i class="fa fa-angle-left"></i> Back</button>
                        <a href="{{route('home')}}" class="home-btn"><i class="fa fa-home"></i></a>

                        <h2 class="welcome-title mt-4" style="font-size: 24px;">Choose Feedback Type</h2>
                        <p class="welcome-text" style="margin-bottom: 35px;">Select voice or message feedback to proceed.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="selection-box" onclick="goToStep('step-voice')">
                                    <div class="icon-circle">
                                        <i class="fa fa-microphone"></i>
                                    </div>
                                    <h4>Voice</h4>
                                    <p>Speak your mind</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="selection-box" onclick="goToStep('step-city')">
                                    <div class="icon-circle">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <h4>Message</h4>
                                    <p>Type your feedback</p>
                                </div>
                            </div>
                        </div>
                        <p class="copyright-text">&copy; {{date('Y')}} Shoukat Nimco Center.</p>
                    </div>
                    
                    <!-- STEP 3A: Voice Feedback Form -->
                    <div id="step-voice" class="feedback-card feedback-card-wide step-container">
                        <button class="back-btn" onclick="goToStep('step-2')"><i class="fa fa-angle-left"></i> Back</button>
                        <a href="{{route('home')}}" class="home-btn"><i class="fa fa-home"></i></a>

                        <h2 class="welcome-title mt-4" style="font-size: 24px;">Voice Feedback</h2>
                        <p class="welcome-text mb-2">Share your experience with us. Record your voice feedback.</p>
                        
                        <form id="voiceForm">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Your Name <span>*</span></label>
                                        <input type="text" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="text" placeholder="03xx-xxxxxxx" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Email (Optional)</label>
                                        <input type="email" placeholder="Enter your email address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Branch Name <span>*</span></label>
                                        <select required>
                                            <option value="">-- Select Branch --</option>
                                            <option value="Clifton">Clifton Branch</option>
                                            <option value="Gulshan">Gulshan Branch</option>
                                            <option value="Tariq Road">Tariq Road Branch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Recorder UI -->
                            <div class="recorder-container">
                                <p style="font-size: 13px; color: #666; margin-bottom: 15px;">Tap the button below to start recording your feedback</p>
                                <button type="button" id="recordBtn" class="record-btn">START</button>
                                <div class="timer" id="recordTimer">00:00</div>
                                <audio id="audioPlayback" class="audio-playback" controls></audio>
                            </div>
                            
                            <div class="mt-4 d-flex justify-content-center" style="gap: 15px;">
                                <button type="button" class="btn-primary-custom" onclick="alert('Voice feedback submit ready for backend!')">Submit Feedback</button>
                                <button type="reset" class="btn-outline-custom" onclick="resetRecorder()">Reset Form</button>
                            </div>
                        </form>
                    </div>

                    <!-- STEP 3B: Select City (For Message Flow) -->
                    <div id="step-city" class="feedback-card step-container">
                        <button class="back-btn" onclick="goToStep('step-2')"><i class="fa fa-angle-left"></i> Back</button>
                        <a href="{{route('home')}}" class="home-btn"><i class="fa fa-home"></i></a>

                        <h2 class="welcome-title mt-4" style="font-size: 24px;">Select Your City</h2>
                        <p class="welcome-text" style="margin-bottom: 35px;">Choose where you visited us.</p>
                        
                        <div class="row">
                            <div class="col-md-4 col-6 mb-3">
                                <div class="selection-box" onclick="goToStep('step-message')">
                                    <h4 class="mt-2">Karachi</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-3">
                                <div class="selection-box" onclick="goToStep('step-message')">
                                    <h4 class="mt-2">Hyderabad</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-3">
                                <div class="selection-box" onclick="goToStep('step-message')">
                                    <h4 class="mt-2">Islamabad</h4>
                                </div>
                            </div>
                        </div>
                        <p class="copyright-text">&copy; {{date('Y')}} Shoukat Nimco Center.</p>
                    </div>

                    <!-- STEP 4B: Message Feedback Form -->
                    <div id="step-message" class="feedback-card feedback-card-wide step-container">
                        <button class="back-btn" onclick="goToStep('step-city')"><i class="fa fa-angle-left"></i> Back</button>
                        <a href="{{route('home')}}" class="home-btn"><i class="fa fa-home"></i></a>

                        <h2 class="welcome-title mt-4" style="font-size: 24px;">Message Feedback</h2>
                        
                        <form id="messageForm">
                            <h3 class="section-title">Contact Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-form-group">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="text" placeholder="03xx-xxxxxxx" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Email (Optional)</label>
                                        <input type="email" placeholder="Enter your email">
                                    </div>
                                </div>
                            </div>

                            <h3 class="section-title">Your Feedback</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Branch Name <span>*</span></label>
                                        <select required>
                                            <option value="">-- Select Branch --</option>
                                            <option value="Clifton">Clifton Branch</option>
                                            <option value="Gulshan">Gulshan Branch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label>Feedback Channel <span>*</span></label>
                                        <select required>
                                            <option value="">-- Select --</option>
                                            <option value="Quality">Food Quality</option>
                                            <option value="Service">Customer Service</option>
                                            <option value="Ambience">Ambience</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-form-group">
                                        <label>Feedback Message <span>*</span></label>
                                        <textarea rows="4" placeholder="Enter your feedback" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-form-group border p-3 rounded" style="background: #fff;">
                                        <label>Attachment (Optional, max 10MB)</label>
                                        <input type="file" style="border: none; padding: 0; background: transparent;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <button type="button" class="btn-primary-custom" onclick="alert('Message feedback submit ready for backend!')" style="width: 200px;">Submit Feedback</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
	</section>

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script>
        // Form Navigation
        function goToStep(stepId) {
            $('.step-container').removeClass('active').hide();
            $('#' + stepId).show().addClass('fade-in active');
        }

        // Voice Recorder Logic
        let mediaRecorder;
        let audioChunks = [];
        let isRecording = false;
        let timerInterval;
        let seconds = 0;

        const recordBtn = document.getElementById('recordBtn');
        const timerDisplay = document.getElementById('recordTimer');
        const audioPlayback = document.getElementById('audioPlayback');

        recordBtn.addEventListener('click', () => {
            if (!isRecording) {
                startRecording();
            } else {
                stopRecording();
            }
        });

        async function startRecording() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];

                mediaRecorder.addEventListener("dataavailable", event => {
                    audioChunks.push(event.data);
                });

                mediaRecorder.addEventListener("stop", () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
                    const audioUrl = URL.createObjectURL(audioBlob);
                    audioPlayback.src = audioUrl;
                    audioPlayback.style.display = 'block';
                    // Here you would also store the blob in a hidden input or FormData for submission
                });

                mediaRecorder.start();
                isRecording = true;
                recordBtn.innerText = 'STOP';
                recordBtn.classList.add('recording');
                audioPlayback.style.display = 'none';
                
                // Start Timer
                seconds = 0;
                updateTimerDisplay();
                timerInterval = setInterval(() => {
                    seconds++;
                    updateTimerDisplay();
                }, 1000);

            } catch (err) {
                alert("Microphone access is required to record voice feedback.");
                console.error(err);
            }
        }

        function stopRecording() {
            mediaRecorder.stop();
            // Stop all tracks to release mic
            mediaRecorder.stream.getTracks().forEach(track => track.stop());
            
            isRecording = false;
            recordBtn.innerText = 'START';
            recordBtn.classList.remove('recording');
            clearInterval(timerInterval);
        }

        function updateTimerDisplay() {
            const m = Math.floor(seconds / 60).toString().padStart(2, '0');
            const s = (seconds % 60).toString().padStart(2, '0');
            timerDisplay.innerText = m + ':' + s;
        }

        function resetRecorder() {
            clearInterval(timerInterval);
            seconds = 0;
            updateTimerDisplay();
            isRecording = false;
            recordBtn.innerText = 'START';
            recordBtn.classList.remove('recording');
            audioPlayback.style.display = 'none';
            audioPlayback.src = '';
            audioChunks = [];
        }
    </script>
</body>
</html>
HTML;
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/complain.blade.php', $c);
echo "Full multi-step wizard implemented.\n";
