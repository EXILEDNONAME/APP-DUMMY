<div class="flex items-stretch" id="megaMenuContainer">
    <div class="flex items-stretch [--kt-reparent-mode:prepend] [--kt-reparent-target:body] lg:[--kt-reparent-target:#megaMenuContainer] lg:[--kt-reparent-mode:prepend]" data-kt-reparent="true">
        <div class="hidden lg:flex lg:items-stretch [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start fixed z-10 top-0 bottom-0 w-full me-5 max-w-[250px] p-5 lg:p-0 overflow-auto" id="mega_menu_wrapper">
            <div class="kt-menu flex-col lg:flex-row gap-5 lg:gap-7.5" data-kt-menu="true" id="mega_menu">
                <div class="kt-menu-item active">
                    <a class="kt-menu-link text-nowrap text-sm text-foreground font-medium kt-menu-item-hover:text-primary kt-menu-item-active:text-mono kt-menu-item-active:font-medium" href="javascript:void(0);">
                        <span class="kt-menu-title text-nowrap"> Dashboard </span>
                    </a>
                </div>
                @role('master-administrator')
                <div class="kt-menu-item active">
                    <a class="kt-menu-link text-nowrap text-sm text-foreground font-medium kt-menu-item-hover:text-primary kt-menu-item-active:text-mono kt-menu-item-active:font-medium" href="javascript:void(0);">
                        <span class="kt-menu-title text-nowrap"> Custom </span>
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </div>
</div>