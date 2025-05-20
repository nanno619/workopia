<x-layout>
<h1>Available Jobs</h1>

<ul>
    @forelse ($jobs as $job)
        <li>{{ $job->title }}</li>
    @empty
        <p>No jobs available</p>
    @endforelse
</ul>
</x-layout>
