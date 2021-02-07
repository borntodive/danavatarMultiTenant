@props([
    'user',
    'buttonLabel'=>null,
])
<div wire:key="header" class="md:flex md:items-center md:justify-between md:space-x-5">
    <div class="flex items-start space-x-5">
        <div class="flex-shrink-0">
            <div class="relative">
                <img class="h-16 w-16 rounded-full" src="{{$user->profilePhotoUrl}}" alt="">
                <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
            </div>
        </div>
        <!--
          Use vertical padding to simulate center alignment when both lines of text are one line,
          but preserve the same layout if the text wraps without making the image jump around.
        -->
        <div class="pt-1.5">
            <h1 class="text-2xl font-bold text-gray-900">{{$user->name}}</h1>
            <span class="flex items-center text-sm font-medium text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <a href="mailto:{{$user->email}}" class="ml-2 text-gray-900">{{$user->email}}</a>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="ml-2 text-gray-900">{{$user->dob->isoFormat('L')}}</span>
            </span>
        </div>
    </div>
    @if($buttonLabel)
    <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
        <button wire:click="showEdit({{$user->id}})" type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
            {{$buttonLabel}}
        </button>
    </div>
    @endif
</div>
