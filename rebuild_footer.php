<?php
$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

$new_footer = <<<'HTML'
<!-- Start Footer Area -->
<style>
	/* Light Clean Modern Footer */
	.footer {
		background: #ffffff;
		color: #333333;
		font-family: 'Poppins', sans-serif;
		border-top: 1px solid #eeeeee;
	}
	.footer .footer-top {
		padding: 60px 0 20px 0;
	}
	.footer .single-footer h4 {
		color: #111111;
		font-size: 18px;
		margin-bottom: 25px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.footer .single-footer ul li {
		margin-bottom: 12px;
	}
	.footer .single-footer ul li a {
		color: #555555;
		transition: all 0.3s ease;
		text-decoration: none;
		font-size: 15px;
		font-weight: 500;
	}
	.footer .single-footer ul li a:hover {
		color: #e62020;
		padding-left: 5px;
	}
	.footer .foot-desc {
		color: #666666;
		line-height: 1.8;
		font-size: 14px;
		margin-top: 15px;
	}
	.footer .contact ul li {
		color: #555555;
		margin-bottom: 15px;
		display: flex;
		align-items: flex-start;
		font-size: 14px;
		line-height: 1.6;
		font-weight: 500;
	}
	.footer .contact ul li i {
		margin-right: 15px;
		color: #e62020;
		margin-top: 4px;
		font-size: 18px;
	}
	/* Socials */
	.footer .social {
		display: flex;
		gap: 15px;
		margin-top: 15px;
	}
	.footer .social a i {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 35px;
		height: 35px;
		border-radius: 50%;
		background: #f4f4f4;
		color: #e62020 !important;
		transition: all 0.3s ease;
		font-size: 16px !important;
	}
	.footer .social a:hover i {
		background: #e62020;
		color: #ffffff !important;
		transform: translateY(-3px);
		box-shadow: 0 4px 10px rgba(230,32,32,0.2);
	}
	/* Decorative Bottom Image Layer */
	.footer-decor {
		width: 100%;
		height: 80px;
		background: url('{{asset('images/banners/main_banner.jpg')}}') repeat-x center center;
		background-size: cover;
		opacity: 0.1;
		margin-top: 10px;
	}
	/* Red Bottom Bar */
	.footer .copyright {
		background: #e62020;
		padding: 15px 0;
	}
	.footer .bottom-links {
		text-align: center;
		color: #ffffff;
		font-size: 13px;
		font-weight: 700;
		letter-spacing: 0.5px;
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
</style>

<footer class="footer">
	<!-- Footer Top -->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<!-- Brand Info -->
				<div class="col-lg-4 col-md-6 col-12 mb-5 mb-lg-0">
					<div class="single-footer about">
						<div class="logo">
							<a href="{{route('home')}}" style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; color: #111; text-decoration: none; line-height: 1.2; display: inline-block;">
                                SHOUKAT<br><span style="color: #e62020;">NIMCO CENTER</span>
                            </a>
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
								<li><i class="ti-mobile"></i> <span>{!! strip_tags($settings->phone) !!}</span></li>
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
								<i class="bi bi-whatsapp"></i>
							</a>
						</div>
					</div>
				</div>

				<!-- Help -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-footer links">
						<h4>Help</h4>
						<ul>
							<li><a href="{{ route('contact') }}">Submit Your Complaint</a></li>
							<li><a href="{{ route('about-us') }}">About Us</a></li>
							<li><a href="{{ route('home') }}#return-policy">Returns & Exchanges</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Footer Decor line -->
	<div class="footer-decor"></div>

	<!-- Red Copyright Bar -->
	<div class="copyright">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="bottom-links">
						POWERED BY <a href="https://wa.me/923173836223" target="_blank" style="text-decoration:underline;">PROWAVE TECHNOLOGIES</a> | <a href="https://wa.me/923173836223"><i class="bi bi-whatsapp" style="margin-right:2px;"></i>+92 317 3836223</a> | <a href="{{ route('privacy-policy') }}">PRIVACY POLICY</a> | <a href="{{ route('home') }}#faqs">FAQS</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- /End Footer Area -->
HTML;

// Replace entire block
$pattern = '/<!-- Start Footer Area -->.*?<!-- \/End Footer Area -->/s';
$content = preg_replace($pattern, $new_footer, $content);

file_put_contents($file, $content);
echo "Footer updated!\n";
