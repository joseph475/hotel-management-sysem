<form action="" method="GET">
    <div class="search">
        <input class="search-field with-borders" name="search"  type="text" value="{{ isset($search) ? $search : ''}}"/> 
        <a href="javascript:void(0)" class="btn btn-flat search-btn btn-1" id="searchbtn"><i class="material-icons">search</i></a>
    </div>
</form>

<script type="text/javascript" src="{{ url('/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/jquery-confirm.js') }}"></script>
<script src="{{ asset('/js/pages/Search/index.js') }}"></script>
