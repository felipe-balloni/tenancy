<div class="py-4">
    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit
        </button>
    </form>
</div>

