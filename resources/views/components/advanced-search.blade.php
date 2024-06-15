<div>
    <label class="form-label" for="{{ $type }}_search">{{$label}}</label>
    <select <?= $multiple === true ? 'multiple': '' ?>  class="form-select <?=  $solid === true ? 'form-select-solid': '' ?> advanced_search {{$classes}}" data-type="{{$type}}" name="{{$name}}">
        {{ $slot }}
        @foreach($selected as $select)
            <option value="{{ $select["id"] }}"  selected>{{ $select["text"] }} </option>
        @endforeach
    </select>
</div>

<script>
    window.ajaxUrl = "{{route("api.search")}}";
</script>
