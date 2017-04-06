<input type="text" name="stok" value="1000">
<input type="text" name="kurangstok" value="0">
<input type="text" name="total" value="1000">

<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript"> 
var stok       = document.getElementsByName('stok')[0];
var kurangstok = document.getElementsByName('kurangstok')[0];
var total      = document.getElementsByName('total')[0];

function updateInput() {
  total.value = stok.value - kurangstok.value;
}

stok.addEventListener('change', updateInput);
kurangstok.addEventListener('keyup', updateInput);
total.addEventListener('change', updateInput);
</script>