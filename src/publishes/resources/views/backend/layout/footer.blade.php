<footer class="footer">
    <div class="container-fluid">
        <nav>
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        {{ config('app.name') }}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, {{ config('app.name') }}.
        </div>
    </div>
</footer>