<x-guest-layout>
    <div class="bg-white">
        <header>
            <div class="relative bg-white">
                <div class="flex items-center justify-between px-4 py-6 mx-auto max-w-7xl sm:px-6 md:justify-start md:space-x-10 lg:px-8">
                    <div class="flex justify-start lg:w-0 lg:flex-1">
                        <a href="#">
                            <span class="sr-only">Workflow</span>
                            <img class="w-auto h-8 sm:h-10" src="{{session()->get('tenant') ? session()->get('tenant')->profile_photo_url : 'https://tailwindui.com/img/logos/workflow-mark-indigo-300.svg'}}" alt="">
                        </a>
                    </div>
                    <div class="-my-2 -mr-2 md:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 text-gray-400 bg-white rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                            <span class="sr-only">Open menu</span>
                            <svg class="w-6 h-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="items-center justify-end hidden md:flex md:flex-1 lg:w-0">
                        @auth
                            <a href="{{session()->get('tenant') ? route('dashboard') : route('admin.dashboard')}}" class="inline-flex items-center justify-center px-4 py-2 ml-8 text-base font-medium text-white border border-transparent rounded-md shadow-sm whitespace-nowrap bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                                Dashboard
                            </a>
                        @else
                            <a href="{{route('login')}}" class="inline-flex items-center justify-center px-4 py-2 ml-8 text-base font-medium text-white border border-transparent rounded-md shadow-sm whitespace-nowrap bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                                Log in
                            </a>
                        @endauth
                    </div>
                </div>



            </div>
        </header>

        <main>
            <!-- Hero section -->
            <div class="relative">
                <div class="absolute inset-x-0 bottom-0 bg-gray-100 h-1/2"></div>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
                        <div class="absolute inset-0">
                            <img class="object-cover w-full h-full" src="{{Storage::disk('s3')->url('images/Backgound-Welcome-Page.jpg')}}" alt="Y40">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-800 to-indigo-700" style="mix-blend-mode: multiply;"></div>
                        </div>
                        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                            <h1 class="text-2xl font-extrabold tracking-tight text-center sm:text-3xl lg:text-4xl">
                                <span class="block text-white">{{session()->get('tenant') ? session()->get('tenant')->name : 'Dan Avatar'}}</span>
                                <span class="block text-indigo-200">Laboratorio innovativo tra alta tecnologia e ricerca</span>
                            </h1>
                            <p class="max-w-lg mx-auto mt-6 text-xl text-center text-indigo-200 sm:max-w-3xl">
                                Ambulatorio medico per tutti gli sportivi, gli appassionati dell’acqua e del benessere, particolarmente dedicato ad apneisti e subacquei
                            </p>
                            <p class="max-w-lg mx-auto mt-6 text-xl text-center text-indigo-200 sm:max-w-3xl">
                                In collaborazione con
                            </p>
                            <div class="max-w-sm mx-auto mt-10 sm:max-w-none sm:flex sm:justify-center">
                                <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                                    <a href="#" class="flex items-center justify-center px-4 py-3 text-base font-medium text-indigo-700 bg-white border border-transparent rounded-md shadow-sm hover:bg-indigo-50 sm:px-8">
                                        <img class="h-56 text-center" src="{{session()->get('tenant') ? session()->get('tenant')->profile_photo_url : 'https://tailwindui.com/img/logos/workflow-mark-indigo-300.svg'}}" alt="">

                                    </a>
                                    <a href="#" class="flex items-center justify-center px-4 py-3 text-base font-medium text-indigo-700 bg-white border border-transparent rounded-md shadow-sm hover:bg-indigo-50 sm:px-8">
                                        <img class="h-56 text-center" src="{{Storage::disk('s3')->url('images/dan-europe-logo.png')}}"/>

                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Cloud -->
            <div class="bg-gray-100">
                <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <p class="text-sm font-semibold tracking-wide text-center text-gray-500 uppercase">
                        I nostri partner
                    </p>
                    <div class="grid grid-cols-2 gap-8 mt-6 md:grid-cols-6 lg:grid-cols-5">
                        <div class="flex justify-center col-span-2 md:col-span-6 lg:col-span-5">
                            <img src="{{Storage::disk('s3')->url('images/Y-40-Sponsor.jpg')}}" alt="Tuple">
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer class="bg-gray-50" aria-labelledby="footerHeading">
            <h2 id="footerHeading" class="sr-only">Footer</h2>
            <div class="px-4 pt-16 pb-8 mx-auto max-w-7xl sm:px-6 lg:pt-24 lg:px-8">
                <div class="pt-8 mt-12 border-t border-gray-200 md:flex md:items-center md:justify-between lg:mt-16">
                    <div class="flex space-x-6 md:order-2">

                        <a href="https://www.facebook.com/Y40TheDeepJoy" target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>

                        <a href="https://www.instagram.com/y40_thedeepjoy/"  target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                            </svg>
                        </a>

                        <a href="https://twitter.com/y40thedeepjoy" target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>


                    </div>
                    <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                        © {{date('Y')}} Dan Europe R&I srl. All rights reserved. Powered by Andrea Covelli & Davide Bastiani
                    </p>
                </div>
            </div>
        </footer>
    </div>
</x-guest-layout>
