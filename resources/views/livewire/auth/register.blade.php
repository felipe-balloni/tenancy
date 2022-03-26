<div class="flex min-h-screen font-semibold text-gray-900 bg-center bg-no-repeat bg-cover"
    style="background-image: url( 'https://source.unsplash.com/Kz8nHVg_tGI' );">
    <x-unsplash-attribute />
    <div class="flex justify-center w-1/2 p-4 bg-gradient-to-r from-black via-black to-gray-800">
        <div class="flex items-center justify-center">
            <div class="px-2 py-4 mx-2 my-4 divide-y divide-gray-900 rounded-lg bg-gray-50 ">
                <div class="p-8">
                    Social Login (with laravel socialite)
                </div>
                <div class="p-8">Normal Login

                    <div class="py-2">
                        <form wire:submit.prevent="submit" class="">
                            {{ $this->form }}

                            <div class="pt-8">

                                <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center w-full p-4 text-gray-50 bg-gradient-to-r from-gray-800 to-transparent">
        <div class="flex items-center justify-center">
            asasas
        </div>
    </div>
</div>
