<select id="floor-select">
    <option value="0" disabled selected>Floor</option>
    @if (isset($data) and count($data) > 0)
        @foreach ($data as $key => $variable)
            {{ ($variable->name == 'Floor')? $floor = $variable->value : $floor = 0 }}
        @endforeach

        @for ($i = 1; $i <= $floor; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    @endif
</select>