<div>
    <label for="{{ $type }}_search">{{$label}}</label>
    <select <?= $multiple === true ? 'multiple': '' ?>  class="form-select <?=  $solid === true ? 'form-select-solid': '' ?> advanced_search" data-type="{{$type}}" name="{{$name}}"></select>
</div>

<script>
    window.ajaxUrl = "{{route("api.search")}}";
</script>