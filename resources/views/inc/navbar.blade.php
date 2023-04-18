<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}

            <!-- Branding Image -->
            <a class="navbar-brand" href="">
                {{ config('app.shortname', '') }}
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/records">Records</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>

    </div>
</nav>