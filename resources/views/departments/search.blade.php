@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Search Results for "{{ $keyword }}"</h2>

    <form action="{{ route('departments.search') }}" method="GET" class="mb-6 flex items-center gap-4">
        <input type="text" name="keyword" placeholder="Search..." value="{{ $keyword }}" class="border p-2 rounded w-1/3">

        <select name="IsActive" class="border p-2 rounded">
            <option value="">-- Filter by Status --</option>
            <option value="1" {{ $isActive === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $isActive === '0' ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
    </form>

    @if($departments->count() > 0)
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Department Name</th>
                    <th class="px-4 py-2">Code</th>
                    <th class="px-4 py-2">College</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $department->DepartmentName }}</td>
                        <td class="px-4 py-2">{{ $department->DepartmentCode }}</td>
                        <td class="px-4 py-2">{{ $department->college->CollegeName ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-white {{ $department->IsActive ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $department->IsActive ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No departments found.</p>
    @endif
</div>
@endsection
