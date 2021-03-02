@props([
    'disabled' => false,
    'label'=>null,
    'type'=>'text',
    'format'=>'DD-MM-YYYY',
    'min'=>null,
    'max'=>null,
    'value'=>null,
    ])
@php
$id=$attributes->whereStartsWith('wire:model')->first();
//$var=\Illuminate\Support\Str::random(6);
$var=generateRandomString(6);

@endphp
<div class="{{$attributes->get('class')}}" x-data="{}" x-init="">
    @if ($label)
        <x-form.label for="{{$attributes->whereStartsWith('wire:model')->first()}}"> {{ $label}} </x-form.label>
    @endif
    <div class="mt-1 relative rounded-md shadow-sm">

        <input
            @if ($disabled)
            disabled
            @endif
            {{$attributes->whereStartsWith('wire:model')}}
            value="{{$value}}"
            type="{{$type}}"
            id="{{$id}}_masked"
            @error($id)
            class="block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md"
            aria-invalid="true"
            aria-describedby="email-error"
            @else
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            @endif

        />

        @error($id)
        <div wire:key="error_svg_{{$id}}" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <!-- Heroicon name: exclamation-circle -->
            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror

    </div>
    @error($id)
    <p wire:key="error_{{$id}}"
       class="mt-2 text-sm text-red-600" id="{{$id}}-error">{{$message}}</p>
    @enderror
</div>


<script>
    var {{$var}}=window.IMask(document.getElementById('{{$id}}_masked'), {
        mask: Date,
        pattern: '{{$format}}',
        lazy: false,
        @if($min)
        min: new Date("{{$min}}"),
        @else
        min: new Date("1900-01-01"),
        @endif
        @if($max)
        max: new Date("{{$max}}"),
        @else
        max: new Date("3000-12-31"),
        @endif

        format: function (date) {
            return moment(date).format('{{$format}}');
        },
        parse: function (str) {
            return moment(str, '{{$format}}');
        },

        blocks: {
            YYYY: {
                mask: IMask.MaskedRange,
                @if($min)
                from: new Date("{{$min}}").getFullYear(),
                @else
                from: new Date("1900-01-01").getFullYear(),
                @endif
                @if($max)
                to: new Date("{{$max}}").getFullYear(),
                @else
                to: new Date("3000-12-31").getFullYear(),
                @endif
                placeholderChar:"A"
            },
            MM: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12,
                placeholderChar:"M"
            },
            DD: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 31,
                placeholderChar:"D"
            },
            HH: {
                mask: IMask.MaskedRange,
                from: 0,
                to: 23,
                placeholderChar:"h"

            },
            mm: {
                mask: IMask.MaskedRange,
                from: 0,
                to: 59,
                placeholderChar:"m"
            }
        }
    });


</script>
