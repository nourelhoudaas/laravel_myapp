<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/lib/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/main/user/user.js')}}"></script>
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/main/user/user.js') }}"></script>
<script src="{{ asset('assets/app.js') }}"></script>



<script>
    /*==================== SHOW NAVBAR ====================*/
    const showMenu = (headerToggle, navbarId) => {
        const toggleBtn = document.getElementById(headerToggle),
            nav = document.getElementById(navbarId)

        // Validate that variables exist
        if (headerToggle && navbarId) {
            toggleBtn.addEventListener('click', () => {
                // We add the show-menu class to the div tag with the nav__menu class
                nav.classList.toggle('show-menu')
                // change icon
                toggleBtn.classList.toggle('bx-x')
            })
        }
    }
    showMenu('header-toggle', 'navbar')

    /*==================== LINK ACTIVE ====================*/
    const linkColor = document.querySelectorAll('.nav__link')

    function colorLink() {
        linkColor.forEach(l => l.classList.remove('active'))
        this.classList.add('active')
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink))
</script>

