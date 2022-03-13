<select id="floor-select">
    <option value="0" disabled selected>Floor</option>
    @if (isset($floor))
        @for ($i = 1; $i <= $floor; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    @endif
</select>