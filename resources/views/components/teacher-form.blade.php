<div>
<form method="POST" action="{{ $teacher ? route('teachers.update', $teacher) : route('teachers.store') }}">
    @csrf
    @if ($teacher)
        @method('PUT')
    @endif
    <div class="p-2 m-2 rounded-lg border-2 border-blue-900 max-w-md">
        <div class="text-sm">
            <input name="name" type="text" placeholder="Full Name" value="{{ old('name', $teacher?->name) }}" required />
            @error('name') <p class="text-red-700">{{ $message }}</p> @enderror
        </div>
        <p class="text-sm">
            <input name="email" type="email" placeholder="Email Address" value="{{ old('email', $teacher?->email) }}" required />
            @error('email') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <input name="subject" type="text" placeholder="Subject Taught" value="{{ old('subject', $teacher?->subject) }}" required />
            @error('subject') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <input name="department" type="text" placeholder="Department" value="{{ old('department', $teacher?->department) }}" required />
            @error('department') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <input name="room" type="text" placeholder="Room/Office" value="{{ old('room', $teacher?->room) }}" required />
            @error('room') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <input name="years" type="number" step="1" min="0" max="255" placeholder="Years of Experience" value="{{ old('years', $teacher?->years) }}" required />
            @error('years') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <input name="qualification" type="text" placeholder="Highest Qualification" value="{{ old('qualification', $teacher?->qualification) }}" required />
            @error('qualification') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <p class="text-sm">
            <textarea name="bio" class="text-sm w-full block" placeholder="Teacher Biography..." required>{{ old('bio', $teacher?->bio) }}</textarea>
            @error('bio') <p class="text-red-700">{{ $message }}</p> @enderror
        </p>
        <div>
            <button type="submit" class="bg-gray-800 text-white mt-2 p-2">{{ $teacher ? 'Update Teacher' : 'Add Teacher' }}</button>
        </div>
    </div>
</form>
</div>