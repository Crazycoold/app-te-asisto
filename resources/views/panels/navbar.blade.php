<div class="navbar @if ($configData['isNavbarFixed'] === true){{ 'navbar-fixed' }} @endif">
    <nav class="{{ $configData['navbarMainClass'] }} @if ($configData['isNavbarDark'] === true) {{ 'navbar-dark' }} @elseif($configData['isNavbarDark']=== false) {{ 'navbar-light' }} @elseif(!empty($configData['navbarBgColor'])) {{ $configData['navbarBgColor'] }} @else {{ $configData['navbarMainColor'] }} @endif">
        <div class="nav-wrapper">
        </div>
        <nav class="display-none search-sm">
            <div class="nav-wrapper">
                <form id="navbarForm">
                    <div class="input-field search-input-sm">
                        <input class="search-box-sm mb-0" type="search" required="" placeholder='Explore Materialize'
                            id="search" data-search="starter-kit-list">
                        <label class="label-icon" for="search">
                            <i class="material-icons search-sm-icon">search</i>
                        </label>
                        <i class="material-icons search-sm-close">close</i>
                        <ul class="search-list collection search-list-sm display-none"></ul>
                    </div>
                </form>
            </div>
        </nav>
    </nav>
</div>
