<!-- Global Toast System (Alpine.js + Livewire Event Listener) -->
<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        timer: null,
        trigger(msg, toastType = 'success') {
            if (!msg) return;
            this.message = msg;
            this.type = toastType || 'success';
            this.show = true;
            if (this.timer) clearTimeout(this.timer);
            this.timer = setTimeout(() => { this.show = false; }, 4500);
        }
    }"
    x-init="
        @if (session()->has('message'))
            trigger('{{ session('message') }}', '{{ session('message_type', 'success') }}');
        @endif
        window.addEventListener('notify', (e) => {
            if (e.detail && e.detail.message) {
                trigger(e.detail.message, e.detail.type || 'success');
            }
        });
        if (typeof Livewire !== 'undefined') {
            Livewire.on('show-toast', (data) => {
                let msg = typeof data === 'string' ? data : (data.message || (Array.isArray(data) ? data[0]?.message : ''));
                let t = typeof data === 'object' ? (data.type || (Array.isArray(data) ? data[0]?.type : 'success')) : 'success';
                if (msg) trigger(msg, t || 'success');
            });
        }
    "
    @show-toast.window="
        let d = $event.detail;
        let msg = typeof d === 'string' ? d : (d.message || (Array.isArray(d) ? (d[0]?.message || d[0]) : ''));
        let t = typeof d === 'object' ? (d.type || (Array.isArray(d) ? d[0]?.type : 'success')) : 'success';
        if (msg) trigger(msg, t || 'success');
    "
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
    class="fixed top-4 right-4 z-[120] flex items-center gap-3 px-4 py-3 rounded-xl shadow-2xl text-white border transition-all"
    :class="{
        'bg-emerald-600 border-emerald-500': type === 'success',
        'bg-amber-600 border-amber-500': type === 'warning' || type === 'alert',
        'bg-crt-navy border-crt-cyan/40': type === 'info'
    }"
>
    <!-- 1. Success Icon (Green) -->
    <template x-if="type === 'success'">
        <svg class="w-5 h-5 animate-pulse text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </template>

    <!-- 2. Warning / Alert Icon (Amber) -->
    <template x-if="type === 'warning' || type === 'alert'">
        <svg class="w-5 h-5 animate-pulse text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </template>

    <!-- 3. Info Icon (Navy / CRT Cyan) -->
    <template x-if="type === 'info'">
        <svg class="w-5 h-5 animate-pulse text-crt-cyan shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </template>

    <span class="text-sm font-semibold tracking-wide" x-text="message"></span>

    <button @click="show = false" class="ml-2 text-white/80 hover:text-white p-0.5 cursor-pointer rounded-lg hover:bg-white/10 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
</div>
