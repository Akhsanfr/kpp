<section class="flex flex-row">
    <section class="p-4 bg-base-200 min-h-screen ">
        {{-- LOGO --}}
        <div class="flex flex-row items-center mb-4">
            <img src="{{ asset('img/djp.png') }}" alt="Logo" class="h-16">
            <div class="flex flex-col items-center">
                <span class="font-bold text-xl text-primary whitespace-nowrap">KPP Madya Jakarta Pusat</span>
                <div class="font-bold text-l text-secondary">
                    <span>{{ date('d') }}</span>
                    <span x-text="bulanDaftar[{{ date('m')-1 }}].nama"></span>
                    <span>{{ date('Y') }}</span>
                </div>
            </div>
        </div>
        {{-- LOGO --}}
        {{ $sidebar }}
    </section>
    <main>
        {{ $slot }}
    </main>
</section>
