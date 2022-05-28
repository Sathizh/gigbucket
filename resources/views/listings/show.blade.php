<x-layout>
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="shadow-md">
            <a href="/listings/{{$listing->id}}/edit" class="flex justify-end space-x-2 items-center ">
                <div class="p-2 rounded-md hover:bg-blue-300/80">
                    <i class="fa-solid fa-pencil"></i>
                    <span>Edit</span>
                </div>
                <div>
                    <form action="/listings/{{$listing->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-md hover:bg-red-300/80">
                            <i class="fa-solid fa-trash"></i> <span>Delete</span>
                        </button>
                    </form>
                </div>
            </a>
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{ $listing->logo ? asset('storage/'.$listing->logo) : asset('images/no-image.png') }}" alt='{{$listing->company}}' />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                <x-listing-tags :tagsCsv="$listing->tags" />
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>{{ $listing->description }}</p>
                        <div class="flex flex-col gap-4 justify-center w-full">
                            <div>
                                <a href={{ $listing->email }}
                                    class="bg-laravel px-3 text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                        class="fa-solid fa-envelope"></i>
                                    Contact Employer</a>
                            </div>
                            <div>
                                <a href={{ $listing->Website }} target="_blank"
                                    class="bg-black px-3 text-white py-2 rounded-xl hover:opacity-80"><i
                                        class="fa-solid fa-globe"></i> Visit
                                    Website</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
        </div>
</x-layout>
