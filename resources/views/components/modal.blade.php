@props(['namaModal'])
<div class="fixed w-screen h-screen top-0 left-0 z-40 flex flex-col items-center justify-center bg-base-content bg-opacity-80 space-y-4"
    x-show="modal == '{{ $namaModal }}'"
    >
    <div class="card p-4 bg-base-200 flex flex-row items-center space-x-4">
        <h2 class="font-bold text-14 " x-text="judul"></h2>
        <button class="btn btn-secondary btn-sm" @click="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <div class="bg-base-200 p-8 card space-y-4">
        {{ $slot }}
    </div>
</div>
