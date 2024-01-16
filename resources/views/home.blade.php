<x-app-layout>

    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @foreach ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @endforeach
        <!-- Pagination -->
        <div class="flex items-center py-8">
            {{ $posts->links() }}
        </div>

    </section>

    <!-- Sidebar Section -->
    <x-side-bar></x-side-bar>

</x-app-layout>
