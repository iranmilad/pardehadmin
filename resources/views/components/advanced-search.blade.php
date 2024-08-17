<div>
    @if(!empty($label))
        <label class="form-label" for="{{ $type }}_search">{{$label}}</label>
    @endif
    <select <?= $multiple === true ? 'multiple': '' ?>  class="form-select <?=  $solid === true ? 'form-select-solid': '' ?> advanced_search {{$classes}}" data-type="{{$type}}" name="{{$name}}">
        {{ $slot }}
    </select>
</div>

<script>
    window.ajaxUrl = "{{route("api.search")}}";
</script>