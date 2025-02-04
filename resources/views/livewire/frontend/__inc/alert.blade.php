@if (session()->has(\App\Libraries\Alert\AlertMessage::key()))
        <?php $message = session(\App\Libraries\Alert\AlertMessage::key()); ?>
    <div class="alert floating-alert alert-{{ $message['type'] }}"
         id="floating-alert"
         x-data="{ show: true }"
         x-init="setTimeout(() => document.getElementById('floating-alert').remove(), 4000)"
    >
        <a href="#" x-on:click.prevent="document.getElementById('floating-alert').remove()">
            <svg class="alert-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>

        <h6 class="alert-title">{{ $message['title'] }}</h6>
        <div class="alert-desc">
            {{ $message['description'] }}
        </div>
    </div>
@endif
