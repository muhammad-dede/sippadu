<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">
            COPYRIGHT &copy; {{ date('Y') }}
            <a class="ms-25" href="{{ url('/') }}" target="_blank"
                id="footer-link">{{ config('app.name') }}</a><span class="d-none d-sm-inline-block">, All rights
                Reserved</span>
        </span>
        <span class="float-md-end d-none d-md-block">{{ config('app.name_2') }}
            <i data-feather="heart"></i>
        </span>
    </p>
</footer>
