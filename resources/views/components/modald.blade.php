@props(['formAction' => false])

<div>
    @if ($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
    @endif

    <div class="mt-4 bg-white ml-3 px-4 pb-5 sm:px-4 sm:flex">
        {{ $buttons }}
    </div>
    @if ($formAction)
        </form>
    @endif
</div>
