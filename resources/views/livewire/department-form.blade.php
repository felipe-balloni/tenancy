<div class="py-4">
    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}

        <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Submit
        </button>
    </form>
</div>
