<!-- resources/views/livewire/search-users.blade.php -->

<div>
    <label for="select2">انتخاب کاربر:</label>
    <select wire:model="selectedUser" data-control="select2" id="select2" class="form-control form-control-solid" data-hide-search="false">
        @foreach ($users as $user)
            <option value="{{ $user['id'] }}">{{ $user['name'] }} - {{$user['phone']}}</option>
        @endforeach
    </select>
</div>
