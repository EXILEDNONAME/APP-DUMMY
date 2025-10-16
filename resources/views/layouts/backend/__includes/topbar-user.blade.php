<div class="shrink-0" data-kt-dropdown="true" data-kt-dropdown-offset="10px, 10px" data-kt-dropdown-offset-rtl="-20px, 10px" data-kt-dropdown-placement="bottom-end" data-kt-dropdown-placement-rtl="bottom-start" data-kt-dropdown-trigger="click">
    <div class="cursor-pointer shrink-0" data-kt-dropdown-toggle="true">
        <img alt="" class="size-9 rounded-full border-2 border-green-500 shrink-0" src="{{ isset(Auth::User()->avatar) ? env("APP_URL") . '/storage/avatar/' . Auth::User()->id . '/' . Auth::User()->avatar : env("APP_URL") . '/assets/backend/media/avatars/blank.png' }}" />
    </div>
    <div class="kt-dropdown-menu w-[320px]" data-kt-dropdown-menu="true">
        <div class="flex items-center justify-between px-2.5 py-1.5 gap-1.5">
            <div class="flex items-center gap-2">
                <img alt="" class="size-9 shrink-0 rounded-full border-2 border-green-500" src="{{ isset(Auth::User()->avatar) ? env("APP_URL") . '/storage/avatar/' . Auth::User()->id . '/' . Auth::User()->avatar : env("APP_URL") . '/assets/backend/media/avatars/blank.png' }}" />
                <div class="flex flex-col gap-1.5">
                    <span class="text-sm text-foreground font-semibold leading-none"> {{ Auth::User()->name }} </span>
                    <span class="text-xs text-foreground leading-none">
                        @php $role = \App\Models\Permission::where('model_id', Auth::User()->id)->first() @endphp
                        {{ ucwords(str_replace(['-', '_'], ' ', \App\Models\Role::where('id', $role->role_id)->first()->name)) }}
                    </span>
                </div>
            </div>
            <span class="kt-badge kt-badge-sm kt-badge-primary kt-badge-outline">
                Premium
            </span>
        </div>
        <ul class="kt-dropdown-menu-sub">
            <li>
                <div class="kt-dropdown-menu-separator">
                </div>
            </li>
            <li>
                <a class="kt-dropdown-menu-link" href="html/demo1/account/home/user-profile.html">
                    <i class="ki-filled ki-profile-circle">
                    </i>
                    My Profile
                </a>
            </li>
            <li data-kt-dropdown="true" data-kt-dropdown-placement="right-start" data-kt-dropdown-trigger="hover">
                <button class="kt-dropdown-menu-toggle" data-kt-dropdown-toggle="true">
                    <i class="ki-filled ki-setting-2">
                    </i>
                    My Account
                    <span class="kt-dropdown-menu-indicator">
                        <i class="ki-filled ki-right text-xs">
                        </i>
                    </span>
                </button>
                <div class="kt-dropdown-menu w-[220px]" data-kt-dropdown-menu="true">
                    <ul class="kt-dropdown-menu-sub">
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/home/get-started.html">
                                <i class="ki-filled ki-coffee">
                                </i>
                                Get Started
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/home/user-profile.html">
                                <i class="ki-filled ki-some-files">
                                </i>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="#">
                                <span class="flex items-center gap-2">
                                    <i class="ki-filled ki-icon">
                                    </i>
                                    Billing
                                </span>
                                <span class="ms-auto inline-flex items-center" data-kt-tooltip="true" data-kt-tooltip-placement="top">
                                    <i class="ki-filled ki-information-2 text-base text-muted-foreground">
                                    </i>
                                    <span class="kt-tooltip" data-kt-tooltip-content="true">
                                        Payment and subscription info
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/security/overview.html">
                                <i class="ki-filled ki-medal-star">
                                </i>
                                Security
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/members/teams.html">
                                <i class="ki-filled ki-setting">
                                </i>
                                Members & Roles
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/integrations.html">
                                <i class="ki-filled ki-switch">
                                </i>
                                Integrations
                            </a>
                        </li>
                        <li>
                            <div class="kt-dropdown-menu-separator">
                            </div>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link" href="html/demo1/account/security/overview.html">
                                <span class="flex items-center gap-2">
                                    <i class="ki-filled ki-shield-tick">
                                    </i>
                                    Notifications
                                </span>
                                <input checked="" class="ms-auto kt-switch" name="check" type="checkbox" value="1" />
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li data-kt-dropdown="true" data-kt-dropdown-placement="right-start" data-kt-dropdown-trigger="hover">
                <button class="kt-dropdown-menu-toggle py-1" data-kt-dropdown-toggle="true">
                    <span class="flex items-center gap-2">
                        <i class="ki-filled ki-icon">
                        </i>
                        Language
                    </span>
                    <span class="ms-auto kt-badge kt-badge-stroke shrink-0">
                        @if ( app()->getLocale() == 'en' )
                        English <img alt="" class="inline-block size-3.5 rounded-full" src="{{ env('APP_URL') }}/assets/backend/media/flags/united-states.svg" />
                        @else
                        Bahasa <img alt="" class="inline-block size-3.5 rounded-full" src="{{ env('APP_URL') }}/assets/backend/media/flags/indonesia.svg" />
                        @endif

                    </span>
                </button>
                <div class="kt-dropdown-menu w-[180px]" data-kt-dropdown-menu="true">
                    <ul class="kt-dropdown-menu-sub">
                        <li class="active">
                            <a class="kt-dropdown-menu-link" href="{{ route('language', 'en') }}">
                                <span class="flex items-center gap-2">
                                    <img alt="" class="inline-block size-4 rounded-full" src="{{ env('APP_URL') }}/assets/backend/media/flags/united-states.svg" />
                                    <span class="kt-menu-title"> English </span>
                                </span>
                                {!! app()->getLocale() == 'en' ? '<i class="ki-solid ki-check-circle ms-auto text-green-500 text-base"></i>' : '' !!}
                            </a>
                        </li>
                        <li class="">
                            <a class="kt-dropdown-menu-link" href="{{ route('language', 'id') }}">
                                <span class="flex items-center gap-2">
                                    <img alt="" class="inline-block size-4 rounded-full" src="{{ env('APP_URL') }}/assets/backend/media/flags/indonesia.svg" />
                                    <span class="kt-menu-title">
                                        Bahasa
                                    </span>
                                </span>
                                {!! app()->getLocale() == 'id' ? '<i class="ki-solid ki-check-circle ms-auto text-green-500 text-base"></i>' : '' !!}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="kt-dropdown-menu-separator"></div>
            </li>
        </ul>
        <div class="px-2.5 pt-1.5 mb-2.5 flex flex-col gap-3.5">
            <div class="flex items-center gap-2 justify-between">
                <span class="flex items-center gap-2">
                    <i class="ki-filled ki-moon text-base text-muted-foreground">
                    </i>
                    <span class="font-medium text-2sm">
                        Dark Mode
                    </span>
                </span>
                <input class="kt-switch" data-kt-theme-switch-state="dark" data-kt-theme-switch-toggle="true" name="check" type="checkbox" value="1" />
            </div>
            <a data-kt-modal-toggle="#modalLogout" class="kt-btn kt-btn-outline justify-center w-full">
                Log out
            </a>
        </div>
    </div>
</div>