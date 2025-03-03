<div x-data="{ show: @entangle('show') }" x-show="show" x-transition class="fixed top-4 right-4 z-50">
    <div class="flex items-center p-4 mb-4 rounded-lg shadow-md"
         :class="{
             'bg-green-50 text-green-800': '{{ $type }}' === 'success',
             'bg-red-50 text-red-800': '{{ $type }}' === 'error',
             'bg-blue-50 text-blue-800': '{{ $type }}' === 'info'
         }"
         role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            {{ $message }}
        </div>
        <button type="button" wire:click="close"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8"
                :class="{
                    'bg-green-50 text-green-500 hover:bg-green-200': '{{ $type }}' === 'success',
                    'bg-red-50 text-red-500 hover:bg-red-200': '{{ $type }}' === 'error',
                    'bg-blue-50 text-blue-500 hover:bg-blue-200': '{{ $type }}' === 'info'
                }"
                aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>
