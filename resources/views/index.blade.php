@include('header')
	<style>
		.hero-slider.hero-style {
			height: 100vh !important;
		}
		
		.swiper-container {
			height: 100vh !important;
		}
		
		.swiper-slide {
			height: 100vh !important;
		}
		
		.slide-bg-image {
						position: relative;
						background-size: cover;
						background-position: center;
						height: 100vh !important;
						min-height: 100vh !important;
						/* Adjust height as needed */
					}

					.gradient-overlay {
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background: none;
						/* Dark gradient overlay */
						z-index: 1;
						/* Make sure the gradient is on top of the background image */
					}

					.slide-inner .container {
						position: relative;
						z-index: 2;
						/* Ensure content is on top of the gradient */
					}

					.text-white {
						color: #ffffff;
					}

					.slide-title h3,
					.slide-text p {
						color: white;
						z-index: 2;
					}
                    /* Ensure arrows are visible */
.swiper-button-next,
.swiper-button-prev {
    color: #fff !important;
    background: rgba(0, 0, 0, 0.5);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999 !important;
}

/* Position properly */
.swiper-button-prev {
    left: 20px !important;
}

.swiper-button-next {
    right: 20px !important;
}

/* Arrow icon size */
.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}

/* Hover effect */
.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: #4a90d9;
}
/* Remove duplicate arrow (default Swiper icon) */
.swiper-button-next::after,
.swiper-button-prev::after {
    display: none !important;
}
	</style>
<section class="hero-slider hero-style">
		<div class="swiper-container">

			<div class="swiper-wrapper">

				<div class="swiper-slide">
					<!-- <img src="" alt=""> -->
					<div class="slide-inner slide-bg-image background-img" data-background="img/back-1.jpeg">
						<div class="gradient-overlay"></div> <!-- Gradient overlay -->
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div data-swiper-parallax="300" class="slide-title">
										<h3 class="text-white">Master Medical Coding Excellence</h3>
									</div>
									<div data-swiper-parallax="400" class="slide-text">
										<p>Premier medical coding training academy offering comprehensive courses in ICD-10, CPT, and medical terminology to shape the future of healthcare coding professionals.</p>
									</div>

									<div class="clearfix"></div>
									<div data-swiper-parallax="500" class="slide-btns">
										<a href="{{route('contact')}}" class="btn-main bg-btn lnk">Enquiry Now <i
												class="fas fa-chevron-right fa-icon"></i><span
												class="circle"></span></a>
									</div>
								</div>
								<div class="col-md-6">
									<!-- <img src="images/hero/mobile-app.png"> -->
								</div>
							</div>

						</div>
					</div>
				</div>


				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image background-image" data-background="img/back-2.jpeg">
						<div class="gradient-overlay"></div> <!-- Gradient overlay -->
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div data-swiper-parallax="300" class="slide-title">
										<h3 class="text-white">Professional Healthcare Coding Training</h3>
									</div>
									<div data-swiper-parallax="400" class="slide-text">
										
										<p>Industry-focused medical coding certification programs with hands-on training in EHR systems, billing processes, and compliance standards for healthcare professionals.</p>
									</div>

									<div class="clearfix"></div>
									<div data-swiper-parallax="500" class="slide-btns">
										<a href="{{route('contact')}}" class="btn-main bg-btn lnk">Enquiry Now <i
												class="fas fa-chevron-right fa-icon"></i><span
												class="circle"></span></a>
									</div>
								</div>
								<div class="col-md-6">
									<!-- <img src="images/hero/web-development.png"> -->
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image background-img" data-background="img/back-3.jpeg">
						<div class="gradient-overlay"></div> <!-- Gradient overlay -->
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div data-swiper-parallax="300" class="slide-title">
										<h3 class="text-white">Advanced Medical Coding Certification</h3>
									</div>
									<div data-swiper-parallax="400" class="slide-text">
										<p>Comprehensive training in medical terminology, anatomy, and coding guidelines with practical experience using the latest healthcare information systems.</p>
									</div>

									<div class="clearfix"></div>
									<div data-swiper-parallax="500" class="slide-btns">
										<a href="{{route('contact')}}" class="btn-main bg-btn lnk">Enquiry Now <i
												class="fas fa-chevron-right fa-icon"></i><span
												class="circle"></span></a>
									</div>
								</div>
								<div class="col-md-6">
									<!-- <img src="images/hero/digital-marketing.png"> -->
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image background-img" data-background="img/back-4.jpeg">
						<div class="gradient-overlay"></div> <!-- Gradient overlay -->
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div data-swiper-parallax="300" class="slide-title">
										<h3 class="text-white">Career-Ready Medical Coding Skills</h3>
									</div>
									<div data-swiper-parallax="400" class="slide-text">
										<p>Build expertise in healthcare revenue cycle, medical billing, and coding accuracy with our industry-standard curriculum designed for immediate employment opportunities.</p>
									</div>

									<div class="clearfix"></div>
									<div data-swiper-parallax="500" class="slide-btns">
										<a href="{{route('contact')}}" class="btn-main bg-btn lnk">Enquiry Now <i
												class="fas fa-chevron-right fa-icon"></i><span
												class="circle"></span></a>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<!-- <img src="images/hero/digital-marketing.png"> -->
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>


			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>

		</div>
	</section>


	<section class="about-sec-app" style="background-color: rgba(187, 178, 178, 0.1);">
    <div class="container">
        <div class="row align-items-stretch"> <!-- make both columns same height -->
            
            <!-- Left content -->
            <div class="col-lg-6 d-flex">
                <div class="common-heading text-l my-auto"> <!-- vertically center -->
                    <h2 class="mb30"><span class="text-second text-bold">WHO WE ARE </span></h2>
					<p class="text-justify">PojoCoursePilot is a premier healthcare education Academy dedicated to train the Advanced level of medical coding professionals. We specialize in comprehensive medical coding certification programs that prepare students for successful careers in healthcare revenue cycle management, medical billing, and health information management. Our curriculum covers essential coding systems including ICD-10-CM, ICD-10-PCS, CPT, and HCPCS, ensuring graduates are well-equipped with industry-standard knowledge and practical skills.</p>
                     </div>
            </div>

            <!-- Right image -->
            <div class="col-lg-6 d-flex">
                <div class="funfact w-100 d-flex">
                    <img src="img/about-2.jpg" class="img-fluid w-100 object-fit-cover" style="border-radius:10px;">
                </div>
            </div>

        </div>
    </div>
</section>


	<section class="service-section-app  dark-bg2 pb-5">

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="common-heading ptag" style="margin-top:40px;">
    <h2>Our Highlights</h2>
</div>
				</div>
				<!-- <p class="mb30 text-center">Thanks to the creativity, our Web and
					Mobile Apps security and stability, integrated solutions and quality
					services, the Pojo Technology has turned into world's renowned
					destination for innovation, perceptive and business management

				</p> -->
			</div>
			<div class="row upset">
				<div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.2s">
					<div class="service-card-app hoshd">
						<h4>Specially designed Curriculum </h4>
						
						<div class="tec-icon mt30">
							<img src="images/h1.jpg" alt="">
						
						</div>
						
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.5s">
					<div class="service-card-app hoshd">
						<h4>Lectures of domain professionals</h4>
						<ul class="-service-list mt10">
							
						</ul>
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
								<img src="images/h2.jpg" alt="">

							</ul>
						</div>
						
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.8s">
					<div class="service-card-app hoshd">
					<h4>Modern Learning Environment & Resources</h4>
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
								<img src="images/h3.jpg" alt="">
                            </ul>
						</div>
						
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.8s">
					<div class="service-card-app hoshd">
						<h4>Technology Enhanced Learning Platform</h4>
						
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
								<img src="images/h4.jpg" alt="">
                            </ul>
						</div>
						
					</div>
				</div>
				

				<!-- <div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.8s">
					<div class="service-card-app hoshd">
						<h4>Corporate Training & Development</h4>
						<ul class="-service-list mt10">
						</ul>
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
							<img src="./img/download/schedule-8744592_1280.webp" alt="">
							</ul>
						</div>
						<p class="mt20 text-justify">Unlocking potential through comprehensive training programs that drive innovation, leadership, and business success.</p>
						<a href="digital-marketing.html" class="mt20 link-prbs">Read More <i
								class="fas fa fa-arrow-circle-right"></i></a>
					</div>
				</div> -->
				<!-- <div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.8s">
					<div class="service-card-app hoshd">
						<h4>SEO Optimization</h4>
						<ul class="-service-list mt10">
							<li> <a href="#">Google Search Console</a> </li>

						</ul>
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
								<li><a href="#">
										<div class="img-iconbb"><img src="images/icons/google.png" alt="Google"></div>
									</a></li>

							</ul>
						</div>
						<p class="mt20 text-justify">Get more website traffic, more customers, and more online
							visibility with powerful SEO services.

						</p>
						<a href="seo.html" class="mt20 link-prbs">Read More <i
								class="fas fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mt30 wow fadeIn" data-wow-delay="0.8s">
					<div class="service-card-app hoshd">
						<h4>Graphic Design</h4>
						<ul class="-service-list mt10">
							<li> <a href="#">Coreldraw</a> </li>
							<li> <a href="#">Photoshop</a> </li>
						</ul>
						<div class="tec-icon mt30">
							<ul class="servc-icon-sldr">
								<li><a href="#">
										<div class="img-iconbb"><img src="images/icons/coreldraw.png" alt="img"></div>
									</a></li>
								<li><a href="#">
										<div class="img-iconbb"><img src="images/icons/photoshop.png" alt="img"></div>
									</a></li>

							</ul>
						</div>
						<p class="mt20 text-justify">If you're looking for a logo design firm for your brand, then
							you've landed on the right page. </p>
						<a href="graphic-design.html" class="mt20 link-prbs">Read More <i
								class="fas fa fa-arrow-circle-right"></i></a>
					</div> -->
			</div>
		</div>
		</div>
	</section>
<section class="why-choose-section">
    <div class="container">
        <h2 class="section-title">Why Choose PojoCoursePilot?</h2>

        <div class="why-grid">

            <!-- Box 1 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="why-title">Certified Trainers</h3>
                <p class="why-text">Learn from experienced professionals with real-world healthcare and coding expertise.</p>
            </div>

            <!-- Box 2 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="why-title">100% Placement Support</h3>
                <p class="why-text">We ensure every student gets the right guidance and job opportunities after training.</p>
            </div>

            <!-- Box 3 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="why-title">Hands-on Practice</h3>
                <p class="why-text">Gain practical knowledge with real case studies, mock tests, and live sessions.</p>
            </div>

            <!-- Box 4 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="why-title">Certification Exam Guidance</h3>
                <p class="why-text">Step-by-step guidance for AAPC/AHIMA certification preparation, including mock tests and study materials.</p>
            </div>

            <!-- Box 5 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3 class="why-title">Industry-Aligned Curriculum</h3>
                <p class="why-text">Our syllabus follows the latest AHIMA and AAPC guidelines, ensuring you stay up-to-date with global coding standards.</p>
            </div>

            <!-- Box 6 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="why-title">Flexible Learning Options</h3>
                <p class="why-text">Choose classroom, online, or hybrid learning — designed to fit your timing and convenience.</p>
            </div>

            <!-- Box 7 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="why-title">Affordable Fees</h3>
                <p class="why-text">We offer cost-effective courses with flexible payment plans to make quality education accessible to everyone.</p>
            </div>

            <!-- Box 8 -->
            <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="why-title">Student Success Stories</h3>
                <p class="why-text">Many of our students have successfully started their careers in top medical coding companies and healthcare organizations.</p>
            </div>

            <!-- Box 9 -->
            {{-- <div class="why-box">
                <div class="why-icon">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="why-title">Live Demos</h3>
                <p class="why-text">Every week, you can join our live demo classes handled by real-time expert faculties.</p>
            </div> --}}

        </div>
    </div>
</section>

<style>
.why-choose-section {
    background-color: #f8f9fa;
    padding: 60px 20px;
    text-align: center;
}

.why-choose-section .section-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 40px;
    color: #333;
}

.why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.why-box {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.why-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.why-icon {
    font-size: 40px;
    color: #4a90d9;
    margin-bottom: 15px;
}

.why-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.why-text {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
}
.review-img{
width:50%;
height:150px;
object-fit:contain;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.15);
transition:0.3s;
}
.review-img{
width:250%;
height:auto;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
.review-img:hover{
transform:translateY(-6px);
box-shadow:0 12px 25px rgba(0,0,0,0.25);
}

.review-card{
background:#fff;
padding:20px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
max-width:600px;
margin:auto;
font-family:Arial, sans-serif;
}

.review-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:10px;
}

.review-user{
display:flex;
align-items:center;
gap:10px;
}

.review-avatar{
width:40px;
height:40px;
border-radius:50%;
background:#5f8f3d;
color:#fff;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
font-size:18px;
}

.review-info h6{
margin:0;
font-weight:600;
font-size:15px;
}

.review-info span{
font-size:12px;
color:#777;
}

.review-menu{
font-size:18px;
color:#777;
}

.review-rating{
margin-bottom:10px;
}

.stars{
color:#fbbc05;
font-size:14px;
margin-right:10px;
}

.review-time{
font-size:13px;
color:#777;
margin-right:10px;
}

.review-new{
font-size:11px;
background:#eee;
padding:2px 6px;
border-radius:4px;
}

.review-text{
font-size:14px;
line-height:1.6;
color:#444;
}
.review-card{
background:#fff;
padding:20px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.08);
height:260px;                 /* same height for all boxes */
display:flex;
flex-direction:column;
}

.review-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:8px;
}

.review-user{
display:flex;
align-items:center;
gap:10px;
}

.review-avatar{
width:40px;
height:40px;
border-radius:50%;
background:#6c9c3b;
color:#fff;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
font-size:16px;
}

.review-info h6{
margin:0;
font-size:15px;
font-weight:600;
}

.review-info span{
font-size:12px;
color:#777;
}

.review-rating{
font-size:13px;
margin-bottom:6px;
}

.stars{
color:#fbbc05;
margin-right:6px;
}

.review-time{
color:#777;
}

.review-new{
background:#eee;
padding:2px 6px;
font-size:11px;
border-radius:4px;
margin-left:5px;
}

.review-text{
font-size:13px;
color:#444;
line-height:1.5;
overflow:hidden;
display:-webkit-box;
-webkit-line-clamp:5;      /* limits text lines */
-webkit-box-orient:vertical;
}
/* subtitle text */
.journey-subtitle{
color:#0b4f74;
}

/* hexagon border */
.hexagon-card{
border:2px solid #0b4f74;
}

/* step number circle */
.step-badge{
background:#0b4f74;
color:#fff;
}

/* icon border hover if exists */
.journey-item:hover .hexagon-card{
border-color:#0b4f74;
}
.hexagon-card{
border-color:#0b4f74 !important;
}

.step-badge{
background:#0b4f74 !important;
}

.google-review-btn{
display:inline-flex;
align-items:center;
justify-content:center;
padding:12px 24px;
border-radius:999px;
background:linear-gradient(135deg,#0b4f74 0%, #1a7aa8 100%);
border:1px solid rgba(11,79,116,0.14);
color:#fff !important;
font-weight:700;
letter-spacing:0.01em;
text-decoration:none;
box-shadow:0 14px 30px rgba(11,79,116,0.22);
transition:transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
}

.google-review-btn:hover,
.google-review-btn:focus{
color:#fff !important;
transform:translateY(-2px);
box-shadow:0 18px 36px rgba(11,79,116,0.28);
filter:brightness(1.04);
}

.google-review-btn:active{
transform:translateY(0);
box-shadow:0 10px 20px rgba(11,79,116,0.2);
}
</style>

<section class="google-review-section py-5">
<div class="container">

<h4 class="text-center mb-5">
EXCELLENT ⭐⭐⭐⭐⭐ 163 reviews <span style="color:#4285F4;">Google</span>
</h4>
<div class="text-center mb-4">
    <a href="https://g.page/r/CTvURxkJJfRZEBM/review" target="_blank" class="google-review-btn">
        Review Us on Google
    </a>
    <a href="https://g.page/r/CTvURxkJJfRZEBM/review" target="_blank" class="google-review-btn" style="margin-left:12px;">
        View Google Reviews
    </a>
</div>

<div class="row justify-content-center">

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">

<div class="review-user">
<div class="review-avatar">J</div>

<div class="review-info">
<h6>Jaheer Jaheer</h6>
<span>1 review</span>
</div>
</div>

<div class="review-menu">⋮</div>

</div>


<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">2 weeks ago</span>
<span class="review-new">NEW</span>
</div>


<p class="review-text">
It's a wonderful experience with imi academy. Their material is short, precise, and pictures are highlighted. Teaching is also very good.
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">

<div class="review-user">
<div class="review-avatar" style="background:#9c4dcc;">J</div>

<div class="review-info">
<h6>Jayantha Rajaganapathi</h6>
<span>3 reviews</span>
</div>
</div>

<div class="review-menu">⋮</div>

</div>

<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">2 months ago</span>
</div>

<p class="review-text">
This medical academy provides excellent teaching with clear concepts and structured guidance. 
The faculty are highly knowledgeable, approachable, and supportive throughout the course. 
Highly recommended!!!
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">

<div class="review-user">

<div class="review-avatar" style="width:40px;height:40px;border-radius:50%;">G
</div>

<div class="review-info">
<h6>Gomathi V</h6>
<span>3 reviews</span>
</div>

</div>

<div class="review-menu">⋮</div>

</div>


<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">2 months ago</span>
</div>


<p class="review-text">
It is a good platform for learning medical billing. The training is going very well, and it is very helpful for my future. The trainers are well-knowledgeable and clear doubts immediately. They also conduct assessments, which are very helpful.
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">
<div class="review-user">

<div class="review-avatar" style="width:40px;height:40px;border-radius:50%;">S</div>

<div class="review-info">
<h6>SOWNDARIYA M</h6>
<span>1 review</span>
</div>

</div>

<div class="review-menu">⋮</div>
</div>

<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">2 months ago</span>
</div>

<p class="review-text">
Thank you for this wonderful opportunity....this class helps for my future carrier....once again Thank you for vetri nichayam team and big thanks for TN CM Stalin sir.....Salem district Sarah flash and IMI academy CEOs and bigggg thanks for my trainers....
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">
<div class="review-user">

<div class="review-avatar" style="background:#1a8f7a;">K</div>

<div class="review-info">
<h6>Kalaivarasan P</h6>
<span>1 review</span>
</div>

</div>

<div class="review-menu">⋮</div>
</div>

<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">a week ago</span>
<span class="review-new">NEW</span>
</div>

<p class="review-text">
Medical coding training conducting our college and so our college invite a IMI academy of medical coding.... overall IMI trainers teach in step by step and also easily understand of Anatomy and Physiology, pathology, ICD convention...
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">
<div class="review-user">

<div class="review-avatar" style="width:40px;height:40px;border-radius:50%;">S
</div>

<div class="review-info">
<h6>Surya Prakash</h6>
<span>1 review</span>
</div>

</div>

<div class="review-menu">⋮</div>
</div>

<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">4 months ago</span>
</div>

<p class="review-text">
15 days of medical coding class was a well-structured learning experience. It provided a basic knowledge in anatomy, physiology and pathology, ICD-10, and CPT coding systems. The trainers are very kindly and friendly and teach those topics in a simple understandable form.
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">
<div class="review-user">

<div class="review-avatar" style="width:40px;height:40px;border-radius:50%;">S
</div>

<div class="review-info">
<h6>SANMUGAM C</h6>
<span>3 reviews</span>
</div>

</div>

<div class="review-menu">⋮</div>
</div>

<div class="review-rating">
<span class="stars">★★★★★</span>
<span class="review-time">4 months ago</span>
</div>

<p class="review-text">
Trainers highlight specific strengths and weaknesses, such as their knowledge, communication style, and ability to explain complex topics like ICD-10, CPT, and HCPCS. Overall medical coding is an interesting topic. 
</p>

</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="review-card">

<div class="review-header">
<div class="review-user">

<div class="review-avatar" style="width:40px;height:40px;border-radius:50%;">R
</div>

<div class="review-info">
<h6>077 Roshan</h6>
<span>1 review</span>
</div>

</div>

<div class="review-menu">⋮</div>
</div>

<div class="review-rating">
<span class="stars">★★★★☆</span>
<span class="review-time">a year ago</span>
</div>

<p class="review-text">
I have successfully completed Medical coding course is very useful to me. They clear one on one clarifications and make us ready to create great things. I am glad to find these and learn from you. Overall I am happy to learn from you.
<br><br>
"THANK YOU"
</p>

</div>
</div>

</div>
</div>

<section class="journey-section">
    <div class="container">

		<h3 class="journey-subtitle">PojoCoursePilot</h3>
        <h2 class="journey-title">Journey Ahead: Our Path Forward</h2>

        <div class="journey-grid" style="justify-content: center;">

            <!-- Item 1 -->
            <div class="journey-item">
                <div class="hexagon-card">
                    <img src="images/icon1.png" class="journey-icon" alt="icon">
                </div>
                <span class="step-badge">01</span>

                <h4 class="journey-heading">PojoCoursePilot Established</h4>
            </div>

            <!-- Item 2 -->
            <div class="journey-item">
                <div class="hexagon-card">
                    <img src="images/icon2.png" class="journey-icon" alt="icon">
                </div>
                <span class="step-badge">02</span>

                <h4 class="journey-heading">100 plus projects & 50 plus Research Scholars</h4>
            </div>

            <!-- Item 3 -->
            {{-- <div class="journey-item">
                <div class="hexagon-card">
                    <img src="images/icon3.png" class="journey-icon" alt="icon">
                </div>
                <span class="step-badge">03</span>

                <h4 class="journey-heading">Upgraded to “Digital University Kerala” in 2020</h4>
            </div> --}}

        </div>

    </div>
</section>
<section class="companies-section">
<div class="container-fluid px-0">

<h2 class="companies-title">Medical Coding Companies</h2>

<div class="logo-slider">
<div class="logo-track">

<div class="logo-box"><img src="img/miramed-ajuba.jpg"></div>
<div class="logo-box"><img src="img/episource.jfif"></div>
<div class="logo-box"><img src="img/advantum-health.png"></div>
<div class="logo-box"><img src="img/apexon-health.jpg"></div>
<div class="logo-box"><img src="img/vee-healthtek.jpg"></div>
<div class="logo-box"><img src="img/axis-healthcare.png"></div>
<div class="logo-box"><img src="img/access.jpg"></div>
<div class="logo-box"><img src="img/ags.jfif"></div>
<div class="logo-box"><img src="img/omega.png"></div>
<div class="logo-box"><img src="img/optum.png"></div>  
<div class="logo-box"><img src="img/corro.png"></div>
<div class="logo-box"><img src="img/oobs.jpg"></div>          

<!-- duplicate logos for smooth infinite scroll -->

<div class="logo-box"><img src="img/miramed-ajuba.jfif"></div>
<div class="logo-box"><img src="img/episource.jfif"></div>
<div class="logo-box"><img src="img/advantum-health.png"></div>
<div class="logo-box"><img src="img/apexon-health.jfif"></div>
<div class="logo-box"><img src="img/vee-healthtek.jfif"></div>
<div class="logo-box"><img src="img/axis-healthcare.png"></div>
<div class="logo-box"><img src="img/access.jfif"></div>
<div class="logo-box"><img src="img/ags.jfif"></div>
<div class="logo-box"><img src="img/omega.png"></div>
<div class="logo-box"><img src="img/optum.png"></div>  
<div class="logo-box"><img src="img/corro.png"></div>  
<div class="logo-box"><img src="img/oobs.jpg"></div> 
</div>
</div>

<style>
.companies-section{
background:#f7f7f7;
padding:70px 0 ;
text-align:center;
overflow:hidden;
margin:0;
}

.companies-title{
color:#e05252;
margin-bottom:40px;
font-weight:600;
}

/* slider container */
.logo-slider{
overflow:hidden;
position:relative;
width:100%;
padding: 0 80px;
box-sizing: border-box;
}

/* moving track */
.logo-track{
display:flex;
gap:30px;
width:max-content;
animation:scroll 35s linear infinite;
}

/* logo box */
.logo-box{
width:180px;
height:100px;
background:#fff;
border-radius:10px;
display:flex;
align-items:center;
justify-content:center;
box-shadow:0 4px 12px rgba(0,0,0,0.08);
padding:10px;
flex-shrink:0;
}

/* logo image */
.logo-box img{
max-width:140px;
max-height:60px;
object-fit:contain;
}

/* animation */
@keyframes scroll{
0%{
transform:translateX(0);
}
100%{
transform:translateX(-50%);
}
}
</style>
</div>
</section>

</section>
 @include('footer')


