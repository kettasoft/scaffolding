<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('metronic.auth.logout_title')</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('metronic.auth.logout_cancel')</button>
                <a class="btn btn-primary" href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit()">@lang('metronic.auth.logout')</a>
                <form style="display: none;" action="{{ route('logout') }}" method="post" id="logoutForm">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
