<div class="navbar z-depth-1">
    <nav class="header-nav white">
        <div class="nav-wrapper container">
            <div class="header-logo">
                <a href="#!" class="brand-logo hide-on-med-and-down black-text">{{ isset($hotel)? $hotel : 'Hotel' }}</a>
            </div>
            <div class="header-icons">
                <a href="" class="tooltipped mr20 black-text" data-position="bottom" data-tooltip="Contact">
                    {!! isset($contact1)? '<i class="fas fa-phone"></i>' . $contact1 : '' !!}
                </a>
                <a href="" class="tooltipped black-text" data-position="bottom" data-tooltip="Email">
                    {!! isset($email)? '<i class="far fa-envelope"></i>' . $email : '' !!}
                </a>
            </div>
        </div>
    </nav>
</div>


