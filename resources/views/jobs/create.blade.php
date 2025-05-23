<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <label class="block text-gray-700" for="title">Job Title</label>
        <input
            type="text"
            name="title"
            placeholder="Title"
            class="w-full px-4 py-2 border rounded focus:outline-none"
        />

        <label class="block text-gray-700" for="title">Job Description</label>
        <textarea
            cols="30"
            rows="7"
            id="description"
            name="description"
            class="w-full px-4 py-2 border rounded focus:outline-none"
            placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
        ></textarea>
        <button type="submit">Submit</button>
    </form>
</x-layout>
