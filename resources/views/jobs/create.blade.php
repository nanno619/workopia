<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input
            type="text"
            name="title"
            id="title"
            placeholder="Title"
        />
        <input type="text" name="description" id="description" placeholder="Description">
        <button type="submit">Submit</button>
    </form>
</x-layout>
