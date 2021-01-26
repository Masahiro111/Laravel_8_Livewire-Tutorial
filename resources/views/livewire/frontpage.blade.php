<div>
    <div class="sm:bg-blue-500 md:bg-red-500 border p-5 text-gray-100 bg-gray-400 text-3xl">{{ $title }}</div>
    <div class="lg:flex">
        <div class="border p-5 text-left lg:w-1/2">
            {!! $content !!}
        </div>
        <div class="border bg-gray-400 lg:w-1/2">
            <img class="w-full h-full object-cover object-center" src="{{ 'img/mountain.jpg' }}" alt="">
        </div>
    </div>
</div>