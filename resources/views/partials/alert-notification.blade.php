@if(session('success') || session('error'))
    <div class="col-sm-12">
        <div class="alert alert-dismissable {{ session('success') ? 'alert-success' : 'alert-danger' }}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') ? session('success') : session('error') }}
        </div>
    </div>
@endif