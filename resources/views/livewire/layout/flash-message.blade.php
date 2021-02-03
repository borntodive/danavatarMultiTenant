<div class="sticky top-0 z-50">
    @foreach (['error', 'success'] as $msg)
        @if(session()->has($msg))
            <x-layout.notification :type="$msg" :message="session($msg)" />
        @endif
    @endforeach
    @foreach ($messages as $type=>$message)
        @if($message)
            <x-layout.notification :type="$type" :message="$message" />
        @endif
    @endforeach
</div>
