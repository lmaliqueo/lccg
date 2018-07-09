@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])
    @else



        <div class="ui {{ session('flash_notification.level') }}
                    {{ session()->has('flash_notification.important') ? 'alert-important' : '' }} message"
        >
            @if(session()->has('flash_notification.important'))
                {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
            @endif
                <i class="close icon"></i>

            <div class="header">
                {!! session('flash_notification.message') !!}
            </div>
        </div>
    @endif
@endif

