<div class="lg:col-span-3">
  <div class="grid">
    <div class="kt-alert kt-alert-light kt-alert-success" id="welcome">
      <div class="kt-alert-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info" aria-hidden="true">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M12 16v-4"></path>
          <path d="M12 8h.01"></path>
        </svg>
      </div>
      <div class="kt-alert-title"> Welcome, <span class="font-semibold"> {{ Auth::User()->name }} </span></div>
      <div class="kt-alert-toolbar">
        <div class="kt-alert-actions">
          <button class="kt-alert-close" data-kt-dismiss="#welcome">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x" aria-hidden="true">
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="lg:col-span-1">
  <div class="grid">
    <div class="kt-card kt-card-grid py-3">
      <div class="flex justify-center">
        <h3 class="font-semibold text-sm"> Total Sessions </h3>
      </div>
      <div class="pt-2 flex justify-center">
        {{ \DB::table('sessions')->count() }}
      </div>
    </div>
  </div>
</div>

<div class="lg:col-span-1">
  <div class="grid">
    <div class="kt-card kt-card-grid py-3">
      <div class="flex justify-center">
        <h3 class="font-semibold text-sm"> Total Users </h3>
      </div>
      <div class="pt-2 flex justify-center">
        8
      </div>
    </div>
  </div>
</div>

<div class="lg:col-span-1">
  <div class="grid">
    <div class="kt-card kt-card-grid py-3">
      <div class="flex justify-center">
        <h3 class="font-semibold text-sm"> Total Datatable Generals </h3>
      </div>
      <div class="pt-2 flex justify-center">
        {{ number_format(\DB::table('system_application_table_generals')->count(), 0, ',', '.') }}
      </div>
    </div>
  </div>
</div>