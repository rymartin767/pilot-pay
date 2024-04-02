<div class="bg-white mb-3 rounded-md shadow-sm px-4 py-6">
    <div class="flex flex-col">
        <div class="">{!! $comment->body !!}</div>
        <div class="flex justify-end border-t border-gray-300 mt-3">
            <div class="text-sm italic pt-2">By {{ $comment->user->name }} 8 minutes ago</div>
        </div>
    </div>
</div>