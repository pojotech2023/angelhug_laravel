@include('header')
<style>
/* Hero section overlay */
.breadcrumb-area{
position: relative;
overflow: hidden;
}

/* White overlay */
.breadcrumb-area::before{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background: rgba(255,255,255,0.45); /* adjust whiteness here */
z-index:1;
}

/* Keep text above overlay */
.breadcrumb-area .text-block{
position: relative;
z-index:2;
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
<section class="breadcrumb-area breadcrumb-book" style="padding: 130px 0" >
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            {{-- <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul> --}}
                        </div>
                        <div class="bread-title">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-page pad-tb">
    <div class="container">
        <div class="row">
            <!-- Quick Contact Section -->
            <div class="col-lg-6">
                <div class="quick-contact">
                    <h3 class="section-title">Quick Contact</h3>
                    <div class="contact-item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="details">
                            <h5>Location</h5>
                            <p>No 77, Velachery main road, Near to Tata motors show room,<br>Rajakilpakkam, Tambaram, Chennai 600073</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="details">
                            <h5>Phone</h5>
                            <p><a href="tel:+918072515050">+91 8072515050</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="details">
                            <h5>Email</h5>
                            <p><a href="mailto:services@pojotechnology.com">services@pojotechnology.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="col-lg-6">
                <div class="contact-form">
                    <h3 class="section-title">Let’s Connect</h3>
                    <form id="contactForm" method="post" action="https://api.web3forms.com/submit">
                        <!-- Web3Forms integration -->
                        <input type="hidden" name="access_key" value="ae65775b-6ab5-4351-b2a6-82375969cf2c">
                        <input type="hidden" name="subject" value="New Contact Form Submission">
                    
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Your Phone" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="contact-submit-btn">Send Message</button>
                    </form>
                    <div id="contactPopup" class="contact-popup">
                        <div class="contact-popup-content">
                            <div class="contact-popup-icon">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <h4 class="contact-popup-title">Message Sent</h4>
                            <p id="contactPopupMessage">Your message has been sent successfully!</p>
                            <button id="contactPopupClose" class="contact-popup-close-btn">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="contact-location">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div style="background:#f8f9fa; padding:16px 20px; text-align:center; border-bottom:3px solid #4a90d9;">
                    <h5 style="margin:0; font-weight:700; color:#333;"><i class="fas fa-map-marker-alt" style="color:#4a90d9; margin-right:8px;"></i>Our Office</h5>
                    <p style="margin:4px 0 0; color:#666; font-size:14px;">No 77, Velachery main road, Near to Tata motors show room, Rajakilpakkam, Tambaram, Chennai 600073</p>
                </div>
                <div class="map-div">
                    <iframe src="https://www.google.com/maps?q=Velachery+main+road+Rajakilpakkam+Tambaram+Chennai+600073&output=embed"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>



@include('footer')

<style>
/* Contact Us Box Styling */
.info-wrapr {
    background: #f8f9fa;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-wrapr:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.info-wrapr h3 {
    font-size: 1.8rem;
    color: #0b4f74;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.dbox {
    margin-bottom: 20px;
    padding: 15px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dbox:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.dbox .icon {
    background: #0b4f74;
    color: #ffffff;
    font-size: 1.5rem;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 15px;
}

.dbox .text {
    color: #333;
    font-size: 1rem;
    line-height: 1.6;
}

.dbox .text span {
    font-weight: bold;
    color: #0b4f74;
}

.dbox .text a {
    color: #0b4f74;
    text-decoration: none;
    font-weight: bold;
}

.dbox .text a:hover {
    text-decoration: underline;
}

/* Contact Page Styling */
.contact-page {
    padding: 60px 0;
    background-color: #f8f9fa;
}

.section-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #0b4f74;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.contact-form .contact-submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 180px;
    min-height: 54px;
    padding: 0 24px;
    border: 1px solid #0b4f74;
    border-radius: 14px;
    background: linear-gradient(135deg, #0b4f74 0%, #156d97 100%);
    color: #ffffff;
    font-size: 17px;
    font-weight: 700;
    letter-spacing: 0.01em;
    text-decoration: none;
    box-shadow: 0 14px 28px rgba(11, 79, 116, 0.2);
    transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease, background 0.22s ease;
}

.contact-form .contact-submit-btn:hover,
.contact-form .contact-submit-btn:focus {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(11, 79, 116, 0.26);
    filter: brightness(1.03);
}

.contact-form .contact-submit-btn:active {
    transform: translateY(0);
    box-shadow: 0 10px 20px rgba(11, 79, 116, 0.18);
}

.section-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #e8456d;
    margin-top: 5px;
}

.quick-contact .contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.quick-contact .icon {
    font-size: 1.5rem;
    color: #0b4f74;
    margin-right: 15px;
}

.quick-contact .details h5 {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 5px;
    color: #0b4f74;
}

.quick-contact .details p {
    margin: 0;
    color: #333;
    font-size: 0.95rem;
}

.contact-form .form-group {
    margin-bottom: 15px;
}

.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.95rem;
}

.contact-form button {
    background-color: #e8456d;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.contact-form button:hover {
    background-color: #d7345a;
}

/* Popup message style */
.contact-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(9, 25, 39, 0.48);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.contact-popup.show {
    display: flex;
}

.contact-popup-content {
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    padding: 30px 30px 26px;
    border-radius: 22px;
    text-align: center;
    max-width: 90%;
    width: 400px;
    border: 1px solid rgba(11, 79, 116, 0.08);
    box-shadow: 0 26px 60px rgba(15, 23, 42, 0.22);
}

.contact-popup-icon {
    width: 74px;
    height: 74px;
    margin: 0 auto 18px;
    border-radius: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0b4f74 0%, #1b7da9 100%);
    color: #ffffff;
    font-size: 28px;
    box-shadow: 0 16px 32px rgba(11, 79, 116, 0.24);
}

.contact-popup-title {
    margin: 0 0 10px;
    font-size: 28px;
    font-weight: 800;
    color: #0b4f74;
}

.contact-popup-content p {
    font-size: 17px;
    line-height: 1.65;
    color: #486173;
    margin: 0 0 20px;
}

.contact-popup-close-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 120px;
    min-height: 48px;
    padding: 0 22px;
    border: 0;
    border-radius: 14px;
    background: linear-gradient(135deg, #0b4f74 0%, #156d97 100%);
    color: #ffffff;
    font-size: 16px;
    font-weight: 700;
    box-shadow: 0 14px 28px rgba(11, 79, 116, 0.2);
    transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
}

.contact-popup-close-btn:hover,
.contact-popup-close-btn:focus {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(11, 79, 116, 0.26);
    filter: brightness(1.03);
}

.contact-popup-close-btn:active {
    transform: translateY(0);
}

@media (max-width: 576px) {
    .contact-popup-content {
        width: calc(100% - 28px);
        padding: 26px 20px 22px;
        border-radius: 18px;
    }

    .contact-popup-title {
        font-size: 24px;
    }
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const popup = document.getElementById('contactPopup');
        const popupMessage = document.getElementById('contactPopupMessage');
        const popupClose = document.getElementById('contactPopupClose');

        if (!form || !popup || !popupClose) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';
            }

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                popupMessage.textContent = 'Thank you! Your message has been sent.';
                popup.classList.add('show');
                form.reset();
            })
            .catch(function(error) {
                popupMessage.textContent = 'Oops! Something went wrong. Please try again.';
                popup.classList.add('show');
                console.error('Form submit error:', error);
            })
            .finally(function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Send Message';
                }
            });
        });

        popupClose.addEventListener('click', function() {
            popup.classList.remove('show');
        });

        popup.addEventListener('click', function(event) {
            if (event.target === popup) {
                popup.classList.remove('show');
            }
        });
    });
</script>
