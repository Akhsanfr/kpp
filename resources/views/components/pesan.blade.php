<div class="fixed top-0 left-0 w-screen z-50"
    x-data="{
            pesan : false,
            setAlert(isi, tipe){
                this.pesan = true;
                isiNode = `<ul></ul>`;
                isi.forEach((val) => {
                    isiNode += (`<li>${val}</li>`);
                })
                isiNode += `</ul>`;
                if(tipe == 'success'){
                    warna = `alert-success`;
                    path = `<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>`;
                } else if(tipe == 'info'){
                    warna = `alert-info`;
                    path = `<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>`;
                } else if(tipe == 'error'){
                    warna = `alert-error`;
                    path = `<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'></path>`;
                } else if(tipe == 'warning'){
                    warna = `alert-warning`;
                    path = `<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'></path>`;
                }
                $refs.pesan.innerHTML =
                `
                    <div class='p-4'>
                        <div class='alert flex-row flex-nowrap items-start ${warna}'>
                            <div class='flex-1 space-x-2'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='w-6 h-6 mx-2 stroke-current'>
                                    ${path}
                                </svg>
                                <label>
                                    ${isiNode}
                                </label>
                            </div>
                            <svg @click='closePesan()' xmlns='http://www.w3.org/2000/svg' class='cursor-pointer h-5 w-5' viewBox='0 0 20 20' fill='currentColor'>
                                <path fill-rule='evenodd' d='M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z' clip-rule='evenodd' />
                            </svg>
                        </div>
                    </div>
                `
            },
            closePesan(){
                this.pesan = false;
            }
        }"
    @pesan.window="setAlert($event.detail.isi, $event.detail.tipe)"
    x-ref="pesan"
    x-show="pesan"
>

</div>
