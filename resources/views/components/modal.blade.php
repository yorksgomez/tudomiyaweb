@props(['id'])
@push('modals')
    <div 
        class="absolute max-w-md max-h-fit bg-white rounded-md w-full left-0 right-0 top-0 bottom-0 m-auto px-6 pb-2 pt-1 shadow-xl border-2 border-secondary"
        style="display:none;"
        x-data="{
            visible: false,
            id: '{{ $id }}',
            params: {},
            open(ev) {
                if(this.id != ev.detail.id) return;

                this.params = ev.detail;
                console.log(this.params.pqr);
                this.visible = true;
            },
            close(ev) {
                if(this.id == ev.detail.id) this.visible = false;
            }
        }"
        id="{{ $id }}"
        x-show="visible"
        x-on:open.window="open"
        x-on:close.window="close">
        <div class="border-b-2">
            <x-title>{{ $title }}</x-title>
        </div>
        <div class="p-4">
            {{ $slot }}
        </div>
        <div class="border-t-2 w-full pt-2">
            {{ $footer }}
        </div>
    </div>
@endpush