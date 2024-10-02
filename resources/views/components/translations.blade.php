<script>
    let TRANSLATIONS = {};
    TRANSLATIONS.locale = '{{ app()->getLocale() }}';
    TRANSLATIONS._translations = @json($translations);
</script>
