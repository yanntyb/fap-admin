@if($showModal)
<x-modal>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-slot name="content">
        <p>The Body</p>
    </x-slot>

    <x-slot name="footer">
        <button class="btn btn-primary" @click="$wire.emit('closeModal')">Close</button>
    </x-slot>
</x-modal>
@endif
