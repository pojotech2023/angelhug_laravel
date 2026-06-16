@include('header')
<style>
.about-card{
background:#fff;
padding:25px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
height:100%;
transition:0.3s;
}

.about-card h5{
font-weight:600;
margin-bottom:10px;
color:#0b4f74;
}

.about-card p{
font-size:14px;
line-height:1.6;
color:#555;
}

.about-card:hover{
transform:translateY(-5px);
box-shadow:0 10px 30px rgba(0,0,0,0.12);
}
@media (max-width:768px){

.breadcrumb-area{
    background-size: cover !important; /* Ensure the image fully covers the area */
    background-position: center center !important; /* Center the image */
    background-repeat: no-repeat !important;

    height: 20vh; /* Set height to 50% of the viewport height */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

}
.leadership-section{
    background:#f5f7f9;
}

.leadership-title{
    color:#1c7c54;
    font-weight:700;
}

/* Row fix */
.row{
    display:flex;
    flex-wrap:wrap;
}

/* Card fix */
.leader-card{
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    transition:0.3s;

    width:100%;
    height:100%;              /* 🔥 equal height */
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    align-items:center;
}

.leader-card:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
}

/* Image full display in card */
.leader-img{
    width: 100%;
    height: 240px;
    border-radius: 10px;
    object-fit: cover !important;
    object-position: center top;
    margin-bottom: 20px;
}

/* Text alignment fix */
.leader-card h5{
    min-height:50px;
    text-transform: uppercase;
}

.leader-role{
    color:#1c7c54;
    font-weight:600;
    min-height:40px;
    text-align:center;
}
</style>
<section class="breadcrumb-area breadcrumb-about" >
    <div class="text-block" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                {{-- <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="#">About Us</a></li> --}}
                            </ul>
                        </div>
                        <div class="bread-title">
                            <h2> </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-sec-app pad-tb pt60 dark-bg2">
    <div class="container">
        <div class="row align-items-stretch">
            
            <!-- Left content -->
          <div class="col-lg-6 d-flex">
    <div class="common-heading text-l my-auto">

        <h2 class="mb30">
            <span class="text-second text-bold">About PojoCoursePilot</span>
        </h2>

        <div class="medical-coding-list">

            <div class="history-item">
                <i class="fa-solid fa-stethoscope history-icon"></i>
                <p>Premier medical coding training academy specializing in healthcare revenue cycle management and medical billing education.</p>
            </div>

            <div class="history-item">
                <i class="fa-solid fa-book-medical history-icon"></i>
                <p>Comprehensive curriculum covering ICD-10-CM, ICD-10-PCS, CPT, HCPCS, and medical terminology with hands-on practical training.</p>
            </div>

            <div class="history-item">
                <i class="fa-solid fa-user-doctor history-icon"></i>
                <p>Industry-experienced faculty with real-world healthcare coding and billing expertise guiding students to success.</p>
            </div>

            <div class="history-item">
                <i class="fa-solid fa-laptop-medical history-icon"></i>
                <p>Modern learning environment with latest EHR systems and medical coding software for practical experience.</p>
            </div>

            <div class="history-item">
                <i class="fa-solid fa-certificate history-icon"></i>
                <p>Nationally recognized certification programs preparing graduates for immediate employment in healthcare industry.</p>
            </div>

        </div>

    </div>
</div>

            <!-- Right image -->
            <div class="col-lg-6 d-flex">
                <div class="funfact w-100 d-flex">
                    <img src="img/back-1.jpeg" class="img-fluid w-100 object-fit-cover" style="border-radius:10px;">
                </div>
            </div>

        </div>
    </div>
</section>
<section class="about-sec-app pad-tb pt60 dark-bg2">
<div class="container">

<div class="row">

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>PojoCoursePilot</h5>
<p>
PojoCoursePilot is a leading healthcare education institution dedicated to training skilled medical coding professionals.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Our Mission</h5>
<p>
To provide exceptional medical coding education that bridges the gap between healthcare and technology.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Our Programs</h5>
<p>
Comprehensive certification programs in medical coding, medical billing, and healthcare administration.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Industry Partnerships</h5>
<p>
Strong partnerships with hospitals, clinics, and healthcare organizations for internships and placements.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Faculty Excellence</h5>
<p>
Experienced professionals including CPC, CCS certified trainers with real-world healthcare experience.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Career Support</h5>
<p>
Resume development, interview preparation, and job placement assistance for students.
</p>
</div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
<div class="about-card">
<h5>Why Choose Us</h5>
<p>
Industry relevant curriculum, modern facilities, and strong placement record in medical coding.
</p>
</div>
</div>

</div>

</div>
</section>

</section>
<section class="leadership-section py-5" style="display:none;">
<div class="container">

<h2 class="text-center leadership-title">Meet Our Leadership Team</h2>

<div class="row justify-content-center mt-5">

<!-- Leader 2 -->
<div class="col-lg-6 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/maria.jpg') }}" class="leader-img" style="object-fit: contain">

<h5>Maria David V</h5>
<p class="leader-role">DIRECTOR</p>

</div>
</div>

<!-- Leader 1 -->
<div class="col-lg-6 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/jaiganesh.jpg') }}" class="leader-img" style="object-fit: contain">

<h5>Jaiganesh Kumar</h5>
<p class="leader-role">CEO</p>

</div>
</div>
<div class="col-lg-4 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/Manikandan.jpeg') }}" class="leader-img" style="object-fit: contain">

<h5>Manikandan</h5>
<p class="leader-role">BUSINESS AND FINANCIAL HEAD</p>

</div>
</div>
<div class="col-lg-4 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/Surendar.jpeg') }}" class="leader-img" style="object-fit: contain">

<h5>Surendar</h5>
<p class="leader-role">OPERATIONS HEAD</p>

</div>
</div>
<div class="col-lg-4 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/Shankar bhabha.jpeg') }}" class="leader-img" style="object-fit: contain">

<h5>Shankar bhabha</h5>
<p class="leader-role">ADMINISTRATIVE MANAGER</p>

</div>
</div>
<div class="col-lg-6 col-md-6 mb-4 d-flex">
<div class="leader-card text-center">

<img src="{{ asset('img/pavithra.jpeg') }}" class="leader-img" style="object-fit: contain">

<h5>Pavithra</h5>
<p class="leader-role">HR MANAGER</p>

</div>
</div>


    <!-- Sindhuja -->
    <div class="col-lg-6 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/sindhuja.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Sindhuja</h5>
            <p class="leader-role">TRAINING MANAGER</p>
        </div>
    </div>

    <!-- Epshiba -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Epshiba.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Epshiba</h5>
            <p class="leader-role">LEAD TRAINER</p>
        </div>
    </div>

    <!-- Padmaja -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Padmaja.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Padmaja</h5>
            <p class="leader-role">LEAD TRAINER</p>
        </div>
    </div>

    <!-- Parvathavarthini -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Parvathavarthini.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Parvathavarthini</h5>
            <p class="leader-role">SENIOR TRAINER</p>
        </div>
    </div>

    <!-- Aarthi -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Aarthi.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Aarthi</h5>
            <p class="leader-role">SENIOR TRAINER</p>
        </div>
    </div>
    <!-- Revathi -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Revathi.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Revathi</h5>
            <p class="leader-role">SENIOR TRAINER</p>
        </div>
    </div>

    <!-- Afrin -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Afrin.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Afrin</h5>
            <p class="leader-role">SENIOR TRAINER</p>
        </div>
    </div>

    <!-- Deepika -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Deepika.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Deepika</h5>
            <p class="leader-role">TRAINER</p>
        </div>
    </div>

    <!-- Srisubha -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Srisubha.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Srisubha</h5>
            <p class="leader-role">TRAINER</p>
        </div>
    </div>

    <!-- Durga -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Durga.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Durga</h5>
            <p class="leader-role">TRAINER</p>
        </div>
    </div>

    <!-- Bhuvaneshwari -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Bhuvaneshwari.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Bhuvaneshwari</h5>
            <p class="leader-role">TELECALLER</p>
        </div>
    </div>

    <!-- Priya -->
    <div class="col-lg-4 col-md-6 mb-4 d-flex">
        <div class="leader-card text-center w-100">
            <img src="{{ asset('img/Priya.jfif') }}" class="leader-img" style="object-fit: contain;">
            <h5>Priya</h5>
            <p class="leader-role">TELECALLER</p>
        </div>
    </div>

    

    

</div>


</div>
</div>
</section>
@include('footer')
