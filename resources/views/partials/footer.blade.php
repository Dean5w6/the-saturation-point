<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="footer-heading">The Saturation Point</h5>
                <p class="text-white-50 small">
                    Purveyors of fine writing instruments and inks. 
                    Dedicated to the art of handwriting in a digital age.
                </p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Shop Pens</a></li>
                    <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Shop Inks</a></li>
                </ul>
            </div>
             
            <div class="col-md-4 mb-4" id="footer-contact">
                <h5 class="footer-heading">Contact</h5>
                <p class="text-white-50 small">
                    <i class="fas fa-envelope me-2"></i>contact@thesaturationpoint.tech<br>
                    <i class="fas fa-map-marker-alt me-2"></i> TUP - Taguig Campus
                </p>
            </div>
        </div>
        <div class="row mt-4 pt-4 border-top border-secondary">
            <div class="col-12 text-center text-white-50 small">
                &copy; {{ date('Y') }} The Saturation Point. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>