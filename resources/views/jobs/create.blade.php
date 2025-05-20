<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input
            type="text"
            name="keywords"
            placeholder="Keywords"
            class="w-full px-4 py-2 border rounded focus:outline-none"
        />

        <textarea
            type="text"
            name="keywords"
            cols="30"
            rows="7"
            placeholder="Keywords"
            class="w-full px-4 py-2 border rounded focus:outline-none"
        />
        </textarea>
        <input type="text" name="description" id="description" placeholder="Description">
        <button type="submit">Submit</button>
    </form>
</x-layout>
