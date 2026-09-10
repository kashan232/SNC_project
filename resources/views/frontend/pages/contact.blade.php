@extends('frontend.layouts.master')

@section('title', 'Shoukat Nimco Center || Contact Us')

@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section" style="background: #f9fbfb; padding: 100px 0;">
		<div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center" style="margin-bottom: 60px;">
                        <span style="color: #036b41; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display:block; margin-bottom: 10px;">We're Here to Help</span>
                        <h2 style="font-family: 'Orbitron', sans-serif; font-size: 36px; font-weight: 800; color: #111; margin-top: 5px;">Contact <span style="color: #036b41;">Us</span></h2>
                    </div>
                </div>
            </div>
            
            <div class="contact-wrapper" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.08); display: flex; flex-wrap: wrap;">
                
                <!-- Contact Info Panel -->
                <div class="col-lg-4 col-12 p-0" style="background: linear-gradient(135deg, #036b41, #023a23); color: #fff;">
                    @php
                        $settings=DB::table('settings')->get();
                    @endphp
                    <div class="contact-info-panel" style="padding: 50px 40px; height: 100%;">
                        <h3 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 28px; font-weight: 700; margin-bottom: 20px;">Get In Touch</h3>
                        <p style="color: rgba(255,255,255,0.8); font-size: 15px; margin-bottom: 40px; line-height: 1.8;">Have questions about our premium furniture, delivery, or custom orders? Reach out to us, and our team will get back to you promptly.</p>
                        
                        <div class="c-info-item" style="display: flex !important; align-items: flex-start !important; margin-bottom: 35px !important; clear: both !important;">
                            <div class="c-icon" style="font-size: 26px !important; color: #fff !important; margin-right: 20px !important; flex-shrink: 0 !important; line-height: 1 !important;">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="c-text" style="flex-grow: 1 !important; text-align: left !important;">
                                <h4 style="color: #fff !important; font-size: 18px !important; margin-bottom: 5px !important; font-weight: 600 !important; padding: 0 !important; border: none !important; line-height: 1.2 !important; clear: none !important;">Location</h4>
                                <p style="color: rgba(255,255,255,0.9) !important; font-size: 15px !important; margin: 0 !important; padding: 0 !important; line-height: 1.6 !important;">@foreach($settings as $data) {{$data->address}} @endforeach</p>
                            </div>
                        </div>

                        <div class="c-info-item" style="display: flex !important; align-items: flex-start !important; margin-bottom: 35px !important; clear: both !important;">
                            <div class="c-icon" style="font-size: 26px !important; color: #fff !important; margin-right: 20px !important; flex-shrink: 0 !important; line-height: 1 !important;">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="c-text" style="flex-grow: 1 !important; text-align: left !important;">
                                <h4 style="color: #fff !important; font-size: 18px !important; margin-bottom: 5px !important; font-weight: 600 !important; padding: 0 !important; border: none !important; line-height: 1.2 !important; clear: none !important;">Phone</h4>
                                <p style="color: rgba(255,255,255,0.9) !important; font-size: 15px !important; margin: 0 !important; padding: 0 !important; line-height: 1.6 !important;">@foreach($settings as $data) {{$data->phone}} @endforeach</p>
                            </div>
                        </div>

                        <div class="c-info-item" style="display: flex !important; align-items: flex-start !important; clear: both !important;">
                            <div class="c-icon" style="font-size: 26px !important; color: #fff !important; margin-right: 20px !important; flex-shrink: 0 !important; line-height: 1 !important;">
                                <i class="ti-email"></i>
                            </div>
                            <div class="c-text" style="flex-grow: 1 !important; text-align: left !important;">
                                <h4 style="color: #fff !important; font-size: 18px !important; margin-bottom: 5px !important; font-weight: 600 !important; padding: 0 !important; border: none !important; line-height: 1.2 !important; clear: none !important;">Email</h4>
                                <p style="color: rgba(255,255,255,0.9) !important; font-size: 15px !important; margin: 0 !important; padding: 0 !important; line-height: 1.6 !important;">@foreach($settings as $data) {{$data->email}} @endforeach</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Contact Form Panel -->
                <div class="col-lg-8 col-12 p-0">
                    <div class="contact-form-panel" style="padding: 50px 60px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: #222; margin-bottom: 10px;">Send Us a Message</h3>
                        <p style="color: #777; font-size: 14px; margin-bottom: 30px;">Fill out the form below and we'll get back to you as soon as possible.</p>
                        
                        <form class="form-contact contact_form" method="post" action="{{route('contact.store')}}" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label style="font-weight: 600; color: #333; margin-bottom: 8px;">Your Name *</label>
                                        <input name="name" id="name" type="text" placeholder="John Doe" style="width: 100%; height: 50px; border: 1px solid #ddd; border-radius: 6px; padding: 0 15px; background: #fafafa; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label style="font-weight: 600; color: #333; margin-bottom: 8px;">Your Email *</label>
                                        <input name="email" id="email" type="email" placeholder="john@example.com" style="width: 100%; height: 50px; border: 1px solid #ddd; border-radius: 6px; padding: 0 15px; background: #fafafa; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label style="font-weight: 600; color: #333; margin-bottom: 8px;">Your Phone *</label>
                                        <input name="phone" id="phone" type="text" placeholder="+1234567890" style="width: 100%; height: 50px; border: 1px solid #ddd; border-radius: 6px; padding: 0 15px; background: #fafafa; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label style="font-weight: 600; color: #333; margin-bottom: 8px;">Subject *</label>
                                        <input name="subject" id="subject" type="text" placeholder="How can we help?" style="width: 100%; height: 50px; border: 1px solid #ddd; border-radius: 6px; padding: 0 15px; background: #fafafa; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label style="font-weight: 600; color: #333; margin-bottom: 8px;">Your Message *</label>
                                        <textarea name="message" id="message" rows="6" placeholder="Tell us more about your inquiry..." style="width: 100%; border: 1px solid #ddd; border-radius: 6px; padding: 15px; background: #fafafa; transition: all 0.3s ease; resize: none;"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-right mt-2">
                                    <button type="submit" class="btn" style="background: #036b41; color: #fff; padding: 12px 35px; border-radius: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; border: none; transition: background 0.3s;">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</section>
	<!--/ End Contact -->

	<!--================Contact Success  =================-->
	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content" style="border-radius: 15px; border: none; text-align: center; padding: 30px;">
			<div class="modal-body">
                <i class="ti-check-box" style="font-size: 60px; color: #036b41; margin-bottom: 20px; display: block;"></i>
				<h2 style="color: #222; font-size: 24px; font-weight: 700; margin-bottom: 10px;">Thank You!</h2>
				<p style="color: #666; font-size: 16px;">Your message has been successfully sent. We will get back to you shortly.</p>
                <button type="button" class="btn mt-4" data-dismiss="modal" style="background: #036b41; color: #fff; padding: 10px 30px; border-radius: 6px;">Close</button>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modals error -->
	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content" style="border-radius: 15px; border: none; text-align: center; padding: 30px;">
			<div class="modal-body">
                <i class="ti-alert" style="font-size: 60px; color: #ea4335; margin-bottom: 20px; display: block;"></i>
				<h2 style="color: #222; font-size: 24px; font-weight: 700; margin-bottom: 10px;">Oops!</h2>
				<p style="color: #666; font-size: 16px;">Something went wrong while sending your message. Please ensure all fields are correctly filled.</p>
                <button type="button" class="btn mt-4" data-dismiss="modal" style="background: #222; color: #fff; padding: 10px 30px; border-radius: 6px;">Try Again</button>
			</div>
		  </div>
		</div>
	</div>
@endsection

@push('styles')
<style>
    .contact-form-panel input:focus, .contact-form-panel textarea:focus {
        border-color: #036b41 !important;
        background: #fff !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(3, 107, 65, 0.1);
    }
    .contact-form-panel .btn:hover {
        background: #023a23 !important;
    }
    @media (max-width: 991px) {
        .contact-form-panel {
            padding: 40px 30px !important;
        }
        .contact-info-panel {
            padding: 40px 30px !important;
        }
    }
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush