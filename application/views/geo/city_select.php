<br /><br /><br />


<form>

<input id='city' type='text' placeholder="Tapez votre recherche"/><br />
<input id='testid' type='hidden' />

</form>


<script type="text/javascript">
var options = {
    script: "<?= site_url('temp/get_city').'?'; ?>",
    varname: "q",
    json: true,
    maxresults: 35,
    callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as = new bsn.AutoSuggest('city', options);    
</script>
