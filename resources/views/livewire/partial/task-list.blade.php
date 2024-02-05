@forelse($targetedData as $task)
    <div class="flex items-center justify-between">
        <label class="shrink-0 flex items-center gap-x-2" for="completed" wire:click="completed('{{$task->id}}','{{$currentTab}}')">
            <input type="checkbox"  id="completed" :value="$task->id" {{ $task->status ==1 ? 'checked' : ''}}>
            <p class="w-full">{{$task->name}} {{$task->id}}</p>
        </label>
        <button type="button" wire:click="deleteTodo('{{$task->id}}')" class="flex-no-shrink p-2 ml-2 text-red border-red">X</button>

    </div>
@empty
    <span class="block text-red-500 text-center text-sm font-semibold">No Task Yet</span>
@endforelse
