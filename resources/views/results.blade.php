<x-layout>
    <x-forms.page-heading>Results</x-forms.page-heading>

    <div class="space-y-6">
        @foreach($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>
</x-layout>
