flatpickr("#datepicker", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d F Y",
    allowInput: true,
    disableMobile: true
});

function toast_notification(message) {
    KTToast.show({
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
        progress: true,
        pauseOnHover: true,
        maxToasts: 3,
        position: 'bottom-end',
        variant: 'mono',
        message: message
    });
}