<form method="get">
    <div class="input-group mb-3 col-4" style="padding-left: 0; padding-right: 0;">
        <div class="input-group-prepend">
            <span class="input-group-text cil-search" style="border-right: none; background: white;"></span>
        </div>
        <input type="text" class="form-control" name="search" value="{{ old('search', request()->query('search')) }}" style="border-left: none;">
    </div>
</form>