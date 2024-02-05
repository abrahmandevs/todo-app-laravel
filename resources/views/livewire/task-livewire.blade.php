<div>
    <div class="m-auto h-full w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
            <div class="mb-4 space-y-3">
                {{--  <input  class="outline-none shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Name"> --}}
                    <h1 class="text-grey-darkest">Hello, <b>{{auth()->check()? auth()->user()->name: ''}}</b></h1>
                <h1 class="text-grey-darkest font-bold">Todo App</h1>
                <form class="" wire:submit.keydown.enter="createTodo('{{$currentTab}}')">
                    <input name="addTodo"
                        id="addTodo"
                        wire:model='addTodo'
                        {{-- wire:keydown.enter='createTodo' --}}
                        class=" outline-none placeholder:text-black placeholder:text-sm shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="What do  you need to do?">

                    @error('addTodo') <span class="">{{ $message }}</span> @enderror
                    {{-- <button type="submit" class="block bg-green-500 rounded px-2 py-1 text-white"> sumbit</button> --}}
                </form>
            </div>
            {{$test}}
            <div class="divide-y">
                <div>
                <div wire:key="defaultTab-{{uniqid()}}">
                    @if('defaultTab' == $currentTab)
                        <div id="defaultTab">
                            @include('livewire.partial.task-list')
                        </div>
                    @endif
                </div>
                <div wire:key="activeTab-{{uniqid()}}">

                    @if('activeTab' == $currentTab)
                        <div id="activeTab">
                            @include('livewire.partial.task-list')
                        </div>
                    @endif
                </div>
                <div wire:key="completedTab-{{uniqid()}}">
                    @if('completedTab' == $currentTab)
                        <div id="completedTab">
                            @include('livewire.partial.task-list')
                        </div>
                    @endif
                </div>
                </div>
                <div class="py-3 flex justify-between items-center gap-x-2">
                    <button wire:click="checkAllTask" class="">Check All</button>
                    <p class=" text-sm">{{$remaningTask}} items remaning</p>
                </div>
                <div class="py-3 flex justify-between items-center gap-x-2 text-sm">
                    <div class="flex items-center gap-x-1">
                        @php
                            $commonClass = 'p-1 px-2 rounded border-gray-400 '  ;
                        @endphp
                        <button wire:click="allTask('defaultTab')" class="{{$commonClass}} {{$currentTab =='defaultTab' ? 'border' :''}}">All</button>
                        <button wire:click="activeTask('activeTab')" class="{{$commonClass}}  {{$currentTab =='activeTab' ? 'border' :''}}">Active</button>
                        <button wire:click="completedTask('completedTab')" class="{{$commonClass}}  {{$currentTab =='completedTab' ? 'border' :''}}">Complete</button>
                    </div>
                    <button wire:click="clearCompletedTask" class="p-1 px-2 border rounded border-gray-400">Clear completed</button>
                </div>
            </div>

        </div>
    </div>
</div>
