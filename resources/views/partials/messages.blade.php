<ul id="toastr-list" style="display: none;">
    @foreach($errors->getMessages() as $error)
        <li data-type="error">{!! $error[0] !!}</li>
    @endforeach
    @foreach(\App\Services\FlashMessages::getMessages() as $type => $messages)
        @foreach($messages as $message)
            <li data-type="{!! $type !!}">{!! $message !!}</li>
         @endforeach
    @endforeach
</ul>