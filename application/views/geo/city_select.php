    <label><strong>Ville</strong> (tapez le début du nom)</label>
    <input id='city' type='text' placeholder="Tapez le début du nom"/><br />
    <input id='hidden-city-id' type='hidden' />



<script type="text/javascript">
var options = {
    script: "<?= site_url('geo/autocomplete_city').'?'; ?>",
    varname: "q",
    json: true,
    maxresults: 35,
    callback: function (obj) { document.getElementById('hidden-city-id').value = obj.id; }
};
var as = new bsn.AutoSuggest('city', options);    
</script>
