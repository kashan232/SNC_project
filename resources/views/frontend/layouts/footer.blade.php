<!-- Start Footer Area -->
<style>
	/* Elegant Custom Footer */
	.footer {
		background-color: #fcf9f2;
        background-image: url('{{ asset("frontend/img/footer-bg.jpg") }}');
        background-size: cover;
        background-position: center top;
		color: #5c3a21;
		font-family: 'Playfair Display', 'Georgia', serif;
		border-top: 5px solid #a85116;
        position: relative;
        overflow: hidden;
	}
    /* Inner Border framing */
    .footer::before {
        content: '';
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        bottom: 50px;
        border: 1px solid rgba(168, 81, 22, 0.2);
        pointer-events: none;
        z-index: 0;
    }
	.footer .footer-top {
		padding: 70px 0 40px 0;
        position: relative;
        z-index: 1;
	}
	.footer .single-footer h4 {
		color: #8c4217;
		font-size: 20px;
		margin-bottom: 20px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 1.5px;
        font-family: 'Playfair Display', 'Georgia', serif;
	}
	.footer .single-footer ul li {
		margin-bottom: 15px;
	}
	.footer .single-footer ul li a {
		color: #5c3a21;
		transition: all 0.3s ease;
		text-decoration: none;
		font-size: 15px;
		font-family: 'Poppins', sans-serif;
	}
	.footer .single-footer ul li a:hover {
		color: #d35400;
		padding-left: 5px;
	}
	.footer .foot-desc {
		color: #5c3a21;
		line-height: 1.8;
		font-size: 14px;
		margin-top: 20px;
        font-family: 'Poppins', sans-serif;
	}
	.footer .contact ul li {
		color: #5c3a21;
		margin-bottom: 20px;
		display: flex;
		align-items: center;
		font-size: 15px;
		line-height: 1.4;
		font-family: 'Poppins', sans-serif;
	}
	.footer .contact ul li i {
		margin-right: 15px;
		color: #8c4217;
		font-size: 22px;
	}
	/* Socials */
	.footer .social {
		display: flex;
		gap: 15px;
	}
	.footer .social a i {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 45px;
		height: 45px;
		border-radius: 50%;
		background: transparent;
        border: 2px solid #8c4217;
		color: #8c4217 !important;
		transition: all 0.3s ease;
		font-size: 18px !important;
	}
	.footer .social a:hover i {
		background: #8c4217;
		color: #ffffff !important;
		transform: translateY(-3px);
		box-shadow: 0 4px 10px rgba(140, 66, 23, 0.3);
	}

    /* Vertical Divider for Help Section */
    .help-section {
        border-left: 1px solid rgba(168, 81, 22, 0.3);
        padding-left: 30px;
    }
    @media (max-width: 991px) {
        .help-section {
            border-left: none;
            padding-left: 15px;
            margin-top: 30px;
        }
    }

	/* Orange Bottom Bar */
	.footer .copyright {
		background: #b14d0a;
        background-image: url('https://www.transparenttextures.com/patterns/floral-flourish.png');
        background-blend-mode: multiply;
		padding: 12px 0;
        position: relative;
        z-index: 1;
	}
	.footer .bottom-links {
		text-align: center;
		color: #ffffff;
		font-size: 12px;
		font-weight: 500;
		letter-spacing: 1px;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
	}
	.footer .bottom-links a {
		color: #ffffff;
		text-decoration: none;
		margin: 0 10px;
		transition: opacity 0.3s;
	}
	.footer .bottom-links a:hover {
		opacity: 0.8;
	}
    
    .footer-logo-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .est-badge {
        font-family: 'Playfair Display', serif;
        font-size: 14px;
        color: #8c4217;
        font-style: italic;
        text-align: center;
        line-height: 1.2;
    }

    @media(max-width: 768px) {
        .footer-logo-img {
            width: 90px !important;
            height: 90px !important;
        }
        .est-badge {
            width: 60px !important;
            height: 60px !important;
            font-size: 10px !important;
            right: 0 !important;
        }
        .est-badge span {
            font-size: 14px !important;
        }
    }
</style>

<footer class="footer">
	<!-- Footer Top -->
	<div class="footer-top">
		<div class="container">
			<div class="row align-items-start">
				<!-- Brand Info -->
				<div class="col-lg-4 col-md-12 col-12 mb-5 mb-lg-0">
					<div class="single-footer about">
						<div class="footer-logo-wrapper">
							<a href="{{route('home')}}">
                                <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center Logo" class="footer-logo-img" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 4px solid #d4af37;">
                            </a>
                            <div class="est-badge">
                                EST.<br><span style="font-size: 20px;">1950</span>
                            </div>
						</div>
						@php
						$settings = DB::table('settings')->first();
						@endphp
						<p class="foot-desc">{!! $settings->description !!}</p>
					</div>
				</div>
				
				<!-- Contact Us -->
				<div class="col-lg-3 col-md-6 col-12 mb-5 mb-lg-0">
					<div class="single-footer contact-widget">
						<h4>Contact Us</h4>
						<div class="contact">
							<ul>
								<li><i class="ti-headphone-alt"></i> <span>{!! strip_tags($settings->phone) !!}</span></li>
								<li><i class="ti-location-pin"></i> <span>{!! strip_tags($settings->address) !!}</span></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Follow Us -->
				<div class="col-lg-2 col-md-6 col-12 mb-5 mb-lg-0">
					<div class="single-footer links">
						<h4>Follow Us</h4>
						<div class="social">
							<a href="https://www.facebook.com/profile.php?id=61577716630042&mibextid=XvxkBK8d3ZMQiiMC" target="_blank">
								<i class="ti-facebook"></i>
							</a>
							<a href="https://www.instagram.com/Shoukat Nimco Center.pk/" target="_blank">
								<i class="ti-instagram"></i>
							</a>
							<a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->phone) }}" target="_blank">
								<i class="fa fa-whatsapp"></i>
							</a>
						</div>
					</div>
				</div>

				<!-- Help -->
				<div class="col-lg-3 col-md-12 col-12">
					<div class="single-footer links help-section">
						<h4>Help</h4>
						<ul>
							<li><a href="{{route('contact')}}">Submit Your Complaint</a></li>
							<li><a href="{{route('about-us')}}">About Us</a></li>
							<li><a href="#">Returns & Exchanges</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- End Footer Top -->
    
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bottom-links">
						<div class="bottom-links-inner">
                        POWERED BY <a href="#" style="text-decoration: underline;">PROWAVE TECHNOLOGIES</a> 
                        <span class="pipe">|</span> <a href="https://wa.me/923173836223"><i class="fa fa-whatsapp"></i> +92 317 3836223</a> 
                        <span class="pipe">|</span> <a href="#">PRIVACY POLICY</a> 
                        <span class="pipe">|</span> <a href="#">FAQS</a>
                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- Color JS -->

<!-- Slicknav JS -->
<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{asset('frontend/js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
{{-- Isotope --}}
<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
<!-- Easing JS -->
<script src="{{asset('frontend/js/easing.js')}}"></script>

<!-- Active JS -->
<script src="{{asset('frontend/js/active.js')}}"></script>


<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  if(typeof AOS !== 'undefined') {
      AOS.init({
          duration: 800,
          once: true,
          offset: 100
      });
  }
</script>
@stack('scripts')
<script>
	setTimeout(function() {
		$('.alert').slideUp();
	}, 5000);
	$(function() {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
		$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
			event.preventDefault();
			event.stopPropagation();

			$(this).siblings().toggleClass("show");


			if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
			}
			$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
			});

		});
	});
</script>

<style>
@media(max-width: 768px) {
    .footer .bottom-links {
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 5px; /* for scrollbar if any */
    }
    .footer .bottom-links::-webkit-scrollbar {
        display: none; /* Hide scrollbar for clean look */
    }
    .bottom-links-inner {
        display: inline-block;
        font-size: 10px !important;
        letter-spacing: 0.5px !important;
    }
    .bottom-links-inner a {
        margin: 0 4px !important;
        font-size: 10px !important;
    }
    .bottom-links-inner .pipe {
        margin: 0 2px !important;
    }
}
</style>
