<footer>
    <div class="footer-container">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4">
                    <h4>PojoCoursePilot</h4>
                    <p>
                        Founded in 2021, Pojo Technology collaborates with customers and partners to deliver innovative solutions across multiple industries. Leveraging proprietary core technologies, Pojo Technology specializes in Website Development, Mobile Application Development, and Digital Marketing services to enhance enterprise operations and drive growth.
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-4">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{ url('list/course') }}">Course List</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p><strong>Address:</strong><br>No 77, Velachery main road, Near to Tata motors show room,<br>Rajakilpakkam, Tambaram, Chennai 600073</p>
                    <p><strong>Phone:</strong><br>
                        <a href="tel:+918072515050">+91 8072515050</a>
                    </p>
                    <p><strong>Email:</strong> <a href="mailto:services@pojotechnology.com">services@pojotechnology.com</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
body { margin-bottom: 0 !important; padding-bottom: 0 !important; }
.footer-container {
    background-color: #0b4f74; /* Dark blue background */
    color: #ffffff; /* White text */
    padding: 40px 20px 20px;
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 0;
}

.footer-container h4 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #ff69b4; /* Pink color for headings */
}

.footer-container ul {
    list-style: none;
    padding: 0;
}

.footer-container ul li {
    margin-bottom: 10px;
}

.footer-container ul li a {
    color: #ffffff; /* White link color */
}

.footer-container ul li a:hover {
    color: #d1e7ff; /* Light blue on hover */
    text-decoration: underline;
}

.footer-container .row {
    justify-content: space-between; /* Space between columns */
}

.footer-container .col-md-4 {
    padding: 0 20px; /* Add padding to both sides of the columns */
}
.footer-container .col-md-4:nth-child(2){
    padding-left: 80px;
}
.footer-container a{
color:#ffffff !important;
text-decoration:none;
}

.footer-container a:hover{
color:#ff69b4 !important;

}
@media (max-width:768px){

.footer-container{
padding:30px 15px;
text-align:left;
}

/* stack columns */
.footer-container .row{
flex-direction:column;
gap:25px;
}

/* full width columns */
.footer-container .col-md-4{
width:100%;
padding:0 !important;
}

/* remove large padding from 2nd column */
.footer-container .col-md-4:nth-child(2){
padding-left:0 !important;
}

/* heading size */
.footer-container h4{
font-size:17px;
margin-bottom:12px;
}

/* list spacing */
.footer-container ul li{
margin-bottom:8px;
}

/* links */
.footer-container ul li a{
font-size:14px;
}

/* Ensure phone and email text is white by default */
.footer-container p a {
    color: #ffffff; /* White text for phone and email */
    font-weight: bold; /* Make text bold for better visibility */
    text-decoration: none; /* Remove underline */
}

.footer-container p a:hover {
    color: #d1e7ff; /* Light blue on hover */
    text-decoration: underline; /* Add underline on hover */
}
}
</style>

	<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="{{ asset('js/vendor/modernizr-3.5.0.min.js')}}"></script>
	<script src="{{ asset('js/jquery.min.js')}}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('js/plugin.min.js')}}"></script>
	<script src="{{ asset('js/dark-mode.js')}}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>

	<script src="{{ asset('js/main.js')}}"></script>
</body>

</html>
