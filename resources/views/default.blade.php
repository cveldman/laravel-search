<form method="get">
    <div class="input-group" style="padding-left: 0; padding-right: 0;">
        <div class="input-group-prepend">
            <span class="input-group-text cil-search" style="border-right: none; background: white;"></span>
        </div>

        @foreach(request()->input() as $key => $value)
            @if($key != "search")
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <input type="text" class="form-control" name="search" value="{{ old('search', request()->query('search')) }}" style="border-left: none;">
    </div>
</form>
