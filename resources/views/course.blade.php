@include('header')
<style>
.breadcrumb-area:before{
background: rgba(255,255,255,0.50); /* light white overlay */
}

@media (max-width:768px){

.breadcrumb-area{
background-size: cover !important;
background-position: center center !important;
background-repeat: no-repeat !important;

height: 10vh;
display: flex;
align-items: center;
justify-content: center;
text-align: center;
}
/* reduce hero section height */
.breadcrumb-area{
padding: 20px 0 !important;
height: auto;
}

/* move breadcrumb (Home • Course List) up */
.bread-menu{
margin-top: -25px;
margin-bottom: 8px;

}

/* adjust title spacing */
.bread-title h2{
margin-top: 5px;
font-size: 30px;
font-weight: bold;
}

}
</style>
<section class="breadcrumb-area banner-1" 
style="padding: 130px 0; background-image:url('@if($type=='course') {{ asset('img/course.webp') }} @elseif($type=='book') {{ asset('img/book.jpg') }} @endif'); 
background-size:cover; 
background-position:center; 
background-repeat:no-repeat;">

<div class="text-block">
<div class="container">
<div class="row">
<div class="col-lg-12 v-center">

<div class="bread-inner">

<div class="bread-menu">
{{-- <ul>
<li><a href="{{route('home')}}">Home</a></li>
<li>
<a href="#">
@if($type == 'course') Course List @endif
@if($type == 'book') Book List @endif
</a>
</li>
</ul> --}}
</div>

<div class="bread-title">
<h2>
@if($type == 'course') Course List @endif
@if($type == 'book') Book List @endif
</h2>
</div>

</div>

</div>
</div>
</div>
</div>

</section>

<section class="courses-section">
    <h2 class="section-title text-center">Our @if($type == 'course') Course List @endif
    @if($type == 'book') Book List @endif
   </h2>

    <div class="course-grid">

        @foreach ($courses as $course)
        <div class="course-card">
            <div class="card-img">
                <img src="{{ asset($course->image) }}" alt="" class="img-fluid rounded">
            </div>

            <div class="card-body">
                <h3 class="course-title text-primary">{{ $course->title }}</h3>
                <p class="course-desc text-muted">{{ $course->short_desc }}</p>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('course.details', $course->id) }}" class="btn btn-primary view-btn">View Details</a>
                   <a href="{{ route('course.details', $course->id) }}" class="btn btn-success buy-btn">Buy Now</a>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>

<style>
.courses-section {
    padding: 60px 0;
    background-color: #f5f9fc;
}

/* Section Title */
.section-title {
    font-size: 2.5rem;
    color: #048444;
    margin-bottom: 40px;
    font-weight: 700;
    text-transform: uppercase;
    position: relative;
    text-align: center;
}

.section-title::after {
    content: '';
    display: block;
    width: 80px; /* Adjusted width for better visibility */
    height: 3px;
    background: #e8456d;
    margin: 10px auto 0;
}

/* Grid */
.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

/* Card */
.course-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: 0.3s;
}

.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

/* Image */
.card-img {
    width: 100%;
    height: 260px;
    overflow: hidden;
}

.card-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

/* Body */
.card-body {
    padding: 22px;
}

/* Course Title */
.course-title {
    font-size: 1.5rem;
    margin-bottom: 10px;
    font-weight: bold;
    color: #000000 !important; /* Ensure dark black color is applied */
    text-align: center;
}

/* Description */
.course-desc {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 20px;
    text-align: center;
}

/* Footer Buttons */
.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Buttons */
.btn-primary {
    background-color: #048444;
    border: none;
    color: #fff;
    border-radius: 25px;
    padding: 8px 18px;
    font-size: 13px;
}

.btn-primary:hover {
    background-color: #083b57;
}

/* Buy button */
.btn-success {
    background-color: #1c8b4c;
    border: none;
    border-radius: 25px;
    padding: 8px 18px;
    font-size: 13px;
}

.btn-success:hover {
    background-color: #15723d;
}
.extra-course-list {
    background: #f5f9fc;
    padding: 60px 0;
}

.list-title {
    font-size: 28px;
    font-weight: 700;
    
    margin-bottom: 15px;
    color: #048444 !important; /* Apply dark blue color */
}
.list-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #e8456d;
    margin: 10px 0 0 0; /* Align the line to the left */
}
.course-list li {
    color: #000000 !important; /* Ensure dark black color is applied */
    font-size: 16px;
    margin-bottom: 10px;
}
</style>

<!-- POPUP MODAL -->
<div id="popupModal" class="popup-overlay">
    <div class="popup-box">
        <span class="popup-close" onclick="closePopup()">×</span>

        <div class="popup-content">
            <div class="popup-left">
                <img id="popupImg" class="popup-img">
            </div>

            <div class="popup-right">
                <h2 id="popupName" class="popup-title"></h2>
                <p id="popupRole" class="popup-role"></p>
                <hr class="popup-divider">
                <p id="popupDesc" class="popup-desc"></p>
            </div>
        </div>
    </div>
</div>



<script>
    function openPopup(img, name, role, desc) {
    document.getElementById('popupImg').src = img;
    document.getElementById('popupName').innerText = name;
    document.getElementById('popupRole').innerText = role;
    document.getElementById('popupDesc').innerText = desc;

    document.getElementById('popupModal').style.display = "flex";
}

function closePopup() {
    document.getElementById('popupModal').style.display = "none";
}

    </script>

    </section>   <!-- End courses section -->

@if($type == 'course')

<section class="extra-course-list">
    <div class="container">

        <h3 class="list-title text-primary" style="text-color: #048444">Our Course List</h3>
        <ul class="course-list">
            <li class="text-primary">ADVANCE MEDICAL CODING (AMC)</li>
            <li class="text-primary">CERTIFIED PROFESSIONAL CODER (CPC)</li>
        </ul>

        <h3 class="list-title mt-4 text-primary" style="text-color: #048444">Certifications We Provide</h3>
        <ul class="course-list">
            <li class="text-primary">CPC - Certified Professional Coder</li>
            <li class="text-primary">COC - Certified Out-Patient Coder</li>
            <li class="text-primary">CIC - Certified In-Patient Coder</li>
            <li class="text-primary">CRC - Certified Risk Adjustment Coder</li>
            <li class="text-primary">CPMA - Certified Professional Medical Coding Auditor</li>
        </ul>

    </div>
</section>

@endif


@if($type == 'book')

<section class="extra-course-list">
    <div class="container">

        <h3 class="list-title">
            OUR BOOK LIST
        </h3>

        <ul class="course-list">
            <li>ICD 10 CM</li>
            <li>CPT</li>
            <li>HCPCS</li>
            <li>IMI BOOK</li>
        </ul>

    </div>
</section>

@endif


@include('footer')
