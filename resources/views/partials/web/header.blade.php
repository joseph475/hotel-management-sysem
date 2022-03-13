<div class="navbar z-depth-1">
    <nav class="header-nav">
        <div class="nav-wrapper container">
            <div class="header-logo">
                <a href="#!" class="brand-logo hide-on-med-and-down">{{ isset($variables['hotel'])? $variables['hotel'] : 'Hotel' }}</a>
            </div>
            <div class="header-icons">
                <a href="" class="tooltipped" data-position="bottom" data-tooltip="Email">
                    {!! isset($variables['email']) ? '<i class="far fa-envelope"></i>' . $variables['email'] : '' !!}
                </a>
            </div>
        </div>
    </nav>
</div>


