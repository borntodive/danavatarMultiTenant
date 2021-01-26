<div id="{{Str::slug($title)}}" class="container mx-auto bg-white shadow rounded">
    <div class="xl:w-full border-b border-gray-300 py-5">
        <div class="flex items-center w-11/12 mx-auto">
            <p class="text-lg text-gray-800 font-bold">{{$title}}</p>
            <div class="ml-2 cursor-pointer text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                    <path class="heroicon-ui"
                          d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                          fill="currentColor"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="w-11/12 mx-auto py-5">
        <div class="container mx-auto">
            <div class="my-8 mx-auto xl:w-full xl:mx-0">
                <div class="xl:flex lg:flex md:flex flex-wrap justify-between">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>

