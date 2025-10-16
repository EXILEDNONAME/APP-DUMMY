<footer class="kt-footer">
    <div class="kt-container-fluid">
        <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-3 py-5">
            <div class="flex order-2 md:order-1 gap-2 font-normal text-sm"></div>
            <nav class="flex order-1 md:order-2 gap-1 font-normal text-sm text-secondary-foreground">
                <span class="text-secondary-foreground"> 2025 | </span>
                <a class="text-secondary-foreground hover:text-primary" href="https://exilednoname.com"> {{ \DB::table('system_settings')->first()->application_name; }} </a>
            </nav>
        </div>
    </div>
</footer>